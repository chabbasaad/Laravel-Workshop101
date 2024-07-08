<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function home()
    {
        return view('home');
    }

    public function about()
    {

        // method 1

        $comment = new Comment();

        // $comment->comment= "first comment laravel with mehdi 2";

        // // $post = Post::find(4);
        // // $post->comments()->save($comment);

        // $comment->post_id = 5; //   $comment->post()->associate(Post::find(2));

        // $comment->save();



        // dd($post->comments);

        // method 2
        // $comment = new Comment();

        // $comment->comment= "first comment laravel with youness";

        // $comment->post()->associate(Post::find(2));

        // $comment->save();

        // dd($comment);


        // method 2 : associate two comment to one post

        // $comment = new Comment();

        // $comment->comment= "first comment mehdi";

        // $comment1 = new Comment();

        // $comment1->comment= "second comment ssss ";

        // $post = Post::find(3);

        // $post->comments()->saveMany([$comment,$comment1]);


        // dd($post->comments);

        return view('about');
    }

    public function blog($id,$author = "default name")
    {

        $posts = [
            1 => ['title' => '<a> Intro to Laravel </a>'],
            2 => ['title' => 'Intro to PHP'],
        ];
        return view('posts.show', [
            'post' => $posts[$id] ,
            'author' => $author
        ]);

    }



}
