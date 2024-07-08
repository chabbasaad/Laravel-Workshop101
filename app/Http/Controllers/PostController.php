<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Enable query logging
        DB::enableQueryLog();

        // Retrieve all posts and users (though users are not used in the view)
       //



       DB::enableQueryLog(); // Start logging queries

       // Fetch posts without eager loading
       $posts = Post::with('comments')->get();

    //    foreach ($posts as $post) {
    //        echo $post->comments->count() . ' comments<br>';
    //    }

    //    // Log and reset after non-eager loading
    //    $log = DB::getQueryLog();
    //    echo 'Queries executed without eager loading: ' . count($log) . "<br>";
    //    DB::flushQueryLog(); // Resetting query log

       // Fetch posts with eager loading
       //$posts = Post::with('comments')->get()->setHidden(['content']);

       //

    //    $posts = DB::table('posts')
    //        ->join('comments', 'posts.id', '=', 'comments.post_id')
    //        ->select('posts.*', 'comments.*')
    //        ->get();

    //    foreach ($posts as $post) {
    //        echo $post->comments->count() . ' comments<br>';
    //    }

    //    // Review query log with eager loading
    //    $log = DB::getQueryLog();
    //    echo 'Queries executed with eager loading: ' . count($log) . "<br>";



        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Prepare data for the new post
        $data = $request->only(['title', 'content']);
        $data['slug'] = "test" . rand();

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filePath = Storage::disk('public')->putFileAs('posts/images', $file, rand(1, 100) . '.' . $file->getClientOriginalExtension());
            $data['image_post'] = $filePath;
        }

        // Create the post
        $post = Post::create($data);

        return redirect()->route('posts.show', ['post' => $post])->with('status', 'Post was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the post by ID or fail
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the post by ID or fail
        $post = Post::findOrFail($id);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Handle file upload and update image if exists
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            if ($post->image_post) {
                Storage::disk('public')->delete($post->image_post);
            }

            $filePath = Storage::disk('public')->putFileAs('posts/images', $file, rand(1, 100) . '.' . $file->getClientOriginalExtension());
            $post->image_post = $filePath;
        }

        // Update the post details
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.show', ['post' => $post])->with('status', 'Post was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete the post
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/posts');
    }
}
