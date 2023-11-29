<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StocksController;

Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/create',[UsersController::class, 'create']);
Route::post('/users/store',[UsersController::class, 'store']);
Route::get('/users/edit/{id}',[UsersController::class, 'edit']);
Route::patch('/users/update/{id}',[UsersController::class, 'update']);
Route::delete ('/users/destroy/{id}',[UsersController::class, 'destroy']);
Route::get ('/users/show/{id}',[UsersController::class, 'show']);
Route::post ('/users/update_status',[UsersController::class, 'update_status']);


Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/create',[ProductsController::class, 'create']);
Route::post('/products/store',[ProductsController::class, 'store']);
Route::get('/products/edit/{id}',[ProductsController::class, 'edit']);
Route::patch('/products/update/{id}',[ProductsController::class, 'update']);
Route::delete ('/products/destroy/{id}',[ProductsController::class, 'destroy']);
Route::get ('/products/show/{id}',[ProductsController::class, 'show']);



Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/create',[CategoriesController::class, 'create']);
Route::post('/categories/store',[CategoriesController::class, 'store']);
Route::get('/categories/edit/{id}',[CategoriesController::class, 'edit']);
Route::patch('/categories/update/{id}',[CategoriesController::class, 'update']);
Route::delete ('/categories/destroy/{id}',[CategoriesController::class, 'destroy']);
Route::get ('/categories/show/{id}',[CategoriesController::class, 'show']);

Route::get('/stocks', [StocksController::class, 'index']);
Route::get('/stocks/create',[StocksController::class, 'create']);
Route::post('/stocks/store',[StocksController::class, 'store']);
Route::get('/stocks/edit/{id}',[StocksController::class, 'edit']);
Route::patch('/stocks/update/{id}',[StocksController::class, 'update']);
Route::delete ('/stocks/destroy/{id}',[StocksController::class, 'destroy']);
Route::get ('/stocks/show/{id}',[StocksController::class, 'show']);