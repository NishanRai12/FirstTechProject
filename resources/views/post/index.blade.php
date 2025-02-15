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
                <strong style=" margin-left:10px;margin-top: 20px; margin-bottom: 10px">{{$postData->user->username}}</strong>
                {{ $postData->user->created_at->diffForHumans() }}
                <img src="{{asset("storage/$postData->post_image")}}" class="card-img-top" alt="...">
                <div class="card-body">
                   <p> <strong style="margin-top: 20px; margin-bottom: 10px">{{$postData->user->username}}</strong> {{ $postData->caption }}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
