<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlaceImageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/places', [PlaceController::class, 'index'])->name('places');

// Add a place
Route::post('/places/add', [PlaceController::class, 'addPlace'])->name('places.add');

// Delete a place
Route::delete('/places/{place}', [PlaceController::class, 'delete'])->name('places.delete');

// Edit a place
Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('places.edit');

// Update a place
Route::post('/places/{place}/update', [PlaceController::class, 'update'])->name('places.update');

// Add an image to a place
Route::post('/places/{place}/image', [PlaceImageController::class, 'create'])
    ->name('places.image.create');
