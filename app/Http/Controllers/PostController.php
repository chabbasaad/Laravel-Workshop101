<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Enable query logging
      //  DB::enableQueryLog();

        // Retrieve all posts and users (though users are not used in the view)

        // $posts = Cache::remember('posts', now()->addSeconds(40), function () {
        //     Log::info('Retrieving posts from database' , ['time' => now()]);
        //     return Post::all();
        // });

        //$posts = Post::onlyTrashed()->get();
      //  $posts = Post::whereNotNull('deleted_at')->get();
        //$posts = DB::table('posts')->whereNotNull('deleted_at')->get();
       // dd($posts);
       $posts =  Post::all();
        $users = User::all();
        $query = DB::getQueryLog();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function archive()
    {

        // Retrieve all posts and users (though users are not used in the view)
        $posts = Post::onlyTrashed()->get();
       // $users = User::all();

        return view('posts.archive', [
            'posts' => $posts
        ]);
    }

    public function restore(string $id)
    {
        // Find the post by ID
        $post = Post::withTrashed()->findOrFail($id);

        // Restore the post
        $post->restore();

        return redirect('/posts');
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

       // dd($request->all());
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

       // $post->ForceDelete();

        return redirect('/posts');
    }

    public function ForceDelete(string $id)
    {
        // Find and delete the post
        $post = Post::withTrashed()->findOrFail($id);
      //  dd($post);
        $post->ForceDelete();

        return redirect('/posts');
    }
}
