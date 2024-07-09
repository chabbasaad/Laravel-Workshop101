<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/about', function () {
//     return view('about');
// });


 Route::view('/','home');
// Route::view('/about','about');




// // Route::get('/posts/{id}/{nom?}',function ($id,$nom = "deafault"){
// //    // return "hello mr ".$nom . " your id is :  ".$id ;
// //    return view('posts.show');
// //   //return ['title' =>  'laravel'];
// // });


// // Route::get('/posts/{id}/{author?}', function ($id,$author ="default") {


// //     $posts = [
// //         1 => ['title' => 'Intro to Laravel'],
// //         2 => ['title' => 'Intro to PHP'],
// //     ];

// //     if(array_key_exists($id,$posts))
// //     {
// //         return view('posts.show', [
// //             'data' => $posts[$id]
// //            //'data' => $posts
// //         ]);
// //     }
// //     else{
// //         return "post empty";
// //     }

// // });


// Route::get('/posts/{id}/{author?}', function ($id,$author = "default name") {
//     $posts = [
//         1 => ['title' => '<a href="www.google.com"> Intro to Laravel </a>','price' => '60','date'=>"2011/05/21"],
//         2 => ['title' => 'Intro to PHP','price' => '30','date'=>"2011/05/21"],
//     ];
//     return view('posts.show', [
//         'data' => $posts[$id] ,
//       //  'author' => $author
//     ]);
// });

// route::get('/posts',[PostController::class,'index'])->name('index');
// Route::post('/posts',[PostController::class,'store'])->name('store');
// route::get('/posts/create',[PostController::class,'create'])->name('create');
// Route::delete('/posts/{id}',[PostController::class,'destroy']);
// Route::get('/posts/{id}',[PostController::class,'show'])->name('show');
// Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('edit');
// Route::put('/posts/{id}',[PostController::class,'update'])->name('update');



// Route::get('/posts/{id}/{author?}', [HomeController::class, 'blog'])->name('blog-posts');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');


Route::resource('posts', PostController::class);
Route::delete('/posts/{id}/force', [PostController::class, 'ForceDelete'])->name('posts.force');

