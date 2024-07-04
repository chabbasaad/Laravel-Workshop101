@extends('layout')

@section('content')

<div class="container">

<x-form :action="route('posts.update',['post'=> $post->id])"  method="PUT" :post="$post" ></x-form>

</div>


@endsection