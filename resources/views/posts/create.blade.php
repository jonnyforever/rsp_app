
@extends('layouts/app')

@section('head_title')
    Create post
@stop

@section('content')

    <!--<form action="/posts" method="post">-->
    {!! Form::open(['method' => 'POST', 'action' => '\App\Http\Controllers\PostsController@store', 'files' => true]) !!}

        @csrf

        <div class="form-group">

            {!! Form::file('file', ['class' => 'form-control']) !!}

            <br><br>

            <!--<input type="text" name="title" placeholder="Enter title">-->
            {!! Form::label('title', "Title:") !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}

            <br><br>

            <!--<input type="text" name="body" placeholder="Enter body">-->
            {!! Form::label('body', "Body:") !!}
            {!! Form::text('body', null, ['class' => 'form-control']) !!}

            <br><br>

        </div>

        <!--<input type="submit" name="submit">-->
        {!! Form::submit('Create post', ['class' => 'btn btn-primary']) !!}

    <!--</form>-->
    {!! Form::close() !!}

@stop

@section('footer')
    
@stop