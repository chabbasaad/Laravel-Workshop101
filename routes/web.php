<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

// Route::get('/posts',[PostController::class,'index'])->name('posts.index');
// Route::post('/posts',[PostController::class,'store'])->name('posts.store');
// route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
// Route::delete('/posts/{id}',[PostController::class,'destroy'])->name('posts.destroy');
// Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');
// Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
// Route::put('/posts/{id}',[PostController::class,'update'])->name('posts.update');



// Route::get('/posts/{id}/{author?}', [HomeController::class, 'blog'])->name('blog-posts');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');


Route::resource('posts', PostController::class);
Route::delete('/posts/{id}/force', [PostController::class, 'ForceDelete'])->name('posts.force');
Route::get('/postsarchive', [PostController::class, 'archive'])->name('posts.archive');
Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

Route::post('comment/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::patch('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
