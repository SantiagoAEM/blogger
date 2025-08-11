<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class); //Resource crea las rutas CRUD
Route::resource('posts', PostController::class);
Route::resource('tags', TagController::class);


?>