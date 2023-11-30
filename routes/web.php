<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;  

Route::post('/login',[AuthController::class,'index'])->name('login');
Route::get('/login/logout',[LoginController::class,'logout']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/login/checklogin', [LoginController::class, 'checklogin']);

Route::get('/users', [UsersController::class, 'index'])->middleware('auth');
Route::get('/users/create',[UsersController::class, 'create'])->middleware('auth');
Route::post('/users/store',[UsersController::class, 'store'])->middleware('auth');
Route::get('/users/edit/{id}',[UsersController::class, 'edit'])->middleware('auth');
Route::patch('/users/update/{id}',[UsersController::class, 'update'])->middleware('auth');
Route::delete ('/users/destroy/{id}',[UsersController::class, 'destroy'])->middleware('auth');
Route::get ('/users/show/{id}',[UsersController::class, 'show'])->middleware('auth');
Route::post ('/users/update_status',[UsersController::class, 'update_status'])->middleware('auth');
Route::post ('/users/add_fav',[UsersController::class, 'add_fav'])->middleware('auth');

Route::get('/products', [ProductsController::class, 'index'])->middleware('auth');
Route::get('/products/create',[ProductsController::class, 'create'])->middleware('auth');
Route::post('/products/store',[ProductsController::class, 'store'])->middleware('auth');
Route::get('/products/edit/{id}',[ProductsController::class, 'edit'])->middleware('auth');
Route::patch('/products/update/{id}',[ProductsController::class, 'update'])->middleware('auth');
Route::delete ('/products/destroy/{id}',[ProductsController::class, 'destroy'])->middleware('auth');
Route::get ('/products/show/{id}',[ProductsController::class, 'show'])->middleware('auth');

Route::get ('/products/view/',[ProductsController::class, 'view'])->middleware('auth');



Route::get('/categories', [CategoriesController::class, 'index'])->middleware('auth');
Route::get('/categories/create',[CategoriesController::class, 'create'])->middleware('auth');
Route::post('/categories/store',[CategoriesController::class, 'store'])->middleware('auth');
Route::get('/categories/edit/{id}',[CategoriesController::class, 'edit'])->middleware('auth');
Route::patch('/categories/update/{id}',[CategoriesController::class, 'update'])->middleware('auth');
Route::delete ('/categories/destroy/{id}',[CategoriesController::class, 'destroy'])->middleware('auth');
Route::get ('/categories/show/{id}',[CategoriesController::class, 'show']);

Route::get('/stocks', [StocksController::class, 'index'])->middleware('auth');
Route::get('/stocks/create',[StocksController::class, 'create'])->middleware('auth');
Route::post('/stocks/store',[StocksController::class, 'store'])->middleware('auth');
Route::get('/stocks/edit/{id}',[StocksController::class, 'edit'])->middleware('auth');
Route::patch('/stocks/update/{id}',[StocksController::class, 'update'])->middleware('auth');
Route::delete ('/stocks/destroy/{id}',[StocksController::class, 'destroy'])->middleware('auth');
Route::get ('/stocks/show/{id}',[StocksController::class, 'show'])->middleware('auth');

