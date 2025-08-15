<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sample = [
            'title' => '게시글 테스트-제목',
            'content' => '게시글 테스트-내용',
            'author' => '아무개'
        ];
        for($i = 1; $i < 5; $i++) {
            $data = [
                'title'     => $sample['title'] . $i,
                'content'   => $sample['content'] . $i,
                'author'    => $sample['author'] . $i,
                'is_delete' => 0
            ];
            Post::create($data);
        }
    }
}
