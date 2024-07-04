<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function home()
    {
        return view('home');
    }

    public function about()
    {
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
