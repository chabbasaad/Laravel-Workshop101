@extends('layout')

@section('content')

<x-post-table type="archive" :posts="$posts"></x-post-table>
@stop