@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3">Posts</h1>
            <div>
                <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
                <a href="/" class="btn btn-info">Home</a>
            </div>
        </div>
    </div>
    <nav class="nav nav-tabs nav-stacked my-5">
<a href="{{ route('posts.index') }}" class="nav-link active">All Posts</a>
<a href="{{ route('posts.archive') }}" class="nav-link">archived Posts</a>

    </nav>
    <div class="row">
        <div class="col-12">
            @if(count($posts) > 0)
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Image</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>

                        <td><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></td>
                        <td>{!! \Illuminate\Support\Str::markdown($post->content) !!}</td>
                        <td>
                            @if($post->image_post)
                            <img src="{{ Storage::url($post->image_post) }}" alt="Post Image" class="img-fluid" style="max-width: 100px;">
                            @endif
                        </td>
                        <td>{{ count($post->comments) }}</td>
                        <td>
                            @if(\Request::route()->getName() == 'posts.archive')
                            <div class="container">
                                <div class="row"> <form method="POST" action="{{ route('posts.restore', ['id' => $post->id]) }}" style="display:inline-block;">
                                    @csrf

                                    <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                </form></div>
                            </div>
                            @else
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm">Archive</button>
                            </form>
                            <form method="POST" action="{{ route('posts.force', ['id' => $post->id]) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning" role="alert">
                No posts found in database.
            </div>
            @endif
        </div>
    </div>
</div>
@stop