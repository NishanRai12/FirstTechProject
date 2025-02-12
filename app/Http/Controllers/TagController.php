<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
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
//    public function create()
//    {
////        $tagData = Tag::where('user_id', Auth::user()->id)->get()->paginate(5);
//        $tagData = Tag::where('user_id', Auth::user()->id)->simplePaginate(5);
//        //keeping it empty so that when the search is passed on the tag.create route it will display the variable
//        $searched=-1;
//        return view('tag.create', compact('tagData','searched'));
//    }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
