<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {
        $path= null;
//        check if the input has file or not

        if($request->hasfile('profile_picture')){
            $path = $request->file('profile_picture')->store('uploads','public');
        }
//        dd($path);
        $valaidatedBio=$request->validated();
        $bio=$valaidatedBio['bio'];
        $gender = $valaidatedBio['gender'];
        Profile::create([
            'user_id'=>$request['user_id'],
            'bio'=>$bio,
            'gender'=>$gender,
            'picture'=>$path
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Profile::where('user_id',$id)->exists()) {
            $fetchProfile = Profile::where('user_id',$id)->first();
            return view('profile.edit',compact('fetchProfile'));
        }else{
            return view('profile.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('profile.editProfile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, string $id)
    {
        $profile = Profile::where('user_id', $id)->first();
        $path= $profile->picture;
        if($request->hasfile('profile_picture')){
            $path = $request->file('profile_picture')->store('uploads','public');
        }
        $validatedData = $request->validated();
//        dd($path);
        $profile->update([
            'bio' => $validatedData['bio'],
            'gender' => $validatedData['gender'],
            'picture' => $path
        ]);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
