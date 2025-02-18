<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Tag;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;

// Correct request class


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//index for authenticated user
    public function index()
    {
        $posts = Post::with(['user','tags'])->paginate(10);
        //passing empty value cause it will be later initialized by display tag

        return view('post.index', ['posts' => $posts,'tag_name' => "" ]);
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
        DB::transaction(function () use ($request) {
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
            //attach to the pivot file
            foreach ($request->tags as $tag) {
                if ( !Tag::where('tag_name',$tag)->exists()) {
                    Tag::Create([
                        'user_id' => Auth::user()->id,
                        'tag_name' => $tag
                    ]);
                }
                $post->tags()->attach(Tag::where('tag_name', $tag)->first());
            }
        });
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
        DB::transaction(function () use ($request, $id) {

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
            //accept the input
            $tags=$request->input('tags');
            //remove whitespaces
            $tags=trim($tags);
            //remove the patter and place in array
            $TagArray=preg_split("/#+/", $tags);
            //shift backward
            array_shift($TagArray);
            foreach ($TagArray as $tag) {
                if ( !Tag::where('tag_name',$tag)->exists()) {
                    Tag::Create([
                        'user_id' => Auth::user()->id,
                        'tag_name' => $tag
                    ]);
                }
                $findPost->tags()->sync(Tag::where('tag_name', $tag)->first());
            }
        });
//
//            $findPost->tags()->sync($request->input('tags'));
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
        $tag_name=""; //empty variable is passed because seach,tags post, and user post is dispaklyed in same so the null value is pased to prevent error of not existing value in this which exists in other
        $term = $request->input('search');

        $posts = Post::WhereHas('tags', function ($query) use ($term) {
            $query->where('tag_name', 'like', '%' . $term . '%');
        })->orWhere('caption', 'like', '%' . $term . '%')
            ->orWhereHas('user', function($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');})
            ->distinct() ->withCount('tags')
            ->get();

        return view('post.index', compact('posts','tag_name'));
    }
    //for non authenticated user
    public function home(){
        return view('post.index');
        $all = Tag::paginate();
//        $tag = $all->first();

//        $tag->users;
//        $tag->user_count;
//        $tag->tag_count;
//        $tag->posts;
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }
    //display post related to tags
    public function showTagRelatedPost($id){
        $tag_name = Tag::where('id', $id)->value('tag_name');
        //
////        $tags = Post::with('tags')->where('id', $id)->get();
//        $tags = Post:: whereHas('tags', function ($query) use ($id) {
//            $query->where('id', $id);
//        })->with('tags')->get();
//        //sending it to the  index page for display
        $tag = Tag::findOrFail($id);
//        This line performs eager loading, which means it loads both the posts and the associated user data for each post in a single query.
        $tag->load('posts.user'); //Eager load the posts and user that are related to the tag.
        $posts = $tag->posts;
        return view('post.index')->with(['posts' => $posts, 'tag_name'=> $tag_name]);


    }
}
