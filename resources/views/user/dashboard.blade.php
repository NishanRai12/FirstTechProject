<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
</head>
<body>
<h1> User Profile </h1>
<p>Name: {{Auth::user()->name}}</p>
<p>Username: {{Auth::user()->username}}</p>
<p>Email: {{Auth::user()->email}}</p>

<p></p>
<p></p>
</body>
</html>
