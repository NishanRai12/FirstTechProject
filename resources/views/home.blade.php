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
{{--        @foreach($posts as $postData)--}}
{{--            {{$postData->caption}}--}}
{{--        @endforeach--}}
            @foreach($posts as $postData)
                {{ $postData->caption }}
            @endforeach
    </div>
</div>
</body>
</html>
