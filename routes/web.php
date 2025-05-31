<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;

// Home page (optional)
Route::get('/', function () {
    return view('welcome');
});

// Product routes
Route::resource('products', ProductController::class)->parameters(['products' => 'slug']);
// Post routes
Route::resource('posts', PostController::class)->parameters(['posts' => 'slug']);

// Page routes
Route::resource('pages', PageController::class)->parameters(['pages' => 'slug']);