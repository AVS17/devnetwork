<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

//Rutas para el registro de cuentas 
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

//Rutas para el Login
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class,'store'])->name('perfil.store');

//Rutas de los posts
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

//Rutas de los comentarios
Route::post('/{user:username}/posts/{post}',[CommentController::class,'store'])->name('comments.store');

//Rutas de imagenes 
Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');

//Like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');

//Varibles (recomendacion colorcarlas hasta la parte inferio sail php artisan route:list)
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

//Sigueindo usuarios
Route::post('{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');





