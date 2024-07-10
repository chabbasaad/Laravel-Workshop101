@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3">Post Details</h1>
            <a href="{{ route('posts.index') }}" class="btn btn-success">Go to all Posts</a>
        </div>
    </div>

    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">{!! \Illuminate\Support\Str::markdown($post->content) !!}</p>
            <p class="text-muted">Created at: {{ $post->created_at->format('F j, Y, g:i a') }}</p>
        </div>
    </div>
</div>
@stop