<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Registration</h1>
    <form action="{{route('setUser')}}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="text" name="email"><br>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="firstname">First name</label>
        <input type="text" name="firstname"><br>
        @error('firstname')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="lastname">Last name</label>
        <input type="text" name="lastname"><br>
        @error('lastname')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="username">Username</label>
        <input type="text" name="username"><br>
        @error('username')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="password">Password</label>
        <input type="text" name="password"><br>
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="password">Confirm Password</label>
        <input type="text" name="confirmPassword"><br>
        @error('confirmPassword')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <button name="submit" type="submit">Submit</button>
    </form>
</body>

</html>
