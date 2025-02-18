<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Style for the scrollable box */
        .tag-box {
            width: 100%;
            height: 200px; /* Set the height as needed */
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .tag-box label {
            display: block;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
@include('navigation')

<div class="main_div">
    <div class="child_div_1" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <h1>POST</h1>
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
            @csrf
            {{-- hidden input to pass the user id --}}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            {{-- first div for caption --}}
            <div class="mb-3">
                {{-- label for caption --}}
                <label for="caption" class="form-label"><strong>Caption</strong></label>
                {{-- text area to input the caption --}}
                <textarea name="caption" class="form-control" rows="4"></textarea>
            </div>

            {{-- first div for caption --}}
            <div class="mb-3">
                {{-- label for input image --}}
                <label for="post_image" class="form-label"><strong>Image</strong></label>
                {{-- image file input --}}
                <input class="form-control" type="file" name="post_image">
                @error('post_image')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="post_tag" class="form-label"><strong>Tag</strong></label>
                {{-- input for tags --}}
                <input id="tagInput" class="form-control" name="tags">
                <button type="button" onclick="add()">Add</button>
            </div>
            @error('tags.*')
            <div style="color: red;">{{ $message }}</div>
            @enderror

            {{-- added tags will be displayed --}}
            <ul id="tagList"></ul>

            {{-- for error --}}
            <div style="color: red;" id="error_display"></div>

            <button style="width: 100px;" class="btn btn-primary" type="submit">Post</button>
        </form>

        <script>
            let tags = [];

            function add() {
                var retrieveElement = document.getElementById("tagInput");
                // store the value and trim the spaces
                var tagInputValue = retrieveElement.value.trim();

                // check if the tag is null or not null and present in the array or not
                if (tagInputValue) {
                    if(tagInputValue.length <3){
                        document.getElementById('error_display').innerHTML = "Tag length must be at least 3 char";
                    }else{
                        document.getElementById('error_display').innerHTML = "";
                        tags.push(tagInputValue); // adding to an array
                        updateTagList();
                    }
                } else {
                    document.getElementById('error_display').innerHTML = "Tag cannot be empty";
                }
                retrieveElement.value = ""; // clearing an input after the input is processed
            }

            function updateTagList() {
                //calling the taglist unordered list
                const tagList = document.getElementById("tagList");
                tagList.innerHTML = ""; // refresh the un ordered list before updating
                //loop for the array
                tags.forEach((tag, index) => {
                    const li = document.createElement("li");
                    li.textContent = tag;
                    const removeButton = document.createElement("button");
                    removeButton.textContent = "X";
                    removeButton.style.marginLeft = "10px";

                    removeButton.onclick = function () {
                        tags.splice(index, 1); // Remove tag from array
                        updateTagList(); // Re-render the updated list
                    };
                    li.appendChild(removeButton);
                    tagList.appendChild(li);

                    addTagInput(index, tag);
                });
            }

            function addTagInput(index, tag) {
                const form = document.getElementById("postForm");

                // Create a hidden input for the tag with a dynamic name
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "tags[" + (index + 1) + "]"; // Use the index for the key (1-based index)
                input.value = tag;

                form.appendChild(input);
            }
        </script>
    </div>
</div>

</body>
</html>
