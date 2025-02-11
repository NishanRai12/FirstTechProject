<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Home Page</h1>
    <h4>
        @if(Auth::check())
            {{Auth::user()->name}}
            <button type="button"> <a href="{{route('logout')}}"> Logout</a></button>
            <button type="button"> <a href="{{route('showProfile',Auth::user()->id)}}">Profile</a
        @elseif(!Auth::check())
            <button type="button"> <a href="{{route('login')}}"> Login</a></button>
        @endif


    </h4>
</body>
</html>
