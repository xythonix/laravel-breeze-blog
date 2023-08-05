<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// GUEST CONTROLLER
Route::controller(GuestController::class)
->group(function(){
    // FOR BLOG PAGE
    Route::get('/','blogPage')
    ->name('guest.home');
    // FOR LOGIN PAGE
    Route::get('/login','login')
    ->name('login');
    // FOR REGISTER
    Route::get('/register','register')
    ->name('register');
    // SINGLE BLOG POST
    Route::get('/post/{id}','moveSingle')
    ->name('guest.singlePost');
    // SINGLE CATEGORY PAGE
    Route::get('/cat_post/{id}','categoryPosts')
    ->name('guest.category');
    // SINGLE AUTHOR
    Route::get('/author/{id}','authorPosts')
    ->name('guest.author');
    // SEARCH POST
    Route::get('/search','searchData')
    ->name('guest.search');
});

// FOR AUTHENTICATED USER ONLY
Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CATEGORY CONTROLLER
    Route::controller(CategoryController::class)
    ->group(function(){
        // FOR MOVING TO CATEGORY PAGE
        Route::get('/category','index')
        ->name('view.category');
        // FOR INSERTING CATEGORY DATA
        Route::post('/category/submit','insertData')
        ->name('post.category');
        // FOR DELETING SINGLE CATEGORY
        Route::get('/category/{id}','deleteData')
        ->name('view.del_category');
    });

    // POST CONTROLLER
    Route::controller(PostController::class)
    ->group(function(){
        // FOR MAIN BLOG PAGE
        Route::get('/blog','blogPage')
        ->name('guest.blog');
        // FOR DASHBOARD DATA
        Route::get('/dashboard','dashboard')
        ->name('dashboard'); 
        // FOR MOVING TO ADD POST PAGE
        Route::get('/add_post','index')
        ->name('view.add_post');
        // FOR INSERTING POST 
        Route::post('/add_post','insertData')
        ->name('post.add_post');
        // FOR MOVING TO POSTS PAGE
        Route::get('/posts','movePosts')
        ->name('view.posts');
        // FOR DELETING POST
        Route::get('/posts/delete/{id}/{cat_id}','deleteData')
        ->name('view.del_post');
        // FOR VIEWING SINGLE POST
        Route::get('/post/singlepost/{id}','moveViewPost')
        ->name('view.single');
        // FOR MOVING TO UPDATE PAGE
        Route::get('/update_post/{id}/{cat_id}','moveUpdatePost')
        ->name('view.update_post');
        // FOR UPDATING POST
        Route::post('/update_post/submit/{id}/{cat_id}','updateData')
        ->name('post.update_post');
    });
});

require __DIR__.'/auth.php';
