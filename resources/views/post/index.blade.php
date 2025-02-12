<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
@include('navigation')
<h1>Home Page</h1>
<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        @foreach($posts as $postData)
            <div class="card" style="width: 18rem;">
                <img src="{{asset('storage/'.$postData->post_image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">{{ $postData->caption }}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
