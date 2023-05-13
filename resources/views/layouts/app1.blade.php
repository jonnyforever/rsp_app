<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('head_title')</title>
    </head>
    <body>

        <!--@include('layouts/app2')-->
        
        Menu :
        <a href="/">Home</a>,&nbsp;
        <a href="/posts">Show all posts</a>,&nbsp;
        <a href="/posts/create">Create a post</a>

        <hr>

        @if(count($errors) > 0) 
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>   
            </div>
        @endif

        <div class='container'>
            @yield('content')
        </div>

        @yield('footer')

    </body>
</html>