<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Login</h1>
    <form action="{{route('userLog')}}" method="POST">
        @csrf
        <label for="emailUserName">Username/Email</label>
        <input type="text" name="emailUserName"><br>
        @error('emailUserName')
            <div style="color:red;">{{$message}}</div>
        @enderror
        <label for="password">Password</label>
        <input type="text" name="password"><br>
        @error('password')
            <div style="color:red;">{{$message}}</div>
        @enderror
        <button for="submit" type="submit">Login</button>
        @if (session('error'))
            <div style="color:red;">{{session('error')}}</div>
        @endif
    </form>
</body>

</html>