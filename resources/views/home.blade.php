@extends('layout')
<!--THIS IS AN EXAMPLE DONT COPY-->
<div class="navbar navbar-inverse navbar-fixed-top">


      <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('posts.index') }}">Posts</a>
        <a href="{{ route('posts.create') }}">Create Post</a>
      </div><!--/.nav-collapse -->

  </div>
  <div class="container" style="margin-top:5em;">
    <div class="text-center">
      <h1>Bootstrap starter template</h1>
      <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
    </div>
  </div>
