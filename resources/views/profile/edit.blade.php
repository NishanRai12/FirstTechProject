<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
</head>
<body>
@include('navigation')
<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1>Profile</h1>
        @if(session('success'))
            <div style="color:#0aea28;">{{ session('success') }}</div>
        @endif
        <img class="profile_image" src="{{ asset('storage/' . $fetchProfile->picture) }}" alt="jjj">
        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

            <div class="mb-3">
                <label for="bio" class="form-label"><strong>Bio</strong></label>
                <textarea name="bio" class="form-control" rows="4">{{ $fetchProfile->bio }}</textarea>
                @error('bio')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label"><strong>Gender</strong></label>
                <select class="form-select" name="gender">
                    <option value="female" {{ $fetchProfile->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="male" {{ $fetchProfile->gender == 'male' ? 'selected' : '' }}>Male</option>
                </select>
                @error('gender')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label" for="images">Profile picture</label>
                <input  class="form-control" type="file" name="profile_picture">
            </div>
            @error('profile_picture')
            <div style="color:red;">{{ $message }}</div>
            @enderror
            <br>
            <button  style="width: 100px;" class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
