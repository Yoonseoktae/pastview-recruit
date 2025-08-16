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
        Schema::create('posts', function (Blueprint $table) {
            // 컬럼
            $table->id();
            $table->string('title', 255)->comment('제목');
            $table->text('content')->comment('내용');
            $table->string('author', 50)->comment('작성자');
            $table->tinyInteger('is_delete')->default(0)->comment('삭제여부');
            $table->timestamps();

            // 인덱스
            $table->index(['author']);
            $table->index(['is_delete', 'created_at'], 'base_search_idx');
            $table->fullText(['title', 'content'], 'title_content_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
