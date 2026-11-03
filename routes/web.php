<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlaceImageController;
use App\Http\Middleware\SuperAdminAccess;
use Illuminate\Support\Facades\Route;

// Route::get('test-email', function (){
//    return view('emails.reset-password', [
//        'email' => 'bamigboyebiodun@gmail.com',
//        'token' => '1234567890',
//    ]);
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/signup', [AuthController::class, 'signupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])
    ->middleware('throttle:5,1,signup')
    ->name('signup.submit');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.submit');

Route::view('/forgot-password', 'forgot-password')->name('password.request');
Route::get('/reset-password', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('throttle:5,1,password-reset')
    ->name('password.update');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/forgot-password', [AuthController::class, 'requestEMailToResetPassword'])
    ->middleware('throttle:5,1,password-request')
    ->name('requestEMailToResetPassword');

Route::get('/places', [PlaceController::class, 'index'])
    ->middleware(SuperAdminAccess::class)
    ->name('places');

// Add a place
Route::post('/places/add', [PlaceController::class, 'addPlace'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.add');

// Delete a place
Route::delete('/places/{place}', [PlaceController::class, 'delete'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.delete');

// Edit a place
Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit');

// Update a place
Route::post('/places/{place}/update', [PlaceController::class, 'update'])->name('places.update');

// Add an image to a place
Route::post('/places/{place}/image', [PlaceImageController::class, 'create'])
    ->name('places.image.create');
