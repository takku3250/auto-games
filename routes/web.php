<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';

Route::get('/games', [GameController::class, "index"])->name("games.index");


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin'])->name('dashboard');

    require __DIR__.'/admin.php';
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});
Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('post.index');
    Route::post('/posts', 'store')->name('post.store');
    Route::get('/posts/create', 'create')->name('post.create');
    Route::get('/posts/{post}', 'show')->name('post.show');
    Route::put('/posts/{post}', 'update')->name('post.update');
    Route::delete('/posts/{post}', 'delete')->name('post.delete');
    Route::get('/posts/{post}/edit', 'edit')->name('post.edit');
});


Route::controller(PostController::class)->prefix('admin')->middleware(['auth:admin'])->group(function(){
    Route::get('/', 'index')->name('admin.index');
    Route::post('/posts', 'store')->name('admin.store');
    Route::get('/posts/create', 'create')->name('admin.create');
    Route::get('/posts/{post}', 'show')->name('admin.show');
    Route::put('/posts/{post}', 'update')->name('admin.update');
    Route::delete('/posts/{post}', 'delete')->name('admin.delete');
    Route::get('/posts/{post}/edit', 'edit')->name('admin.edit');
});
Route::get('/room/{room}/store', [UserController::class, 'store_message'])->name('store_message');
Route::post('/room/{room}/store', [UserController::class, 'store_message'])->name('store_message');


Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
Route::post('/matches', [MatchController::class, 'store'])->name('matches.store');
Route::get("/room/{room}",[MatchController::class, 'chatroom']);
Route::get("/matching/list",[MatchController::class,'match_list']);
Route::middleware(['auth'])->group(function () {
    //users.room(マッチングしたユーザーとチャットするルート）
    Route::get('/users/room/{user}', [UserController::class, 'room'])->name('users.room');
});
    //ユーザーとの個人メッセージの取得メソッド
    Route::get('/users/room/{user}/messages', [UserController::class, 'get_messages'])->name('get_messages');
    //ユーザーとの個人メッセージの保存・イベントの発火メソッド
    



