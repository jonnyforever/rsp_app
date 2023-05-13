@extends('layouts/app')

@section('head_title')
    Edit post
@stop

@section('content')

    <h2>{{$post->title}}</h2>
    <h3>{{$post->body}}</h3> 
    <img src='{{$post->path}}' alt='' width='80px' height='60px'>
    <br>
    <br>
    Edit post
    <br>
    <!--<form action="/posts/{{$post->id}}" method="post">-->
    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['\App\Http\Controllers\PostsController@update', $post->id]]) !!}
        @csrf
        <!--<input type="hidden" name="_method" value="PUT">-->
        <!--<input type="text" name="title" placeholder="Enter title"  value="{{$post->title}}">-->

        {!! Form::label('title', "Title:") !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}

        <!--<input type="submit" name="update">-->
        {!! Form::submit('Update post', ['class' => 'btn btn-primary']) !!}
    <!--</form>-->
    {!! Form::close() !!} 
    
    <br>
    <br>
    Delete post
    <br>
    <!--<form action="/posts/{{$post->id}}" method="post">-->
    {!! Form::open(['method' => 'DELETE', 'action' => ['\App\Http\Controllers\PostsController@destroy', $post->id]]) !!}
        @csrf
        <!--<input type="hidden" name="_method" value="DELETE">-->
        <!--<input type="submit" name="delete">-->
        {!! Form::submit('Delete post', ['class' => 'btn btn-danger']) !!}
    <!--</form>-->
    {!! Form::close() !!} 

@stop

@section('footer')
    
@stop