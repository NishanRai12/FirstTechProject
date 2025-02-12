<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Use paginate on the query builder before executing the query
        $tagData = Tag::where('user_id', Auth::user()->id)->simplePaginate(5);

        // Set the default value for searched
        $searched = -1;

        // Return the view with the paginated data
        return view('tag.create', compact('tagData', 'searched'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
//        dd($request);
        $validateTag = $request->validated();
        Tag::create([
            'user_id'=> $request->input('user_logged'),
            'tag_name' => $validateTag ['tag_name'],
        ]);
        return redirect()->route('tag.create') ->with('success', 'Tag created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        if(Tag::where('user_id',$id)->exists()){
            $tagData = Tag::where('user_id', $id)->get(); // Fetch data for the specific user
//        }
        return view('tag.show',['tagData'=>$tagData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fetchedTag=Tag::where('id', $id)->first();
        return view('tag.edit', compact('fetchedTag'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $id)
    {
        $validateTag = $request->validated();
        $tagName= $validateTag['tag_name'];
        if(Tag::where('id', $id)->exists()){
            $findTag= Tag::where('id', $id)->first();
            $findTag->update([
                'tag_name' => $tagName
            ]);
        }
            return redirect()->route('tag.create') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request){
        if(Tag::where('tag_name',$request->input('search_tag'))->exists()){
            $searched= Tag::where('tag_name',$request->input('search_tag'))->first();
            return view('tag.create',['searched'=>$searched]);
        }else {
            return redirect()->route('tag.create')->with('error', 'Tag not found');
        }
    }
}
