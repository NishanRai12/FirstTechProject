<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $pathOfPhoto = null;

        // Handle file upload
        if ($request->hasFile('post_image')) {
            $pathOfPhoto = $request->file('post_image')->store('uploads', 'public');

        }

        $validatePostRequest = $request->validated();
        Post::create([
            'user_id'=>Auth::id(),
            'caption' => $validatePostRequest['caption'],
            'post_image'=>$pathOfPhoto
        ]);

        return redirect()->route('post.show',Auth::id());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fetchPost = Post::where('user_id', $id)->get();
        return view('post.show', ['userPost' => $fetchPost, 'empty' => 'No post found']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fetchPost= Post::where('id', $id)->first();
        return view('post.edit', ['post' => $fetchPost]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $findPost = Post::where('id', $id)->first();
        if($findPost){
            $findPost->update([
                'caption' => $request['caption'],
            ]);
        }
        return back()->with(['success' => 'Post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Post::where('id', $id)->exists()){
            $fetchData= Post::where('id', $id)->first();
            $fetchData->delete();
        }
//        dd('abc');
        return redirect()->route('post.show',Auth::user()->id);
    }
}
