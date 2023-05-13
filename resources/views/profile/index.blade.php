
@extends('layouts/app')

@section('head_title')
    Profile
@stop

@section('content')
    <h1>Profile</h1>

    <hr>

    {{Auth::user()->name}}

    {{$user->name}}

    <br>
    Edit Profile
    <br>
    <form action="/profile/{{$user->id}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <input type="text" name="note" placeholder="Enter note" value="{{$user->note}}">
        <input type="submit" name="update" title="Update" value="Update">
    </form>

    <br>

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['\App\Http\Controllers\ProfileController@update', $user->id]]) !!}
        @csrf
        {!! Form::label('note', "Note:") !!}
        {!! Form::text('note', null, ['class' => 'form-control']) !!}
        {!! Form::submit('Update user 2', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!} 

@endsection

@section('footer')
    
@stop