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
@include('navigation');
<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
{{--        <a href="{{route('tag.create')}}">Create Tag</a>--}}
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">New Tag</button>

        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style=" margin-left:17rem;height:50%; width: 80%;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasTopLabel">Add Tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="{{route('tag.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_logged" value="{{Auth::user()->id}}">
                    <div class="mb-3">
                        <label for="tag_name" class="form-label">Tag</label>
                        <input type="text" class="form-control" name="tag_name">
                    </div>
                    @error('tag_name')
                    <div style="color: red";>{{$message}}</div>
                    <br>
                    @enderror
                    @if(session('success'))
                        <div style="color: green";>{{session('success')}}</div>
                        <br>
                    @endif

                    <button type="submit">Save</button>
                </form>
            </div>
            <script>
                const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasTop'));

                // Add event listener to the close button
                document.querySelector('.btn-close').addEventListener('click', function() {
                    offcanvas.hide();
                });

                // Prevent form submission from closing offcanvas on validation error
                @if($errors->any())
                    window.onload = () => {
                    offcanvas.show();
                };
                @endif
            </script>

            <script>
                // Check if there is an error or success message to decide if the offcanvas should stay open or close
                document.getElementById('tagForm').addEventListener('submit', function(event) {
                    const errorMessage = document.querySelector('.error');
                    const successMessage = document.querySelector('.success');

                    // If there's no error, let it close; otherwise, prevent auto-close
                    if (errorMessage || !successMessage) {
                        var myOffcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasTop'));
                        myOffcanvas.show();  // Keep the offcanvas open when there's an error
                    }
                });
            </script>
        </div>
        <form action="{{route('tag.search')}}" method = "post">
            @csrf
            <div style="display: flex; flex-direction: row; justify-content: end; margin-bottom: 20px">
                <input type="search" placeholder="Search" name="search_tag">
                <button type="submit">Search</button>
            </div>
        </form>
        {{--    display error if the searched data is not found--}}
        @if(@session('error'))
            {{session('error')}}
        @else
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created</th>
                    <th scope="col">Posts</th>

                </tr>
                </thead>
                <tbody>
                {{--condition if the search action is not initiated--}}
                @if( $searched === -1)
                    @foreach($tagData as $displayData)
                        <tr>
                            <td>{{$displayData->tag_name}}</td>
                            <td>{{$displayData->created_at}}</td>
                            <td> <a href="{{(route('post.showTagRelatedPost', $displayData->id))}}">{{ $displayData->posts_count }}</td></a>
                            <td>
                                <div class="dropdown-center" style="display: flex; justify-content: end; ">
                                    <button style="background-color: white ; border: none;color : black ; place-content: center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('tag.edit',$displayData->id)}}" >Edit</a></li>
                                        <form method= "POST" action="{{route('tag.destroy',$displayData->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="Submit"> Delete</button>
                                        </form>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    {{--    displaying the result of search--}}
                    <tr>
                        <td>{{$searched->tag_name}}</td>
                        <td>{{$searched->created_at}}</td>
                        <td>
                            <div class="dropdown-center" style="display: flex; justify-content: end; ">
                                <button style="background-color: white ; border: none;color : black ; place-content: center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('tag.edit',$searched->id)}}" >Edit</a></li>
                                    <form method= "POST" action="{{route('tag.destroy',$searched->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" type="Submit"> Delete</button>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
{{--condition if the search action is not initiated--}}
@if( $searched === -1)
    <div style="display: flex; justify-content: center" class="pagination">
        {{ $tagData->links() }}
    </div>
@endif
</html>
