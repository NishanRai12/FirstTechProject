<?php
namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRegistration()
    {
        return view('user.register');
    }
    public function showLogin()
    {
        return view('user.login');
    }
    public function showHomePage()
    {
        return view('home');
    }
    public function registerUser(Request $request)
    {
        // dd($request->email);

        //creating a rule for validation Type -2 Array
        $validateRegisterData = $request->validate([
            'email' => ['required', 'email','unique:users,email'],
            'name' => ['required', 'max:100'],
            'username' => ['required','min:6'],
            'password' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'min:6']
        ]);
        //the validateRegisterData arrray holds the vailated data whish is now store din a new variable
        $user_email = $validateRegisterData['email'];
        $username = $validateRegisterData['username'];
        $name = $validateRegisterData['name'];
        $password = $validateRegisterData['password'];
        $confirmPassword = $validateRegisterData['confirmPassword'];
        //fetch the data from the database
        $findUsername= User::where('username', $username)->first();
        if($findUsername){
            $generateData= $username.rand(200,9999);
            // return back()->with(compact('generateData'));
            return back()->withErrors(['username'=> 'Username already exist,try '. $generateData]);
        } else{
            if ($password == $confirmPassword) {
                //store the value in hash 
                $hashed_password = Hash::make($password);
                User::create([
                    'email' => $user_email,
                    'username' => $username,
                    'name' => $name,
                    'password' => $hashed_password
                ]);
                return redirect()->route('login');
            } else {
                session()->flash('Rerror', 'Password didnt match');
                return back();
            }
        } 
        //checking the email validity
        // $findEmail = User::where('email', $user_email)->first();
        // if ($findEmail) {
        //     return back()->with('Rerror', 'Email already exists');
        // } else {
            
        // }
    }
    public function authenticateLogin(Request $request){
        //validating the login credential format
        $validateLogin = $request->validate([
            'emailUserName'=> ['required'],
            'password'=>['required','min:6']
        ]);
        //store the validated password
        $emailName = $validateLogin['emailUserName'];
        $password = $validateLogin['password'];

        $fetchUserCredentials = User::where('email', $emailName)->orWhere('username',$emailName)->first();
                
        if( $fetchUserCredentials){
            //fetched password related to the query
            $fetchedPassword= $fetchUserCredentials->password;
            //comparring using hash
            if(Hash::check($fetchedPassword, $password)){
                return redirect()->route('home');
            } else {
            return back()->with('error','Password didnt matched');
               
            }
        }else{
            return back()->with('error','User doesnt exist');
        }

    }
}