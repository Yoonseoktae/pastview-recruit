<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            // 컬럼
            $table->id();
            $table->unsignedBigInteger('post_id')->comment('게시글 ID');
            $table->text('content')->comment('댓글 내용');
            $table->string('author', 50)->comment('댓글 작성자');
            $table->tinyInteger('is_delete')->default(0)->comment('삭제 여부');
            $table->timestamps();
            
            // 인덱스
            $table->index(['post_id', 'is_delete', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
