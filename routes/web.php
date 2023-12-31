<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

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

//routing tipo clouser
// Route::get('/', function () {
//     return view('principal');
// });
//esto solo se utiliza cuando crear un controller que solo va tener un metodo se utiliza la funcion invoke
Route::get('/',HomeController::class)->name('home');

//rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class,'index'])->name("perfil.index");
Route::post('/editar-perfil',[PerfilController::class,'store'])->name("perfil.store");

Route::get('/crear-cuenta',[RegisterController::class,"index"]);
Route::post('/crear-cuenta',[RegisterController::class,"store"]);

Route::get('/login',[LoginController::class,"index"])->name("login");
Route::post('/login',[LoginController::class,"store"]);
Route::post('/logout',[LogoutController::class,"store"])->name("logout");

//route model binding -- se convierte en una variable para imprimir por url el username
Route::get('/{user:username}', [PostController::class, "index"])-> name("posts.index");
Route::get('posts/create',[PostController::class, "create"])-> name("posts.create");
Route::post('/posts',[PostController::class, "store"])->name("posts.store");
// Route::get('/posts/{post}',[PostController::class,"show"])->name("posts.show");
Route::get('/{user:username}/posts/{post}', [PostController::class, "show"])-> name("posts.show");
//route model binding se puede tener con 2 variables y modelos diferentes si
Route::delete('posts/{post}',[PostController::class, "destroy"])-> name("posts.destroy");

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, "store"])-> name("comentarios.store");

Route::post('/imagenes',[ImagenController::class,"store"])->name("imagenes.store");

//like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,"store"])->name("posts.likes.store");
Route::delete('/posts/{post}/likes',[LikeController::class,"destroy"])->name("posts.likes.destroy");

//seguir a usuarios
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name("users.follow");
//deja de seguir usuarios
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name("users.unfollow");
