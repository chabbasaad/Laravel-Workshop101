@extends('layout')

@section('content')

<div class="container">


        {{-- @include('posts.form'); --}}

        <x-form :action="route('posts.store')"  method="POST"></x-form>


</div>


@endsection