<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

Route::middleware('auth')->group(function(){
//    Route::get('/home/dashboard',[UserController::class,'showDashboard'])->name('dashboard');
    Route::post('/addProfile/{id}',[ProfileController::class,'addProfile'])->name('addProfile');
    Route::get('/home/profile/{id}',[ProfileController::class,'showCreateProfile'])->name('showProfile');
});


