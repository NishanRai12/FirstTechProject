<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show particular</title>
    <style>

    </style>
</head>
<body>
@include('navigation')
<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1> POSTS</h1>
        <p><a href="{{route('post.create',Auth::user()->id)}}" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">AddPost</a></p>
        @if($userPost)
            @foreach($userPost as $postData)

                <div class="card" style="width: 18rem;">
                    {{--                <img src="{{$postData->post_image ? asset('storage/' . $postData->post_image) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="...">--}}
                    {{--                <img src="{{ $postData->post_image ? asset('storage/uploads/posts' . $postData->post_image) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="Post image">--}}

                    <div class="card-body">
                        <div class="div_for_edit_or_del">
                            <div class="dropdown-center" style="display: flex; justify-content: end; ">
                                <button style="background-color: white ; border: none;color : black ; place-content: center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('post.edit',$postData->id)}}">Edit</a></li>
                                    <form action="{{route('post.destroy',$postData->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="dropdown-item" type="submit"> Delete</button>
                                    </form>
                                </ul>
                            </div>
                            <div class="div_for_data">
                                <p class="card-text">{{ $postData->caption }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            @endforeach
        @else
            <div>No posts available.</div>
        @endif
        <div style="display: flex; justify-content: center" class="pagination">
            {{ $userPost->links() }}
        </div>
    </div>

</div>
</body>

</html>
