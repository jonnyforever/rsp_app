@extends('layouts.app')

@section('head_title')
    Contact
@stop

@section('content')

    Display an array from the controller

    @if(count($people))

        <ul>

            @foreach($people as $k => $person)

                    <li>{{$person}}</li>

            @endforeach

        </ul>

    @endif

@stop