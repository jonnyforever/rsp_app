
@extends('layouts/app')

@section('head_title')
    Posts
@stop

@section('content')

    <ul>

        @foreach($posts as $post)
            <li>
                <a href="{{route('posts.show', $post->id)}}">show {{$post->title}}</a>
            </li>   
        @endforeach

    </ul>

    <br>

    <ul>

        @foreach($posts as $post)
            <li>
                <a href="{{route('posts.edit', $post->id)}}">edit {{$post->title}}</a>
            </li>   
        @endforeach

    </ul>


@endsection

@section('footer')
    
@stop