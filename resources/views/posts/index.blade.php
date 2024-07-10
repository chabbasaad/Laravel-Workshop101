@extends('layout')

@section('content')


<x-post-table type="all Post" :posts="$posts"></x-post-table>
@stop