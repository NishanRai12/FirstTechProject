<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@include('navigation')
<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Users</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $categoryData)
                        <tr>
                            <td>{{$categoryData->name}}</td>
                            <td>{{$categoryData->users_count}}</td>
                            @foreach($categoryData->users as $user)
                                <td>{{$user->username}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
</body>
</html>
