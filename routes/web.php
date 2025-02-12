<?php

use App\Http\Controllers\PostController;
//use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.login');
});
Route::get('/navigation',function(){
    return view('navigation');
});

//display the home
Route::get('/home',[UserController::class,'showHomePage'])->name('home');


//getting the login credentials
Route::post('/user_login',[UserController::class,'authenticateLogin'])->name('userLog');
//middleware passing required route  if the user is logged in
Route::middleware('auth')->group(function(){
    Route::resource('profile',ProfileController::class)->except('index','destroy');
    Route::resource('post',PostController::class);
//logout
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::resource('tag',TagController::class);
    Route::post('/tag/search', [TagController::class, 'search'])->name('tag.search');
});
//middleware  passing home if logged in
Route::middleware('nonauthCheck')->group(function(){
    //display the register page
    Route::get('/register',[UserController::class,'showRegistration'])->name('register');
//display the login page
    Route::get('/login',[UserController::class,'showLogin'])->name('login');
    //register the new user
    Route::post('/register',[UserController::class,'registerUser'])->name('setUser');
});


