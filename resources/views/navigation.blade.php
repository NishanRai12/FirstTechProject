<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navbar Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .hover-bg-grey:hover {
            color: #5e5e60;
        }
        .main_div {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            /*height: 100vh;*/
            margin: 0;
        }

        .child_div_1 {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            width: 100%;
            max-width: 800px;
        }
    </style>
</head>
<body>

<div style="width: 250px " class="w3-sidebar w3-bar-block w3-light-grey w3-card">
    <div style="margin-top: 30px; margin-left:50px;">
        @if(Auth::check() && Auth::user()->name)
            <span style="color: black;"><strong>{{Auth::user()->username}}</strong></span> <br>
            <span style="color: rgba(69,67,67,0.84)">{{Auth::user()->name}}</span>
        @endif
    </div>
    <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="w3-bar-item w3-button d-flex align-items-center ms-4" style="margin-top: 20px">
                <i class="fa-solid fa-house me-4"></i>
                @if(Auth::user())
                    <a class="nav-link active" aria-current="page" href="{{route('post.index')}}">Home</a>
                @else
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                @endif
            </li>
            <li class="w3-bar-item w3-button d-flex align-items-center ms-4">
                <i class="fa-regular fa-square-plus me-4"></i>
                <a class="nav-link active" aria-current="page" href="{{route('post.create')}}">Create</a>
            </li>
            <li style="margin-bottom: 10px" class="w3-bar-item w3-button d-flex align-items-center ms-4" data-bs-toggle="offcanvas" href="#offcanvasEExample" role="button" aria-controls="offcanvasExample">
                <i class="fa-solid fa-magnifying-glass me-4"></i>
                <span>Search</span>
            </li>

            <!-- Offcanvas Section -->
            <div style="width: 250px" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasEExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Search Form -->
                    <form action="{{route('post.search')}}" class="d-flex" role="search" method="POST">
                        @csrf
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <li class="w3-bar-item w3-button d-flex align-items-center ms-4" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="fa-solid fa-list me-4"></i>
                <span>More</span>

                <div style="width: 250px" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div  style="margin-left: 40px" class="dropdown mt-3">
                            <!-- Dropdown Toggle Button -->
                            <button class ="d-flex" style=" margin-bottom: 15px; margin-top:20px;background-color: white ; color:black;border:none;">
                                <i class="fa-solid fa-user m-1" ></i>
                                <a  style="margin-left:12px " class="dropdown-item hover-bg-grey" href="{{route('profile.show', Auth::user()->id)}}">Profile</a>
                            </button>
                            <button class ="d-flex" style=" margin-bottom: 15px; margin-top:20px;background-color: white ; color:black;border:none;">
                                <i class="fa-solid fa-image-portrait m-1" ></i>
                                <a style="margin-left:12px "class="dropdown-item hover-bg-grey" href="{{route('post.show', Auth::user()->id)}}">Post</a>
                            </button>
                            <button class ="d-flex" style="margin-bottom: 15px; margin-top:20px; background-color: white ; color:black;border:none;">
                                <i class="fa-solid fa-user m-1" ></i>
                                <a style="margin-left:12px " class="dropdown-item hover-bg-grey" href="{{route('tag.create')}}">Tag</a>
                            </button>
                            <button class ="d-flex" style=" margin-bottom: 15px; margin-top:20px; background-color: white ; color:black;border:none;">
                                <i class="fa-solid fa-user m-1" ></i>
                                <a style="margin-left:12px " class="dropdown-item hover-bg-grey" href="{{route('logout')}}">Logout</a>
                            </button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- Bootstrap JS (Bundle includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
