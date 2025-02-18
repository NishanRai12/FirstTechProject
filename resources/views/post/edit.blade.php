<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT POST</title>
    <style>
        /* Style for the scrollable box */
        .tag-box {
            width: 100%;
            height: 200px; /* Set the height as needed */
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .tag-box label {
            display: block;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
@include('navigation')

<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1>POST</h1>
        @if(session('success'))
            <div style="color: green">{{session('success')}}</div>
        @endif
        <form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
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
            @error('caption')
                {{$message}}
            @enderror
            <img style="height: 20rem; width: 20rem; object-fit: cover;" src="{{ asset('storage/' . $post->post_image) }}" alt="Post Image">
            <br>
            <input   class="form-control" type="file" name="post_image">
            @error('post_image')
            {{$message}}
            @enderror
            <br>
            @php
                //putting the fetched data in an array
                $tagNames=[];
               foreach($post->tags as $tag){
                       $tagNames[] = $tag->tag_name;
               }
            @endphp
            <div class="mb-3">
                <label for="post_tag" class="form-label"><strong>Tag</strong></label>
                {{--                image file input--}}
                <input  style="color: darkblue" class="form-control" name="tags" value="#{{implode('# ', $tagNames)}}">
            </div>
            {{--            first div for caption --}}
            <button style="width: 100px;" class="btn btn-primary" type="submit">Update</button>

        </form>
    </div>
</div>
</body>
</html>
