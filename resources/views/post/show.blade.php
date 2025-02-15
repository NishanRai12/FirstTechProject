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

                <div class="card" style=" margin-left: 150px; margin-bottom:20px;width: 30rem;">
                    <div style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 5px">
{{--                        //condition for user profile--}}
                        @if($postData->user->profile)
                            <img class="profile_post_image" src="{{ asset('storage/' . $postData->user->profile->picture) }}" alt="jjj" style="width: 50px; height: 50px; border-radius: 50%;">
                        @else
                            <img class="profile_post_image" src="{{ asset("storage/uploads/empt.jpg") }}" alt="jjj" style="width: 50px; height: 50px; border-radius: 50%;">
                        @endif
                        <strong style=" margin-left:10px;">{{$postData->user->username}}</strong>
                    </div>
{{--                    //card image--}}
                    <img src="{{asset("storage/$postData->post_image")}}" class="card-img-top" alt="...">
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
                                <p> <strong style="margin-top: 20px; margin-bottom: 10px">{{$postData->user->username}}</strong>
                                    {{ $postData->caption }}
                                    {{-- list out all the tags--}}
                                    <span style="color: blue;">
                                        @foreach($postData->tags as $tag)
                                            #{{ $tag->tag_name }}
                                         @endforeach
                                    </span>
                                </p>
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
