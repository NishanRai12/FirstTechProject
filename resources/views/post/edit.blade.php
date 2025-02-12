<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
@include('navigation')

<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1>POST</h1>
        <form action="{{route('post.update',$post->id)}}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{--            hidden input to pass the user id--}}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{--            first div for caption --}}
            <div class="mb-3">
                {{--                label for caption--}}
                <label for="caption" class="form-label"><strong>Caption</strong></label>
                {{--                text area to input the caption--}}
                <textarea name ="caption" class="form-control" rows="4"  >{{$post->caption}}</textarea>
            </div>
            @if(session('success'))
                <div style="color: green">{{session('success')}}</div>
            @endif
            {{--            first div for caption --}}
            <button style="width: 100px;" class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
