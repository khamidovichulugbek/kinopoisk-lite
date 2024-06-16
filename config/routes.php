<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MoviesController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;
use App\Middlewares\AuthMiddlewares;
use App\Middlewares\GuestMiddlewares;
use App\Middlewares\AdminMiddlewares;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/movie', [HomeController::class, 'oneMovie']),
    Route::post('/movie', [HomeController::class, 'ratingCreate']),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddlewares::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddlewares::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::get('/admin/categories/create', [CategoryController::class, 'index'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::post('/admin/categories/create', [CategoryController::class, 'create'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::post('/admin/categories/delete', [CategoryController::class, 'delete'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::get('/admin/categories/update', [CategoryController::class, 'edit'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::post('/admin/categories/update', [CategoryController::class, 'update'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::get('/admin/movies/create', [MoviesController::class, 'index'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::post('/admin/movies/create', [MoviesController::class, 'create'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::post('/admin/movies/delete', [MoviesController::class, 'delete'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::get('/admin/movies/update', [MoviesController::class, 'edit'], [AdminMiddlewares::class, AuthMiddlewares::class]),
    Route::post('/admin/movies/update', [MoviesController::class, 'update'], [AdminMiddlewares::class, AuthMiddlewares::class]),
];
