<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\PostRequest;  // Correct request class


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//index for authenticated user
    public function index()
    {
        $posts = Post::with(['user','tags'])->latest()->paginate(10);
        return view('post.index', ['posts' => $posts]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('post.create', ['tags' => $tags]);
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

        // Validate and create the post
        $validated = $request->validated();
        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $validated['caption'],
            'post_image' => $pathOfPhoto,
        ]);


        $post->tags()->attach($request->input('tags'));

        return redirect()->route('post.show', Auth::user()->id);  // Redirect to the created post
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fetchPost = Post::where('user_id', $id)->simplePaginate(3);
//        $tagData = Tag::where('user_id', Auth::user()->id)->simplePaginate(5);

        return view('post.show', ['userPost' => $fetchPost, 'empty' => 'No post found']);
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $post = Post::with('tags')->findOrFail($id); // Fetch post with its tags
        $tags = Tag::all(); // Fetch all available tags

        return view('post.edit', compact('post', 'tags')); // Pass data to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $findPost = Post::where('id', $id)->first();
        $path = $findPost->post_image;
        if($request->hasFile('post_image')){
            $path = $request->file('post_image')->store('uploads', 'public');
        }
        if($findPost){
            $findPost->update([
                'caption' => $request['caption'],
                'post_image' => $path,
            ]);
        }
            $findPost->tags()->sync($request->input('tags'));
        return back()->with(['success' => 'Post updated successfully']);
    }
//    public function update(Request $request, string $id)
//    {
//        $findPost = Post::where('id', $id)->first();
//        if($findPost){
//            $findPost->update([
//                'caption' => $request['caption'],
//            ]);
//        }
//        return back()->with(['success' => 'Post updated successfully']);
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Post::where('id', $id)->exists()){
            $fetchData= Post::where('id', $id)->first();
            $fetchData->delete();
        }
        return redirect()->route('post.show',Auth::user()->id);
    }
    public function search(Request $request)
    {

        $term = $request->input('search');

        $posts = Post::WhereHas('tags', function ($query) use ($term) {
            $query->where('tag_name', 'like', '%' . $term . '%');
        })->orWhere('caption', 'like', '%' . $term . '%')
            ->orWhereHas('user', function($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');})
            ->distinct()
            ->get();


        return view('post.index', compact('posts'));
    }
    //for non authenticated user
    public function home(){
//        return view('post.index');
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }
}
