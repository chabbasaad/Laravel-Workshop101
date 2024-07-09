<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $posts =  Post::factory(5)->create();


        Comment::factory(5)->make()->each(function ($comment) use ($posts) {
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });


    }
}
