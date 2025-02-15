<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
@include('navigation')
<div class="main_div">
    <div class=" child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login" style="margin-left: 200px">
        @foreach($posts as $postData)
            <div class="card" style=" margin-left: 150px; margin-bottom:20px;width: 30rem;">
                <div style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 5px">
{{--                 if the user have the profile set--}}
                    @if($postData->user->profile)
                     <img class="profile_post_image" src="{{ asset('storage/' . $postData->user->profile->picture) }}" alt="jjj" style="width: 50px; height: 50px; border-radius: 50%;">
                    @else
                     <img class="profile_post_image" src="{{ asset("storage/uploads/empt.jpg") }}" alt="jjj" style="width: 50px; height: 50px; border-radius: 50%;">
                    @endif
                    <strong style=" margin-left:10px;">{{$postData->user->username}}</strong>
                </div>
{{--                dis[play post image--}}
                <img src="{{asset("storage/$postData->post_image")}}" class="card-img-top" alt="...">
                <div class="card-body">
                   <p> <strong style="margin-top: 20px; margin-bottom: 10px">{{$postData->user->username}}</strong> {{ $postData->caption }}
{{--                      list out all the tags--}}
                       <span style="color: blue;">
                           @foreach($postData->tags as $tag)
                            #{{ $tag->tag_name }}
                           @endforeach
                       </span>
                   </p>

                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
