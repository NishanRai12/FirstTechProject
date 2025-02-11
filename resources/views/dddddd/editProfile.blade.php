<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
</head>
<body>
<h1> Edit Profile</h1>
@if(session('success'))
   <div style="color:Red;">{{session('success')}}</div>
@endif
<form action="{{route('profile.update',Auth::user()->id)}}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    <label for="bio"><strong>Bio</strong></label> <br>
    <textarea name ="bio" rows="4" cols="50" >{{$fetchProfile->bio}}</textarea>
    @error('bio')
    <div style="color:red;">{{$message}}</div>
    @enderror
    <br>
    <label for="gender"><strong>Gender</strong></label>
    <br>
    <select name="gender">
        <option value="female" {{$fetchProfile->gender == 'female' ? 'selected' : '' }}>Female</option>
        <option value="male" {{ $fetchProfile->gender == 'male' ? 'selected' : '' }}>Male</option>
    </select>

    @error('gender')
    <div style="color:red;">{{$message}}</div>
    @enderror
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
