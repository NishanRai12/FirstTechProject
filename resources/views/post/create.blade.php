<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
{{--            hidden input to pass the user id--}}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
{{--            first div for caption --}}
            <div class="mb-3">
{{--                label for caption--}}
                <label for="caption" class="form-label"><strong>Caption</strong></label>
{{--                text area to input the caption--}}
                <textarea name ="caption" class="form-control" rows="4"  ></textarea>
            </div>
            {{--            first div for caption --}}
            <div class="mb-3">
{{--                label for input image--}}
                <label for="post_image" class="form-label"><strong>Image</strong></label>
{{--                image file input--}}
                <input   class="form-control" type="file" name="post_image">
            @error('post_image')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            </div>
            <label for="tags" class="form-label"><strong>Tags</strong></label>
            <div class="tag-box">
                <a style="margin-bottom: 20px; text-decoration: none" href="{{ route('tag.create') }}">
                    <strong>Add more tags</strong>
                </a>

                @foreach ($tags as $tag)
                    <label style="display: block; margin-bottom: 10px;">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                        {{ $tag->tag_name }}
                    </label>
                @endforeach
            </div>


            <button style="width: 100px;" class="btn btn-primary" type="submit">Post</button>
        </form>
    </div>
</div>
</body>
</html>
