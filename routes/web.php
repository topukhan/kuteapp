<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Posts\CreatePost;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //components
    Route::get('/counter', Counter::class,);
    Route::get('/create-post', CreatePost::class,);
    //home controller 
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/notify', [HomeController::class, 'notify'])->name('notify');
    Route::get('/markAsRead/{id}', [HomeController::class, 'markAsRead'])->name('markAsRead');
    //App
    Route::get('/app', [HomeController::class, 'app'])->name('app');

    // Post Controller
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Like Controller
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');

    //Comment Controller 
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Friend List
    Route::get('/friendList', [HomeController::class, 'friendList'])->name('friendList');
    //Friend Request 
    Route::post('/friendList/{user}/send-request', [FriendController::class, 'sendFriendRequest'])->name('sendFriendRequest');
    Route::post('/friendList/{user}/accept-request', [FriendController::class, 'acceptFriendRequest'])->name('acceptFriendRequest');



});

require __DIR__ . '/auth.php';
