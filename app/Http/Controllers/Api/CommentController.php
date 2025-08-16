<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends BaseController
{
    /**
     * 댓글 목록
     */
    public function index(Request $request)
    {
        $comments = Comment::where('is_delete', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));

        return $this->paginated($comments, '댓글 목록 조회 완료');
    }

    /**
     * 댓글 저장
     */
    public function store(CommentRequest $request)
    {
        $comment = Comment::create($request->validated());

        return $this->success($comment, '댓글 생성 완료');
    }

    /**
     * 댓글 상세 조회
     */
    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment || $comment->is_delete == 1) {
            return $this->notFound('댓글을 찾을 수 없습니다.');
        }
        
        return $this->success($comment, '댓글 조회 완료');
    }

    /**
     * 댓글 수정
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::find($id);
        $comment->update($request->validated());

        return $this->success($comment, '댓글 수정 완료');
    }

    /**
     * 댓글 삭제 (Soft Delete)
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->is_delete = 1;
        $comment->save();

        return $this->success(null, '댓글 삭제 완료');
    }
}
