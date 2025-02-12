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
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        {{--condition if the search action is not initiated--}}
        @if( $searched === -1)

            @foreach($tagData as $displayData)
                <tr>
                    <td>{{$displayData->tag_name}}</td>
                    <td>{{$displayData->created_at}}</td>
                </tr>
            @endforeach
        @else
            {{--condition if the search action is initiated--}}
            @foreach($searched as $displayData)
                <tr>
                    <td>{{$displayData->tag_name}}</td>
                    <td>{{$displayData->created_at}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endif
</body>
{{--condition if the search action is not initiated--}}
@if( $searched === -1)
    <div class="pagination">
        {{ $tagData->links() }}
    </div>
@endif
</html>
