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
<br>
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

        </tr>
        </thead>
        <tbody>
        {{--condition if the search action is not initiated--}}
        @if( $searched === -1)

            @foreach($tagData as $displayData)
                <tr>
                    <td>{{$displayData->tag_name}}</td>
                    <td>{{$displayData->created_at}}</td>
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
</body>
{{--condition if the search action is not initiated--}}
@if( $searched === -1)
    <div style="display: flex; justify-content: center" class="pagination">
        {{ $tagData->links() }}
    </div>
@endif
</html>
