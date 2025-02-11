<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\view\View;
//use Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function showRegistration():View
    {
        return view('user.register');
    }
    public function showLogin(): View
    {
        return view('user.login');
    }
    public function showHomePage(): View
    {
        return view('home');
    }
    public function showDashboard():View
    {
        return view('user.dashboard');
    }
    public function registerUser(RegisterRequest $request)    //The method returns a RedirectResponse type, meaning that after the action is performed, the user is redirected to another page
    {
        // Retrieve validated input data
        $validateRegisterData = $request->validated();
        //validating the value
        $user_email = $validateRegisterData['email'];
        $username = $validateRegisterData['username'];
        $name = $validateRegisterData['name'];
        $password = $validateRegisterData['password'];
        //fetch the data from the database
        $findUsername = User::where('username', $username)->first();
        while ($findUsername){
            $randUsername =  $username . rand(200, 9999);
            return back()->withErrors(provider: ['username'=>'The username has already been taken try '.$randUsername]);
        }
//        while ($findUsername) {
//            // Generate a new u sername
//            $randUsername = $username . rand(200, 9999);
//            // Set the error message
//            return back()->withErrors(['username' => 'The username has already been taken. Try ' . $randUsername]);
//        }
        //store the value in hash
        $hashed_password = Hash::make($password);
        User::create([
            'email' => $user_email,
            'username' => $username,
            'name' => $name,
            'password' => $hashed_password
        ]);
        return redirect()->route('login');


    }
    public function authenticateLogin(LoginRequest $request)
    {
        // Retrieve validated input data
        $validateLogin=$request->validated();
        //store the validated data
        $mainData = $validateLogin['loginMainData'];
        $password = $validateLogin['password'];

        //checking the user type for the user input
        if (User::where('email',$mainData)->exists()) {
            $type= "email";
        }elseif(User::where('username',$mainData)->exists()){
            $type= "username";
        }else {
            return back()->withErrors(['errors' => "The provided credentials doesn't exist."]);
        }
        //authenticate the user
        if (Auth::attempt([$type => $mainData , 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home') ;
        }
        else{
            return back()->withErrors(['errors' => 'Password Incorrect.']);
        }


    }
    //function to logout the current authenticartion
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}


//return redirect()->route('home')->with('success', 'User '. Auth::user()->name .' logged in successfully');
