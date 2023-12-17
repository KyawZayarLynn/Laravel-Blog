<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\MustBeAdmin;
use App\Http\Middleware\MustBeAuthUser;
use App\Mail\SubscriberMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware(MustBeAuthUser::class)->group(function () {

  Route::get('/', [BlogController::class, 'index']);

  Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->name('blogs.show');

  Route::post('/blogs/{blog:slug}/handle-subscriptions', [SubscriptionController::class, 'toggle']);

  Route::post('/subscribe',[SubscriptionController::class,'store']);

  Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);

  Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

  Route::get('/comments/{comment}/edit', [CommentController::class, 'edit']);

  Route::patch('/comments/{comment}/update', [CommentController::class, 'update']);

  Route::patch('/comments/{comment}/handle-publish',[CommentController::class, 'toggle']);

  Route::post('/logout', [LogoutController::class, 'destroy']);
});

Route::middleware(MustBeAdmin::class)->group(function (){
  Route::get('/admin',[AdminController::class,'index']);
  Route::get('/admin/blogs/create',[AdminController::class,'create']);
  Route::post('/admin/blogs/store',[AdminController::class,'store']);
  Route::get('/admin/blogs/{blog}/edit',[AdminController::class,'edit'])->middleware('can:edit,blog');
  Route::put('/admin/blogs/{blog}/update',[AdminController::class,'update'])->middleware('can:edit,blog');
  Route::delete('/admin/blogs/{blog}/destroy',[AdminController::class,'destroy'])->middleware('can:edit,blog');
});

Route::middleware('guest-user')->group(function () {
  
  Route::get('/register', [RegisterController::class, 'create']);

  Route::post('/register', [RegisterController::class, 'store']);

  Route::get('/login', [LoginController::class, 'create']);

  Route::post('/login', [LoginController::class, 'store']);
});
