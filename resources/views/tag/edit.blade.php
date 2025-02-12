<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Tag</title>
</head>
<body>
@include('navigation')
<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1>Tags</h1>
        <form action="{{route('tag.update',$fetchedTag->id)}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_logged" value="{{Auth::user()->id}}">
            <div class="mb-3">
                <label for="tag_name" class="form-label">Tag</label>
                <input type="text" class="form-control"  value="{{ $fetchedTag->tag_name }}" name="tag_name" >
            </div>
            @error('tag_name')
            <div style="color: red";>{{$message}}</div>
            <br>
            @enderror
            <button type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
