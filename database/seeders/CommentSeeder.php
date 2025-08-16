<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        $sample = [
            'content' => '댓글 테스트-내용',
            'author' => '관리자'
        ];

        foreach ($posts as $post) {
            for ($i = 1; $i < 3; $i++) {
                $data = [
                    'post_id'   => $post->id,
                    'content'   => $sample['content'] . $i,
                    'author'    => $sample['author'] . $i,
                    'is_delete' => 0
                ];
                Comment::create($data);
            }
        }
    }
}
