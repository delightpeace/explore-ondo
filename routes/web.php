<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FeaturedProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
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
Route::post('/newsletter/subscribe', NewsletterController::class)
    ->middleware('throttle:5,1')
    ->name('newsletter.subscribe');
Route::get('/newsletter/subscribers', [NewsletterController::class, 'index'])
    ->middleware(SuperAdminAccess::class)
    ->name('newsletter.subscribers');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');
Route::get('/places/{place}', [ExploreController::class, 'show'])->name('explore.show');
Route::get('/about-ondo', [ExploreController::class, 'aboutOndo'])->name('about-ondo');
Route::get('/people-and-businesses', [ExploreController::class, 'peopleAndBusinesses'])->name('people-businesses');

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

Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.dashboard');

Route::get('/admin/categories', [CategoryController::class, 'index'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.categories');
Route::post('/admin/categories', [CategoryController::class, 'store'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.categories.store');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.categories.destroy');

Route::get('/admin/featured-profiles', [FeaturedProfileController::class, 'index'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.featured-profiles');
Route::post('/admin/featured-profiles', [FeaturedProfileController::class, 'store'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.featured-profiles.store');
Route::put('/admin/featured-profiles/{profile}', [FeaturedProfileController::class, 'update'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.featured-profiles.update');
Route::delete('/admin/featured-profiles/{profile}', [FeaturedProfileController::class, 'destroy'])
    ->middleware(SuperAdminAccess::class)
    ->name('admin.featured-profiles.destroy');

// Add a place
Route::post('/places/add', [PlaceController::class, 'addPlace'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.add');

// Delete a place
Route::delete('/places/{place}', [PlaceController::class, 'delete'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.delete');

// Edit a place
Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.edit');

// Update a place
Route::put('/places/{place}', [PlaceController::class, 'update'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.update');

// Add an image to a place
Route::post('/places/{place}/image', [PlaceImageController::class, 'create'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.image.create');

// Delete an image from a place
Route::delete('/places/{place}/images/{image}', [PlaceImageController::class, 'destroy'])
    ->middleware(SuperAdminAccess::class)
    ->name('places.image.delete');
