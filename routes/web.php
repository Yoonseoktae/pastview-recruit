<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

Route::get('/', function () {
    return view('welcome');
});

// API 라우트
Route::prefix('api')->withoutMiddleware('web')->group(function () {
    // 게시글 CRUD
    Route::prefix('posts')->group(function () {
        Route::get('/{post}/comments', [PostController::class, 'getComments']); // 특정 게시글 댓글 목록
        Route::get('/{post}', [PostController::class, 'show']);         // 상세조회
        Route::put('/{post}', [PostController::class, 'update']);       // 수정
        Route::delete('/{post}', [PostController::class, 'destroy']);   // 삭제
        Route::get('/', [PostController::class, 'index']);              // 목록
        Route::post('/', [PostController::class, 'store']);             // 생성
    });
    
    // 댓글 CRUD
    Route::prefix('comments')->group(function () {
        Route::get('/{comment}', [CommentController::class, 'show']);       // 상세조회 
        Route::put('/{comment}', [CommentController::class, 'update']);     // 수정
        Route::delete('/{comment}', [CommentController::class, 'destroy']); // 삭제
        Route::get('/', [CommentController::class, 'index']);               // 목록
        Route::post('/', [CommentController::class, 'store']);              // 생성
    });
});