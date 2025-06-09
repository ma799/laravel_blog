<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(
    function () {


    Route::resources([
    'categories'=>CategoryController::class,
    'posts'=>PostController::class,
    'tags'=>TagController::class,
    ]);
    Route::get('trashed-posts',[PostController::class,'trash'])->name('posts.trash');
    Route::put('restore-posts/{post}',[PostController::class,'restore'])->name('posts.restore');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/blog/post/{post}',[App\Http\Controllers\BlogPostController::class, 'show'])->name('blogPosts.show');

Route::get('/blog/category/{category}',[App\Http\Controllers\WelcomeController::class, 'category'])->name('blogPosts.category');

Route::get('/blog/tag/{tag}',[App\Http\Controllers\WelcomeController::class, 'tag'])->name('blogPosts.tag');

Route::middleware(['auth','admin'])->group(function(){
     Route::get('/users',[UserController::class,'index'])->name('users.index');
     Route::post('/users/{user}/makeAdmin',[UserController::class,'makeAdmin'])->name('users.makeAdmin');
     
     Route::get('/users/editProfile',[UserController::class,'edit'])->name('users.editProfile');
     Route::put('/users/updateProfile',[UserController::class,'update'])->name('users.updateProfile');
});
