<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
</head>
<body>
<h1>HELLO Profile</h1>
<form action="{{route('profile.store')}}" method="POST">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    <label for="bio">Bio</label>
    <textarea name ="bio" rows="4" cols="50"></textarea>
    @error('bio')
    <div style="color:red;">{{$message}}</div>
    @enderror
    <br>
    <label for="gender">Gender</label>
    <select name="gender">
        <option disabled selected >Choose gender</option>
        <option value="female">Female</option>
        <option value="male">Male</option>
    </select>
    @error('gender')
    <div style="color:red;">{{$message}}</div>
    @enderror
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
