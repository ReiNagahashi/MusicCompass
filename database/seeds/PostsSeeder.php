<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;


class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id'=>$user->id,
            'title' => '一緒に踊ろう！僕の新世代テクノクラブ！',
            'description' => 'さあ、やってまいりました今週末！まさか、あなたお家でゴロゴロで終わらせるのですか！？',
            'condition' => '30際以下が望ましいですが、気軽にコメントください。',
            'post_image' => 'dj-720589_640.jpg',
            'location' => '東洋バングアキラ沢',
            'address' => 'URLをここに貼る'
            ]);
    }
}
