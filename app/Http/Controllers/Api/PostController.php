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
                    ->orWhere('content', 'LIKE', "%{$search}%")
                    ->orWhere('author', 'LIKE', "%{$search}%");
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
        $post = Post::findOrFail($id);
        return $this->success($post, '게시글 조회 완료');
    }
    
    /**
     * 게시글 수정
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->validated());
        
        return $this->success($post, '게시글 수정 완료');
    }
    
    /**
     * 게시글 삭제 (Soft Delete)
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->is_delete = 1;
        $post->save();
        return $this->success(null, "게시글 삭제 완료");
    }

    /**
     * 게시글 내 댓글 목록
     */
    public function getComments($id, Request $request)
    {
        $post = Post::findOrFail($id);

        $perPage = $request->input('per_page', 10);
        $sortOrder = $request->input('sort_order', 'asc');
        
        $comments = $post->comments()
                        ->orderBy('created_at', $sortOrder)
                        ->paginate($perPage);

        $response = [
            'post_id' => $post->id,
            'comment_cnt' => $post->comments()->where('is_delete', 0)->count(),
            'pagination' => $this->paginated($comments, "'{$post->title}' 댓글 목록")
        ];

        return $this->success($response, "'{$post->title}' 댓글 목록");
        
    }


}
