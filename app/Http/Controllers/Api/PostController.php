<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * 게시글 목록
     */
    public function index(Request $request)
    {
        $query = Post::query();
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }
        
        $list = $query->where('is_delete', 0)
                        ->orderBy('created_at', 'desc')
                        ->paginate($request->input('per_page', 10));
        
        return $this->paginated($list, '게시글 목록');
    }
    
    /**
     * 게시글 저장
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());
        return $this->success($post, '게시글 추가 완료');
    }
    
    /**
     * 게시글 상세 조회
     */
    public function show($id)
    {
        
        $post = Post::find($id);
        if (!$post || $post->is_delete == 1) {
            return $this->notFound('게시글을 찾을 수 없습니다.');
        }

        return $this->success($post, '게시글 조회 완료');
    }
    
    /**
     * 게시글 수정
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->update($request->validated());
        
        return $this->success($post, '게시글 수정 완료');
    }
    
    /**
     * 게시글 삭제 (Soft Delete)
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->is_delete = 1;
        $post->save();
        return $this->success(null, "게시글 삭제 완료");
    }

    /**
     * 게시글 내 댓글 목록
     */
    public function getComments($id, Request $request)
    {
        $post = Post::find($id);

        $perPage = $request->input('per_page', 10);
        $sortOrder = $request->input('sort_order', 'asc');
        
        $comments = $post->comments()
                        ->where('is_delete', 0)
                        ->orderBy('created_at', $sortOrder)
                        ->paginate($perPage);

        $comments->getCollection()->transform(function ($comment) use ($post) {
            $comment->post_id = $post->id;
            $comment->post_title = $post->title;
            $comment->post_author = $post->author;
            return $comment;
        });

        return $this->paginated($comments, "'{$post->title}' 댓글 목록");
        
    }


}
