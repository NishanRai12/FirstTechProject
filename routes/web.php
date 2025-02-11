<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.login');
});
Route::get('/navigation',function(){
    return view('navigation');
});
//display the register page
Route::get('/register',[UserController::class,'showRegistration'])->name('register');
//display the login page
Route::get('/login',[UserController::class,'showLogin'])->name('login');
//display the home
Route::get('/home',[UserController::class,'showHomePage'])->name('home');

//register the new user
Route::post('/register',[UserController::class,'registerUser'])->name('setUser');

//getting the login credentials
Route::post('/user_login',[UserController::class,'authenticateLogin'])->name('userLog');
//logout
Route::get('/logout',[UserController::class,'logout'])->name('logout');
//Route::resource('register',RegisterController::class);
Route::middleware('auth')->group(function(){
    Route::resource('profile',ProfileController::class)->except('index','destroy');
    Route::resource('post',PostController::class)->except('index','destroy');
});


