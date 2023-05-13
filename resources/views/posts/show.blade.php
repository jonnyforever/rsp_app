
@extends('layouts/app')

@section('head_title')
    Show post
@stop

@section('content')

    <h2><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></h2>
    <h3>{{$post->body}}</h3>


@endsection

@section('footer')
    
@stop