<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;

Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/create',[UsersController::class, 'create']);
Route::post('/users/store',[UsersController::class, 'store']);
Route::get('/users/edit/{id}',[UsersController::class, 'edit']);
//Route::get('/users/update/{id}',[UsersController::class, 'update']);
Route::patch('/users/update/{id}',[UsersController::class, 'update']);
Route::delete ('/users/destroy/{id}',[UsersController::class, 'destroy']);
Route::get ('/users/show/{id}',[UsersController::class, 'show']);
Route::post ('/users/update_status',[UsersController::class, 'update_status']);


Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/create',[ProductsController::class, 'create']);
Route::post('/products/store',[ProductsController::class, 'store']);
Route::get('/products/edit/{id}',[ProductsController::class, 'edit']);
//Route::get('/users/update/{id}',[UsersController::class, 'update']);
Route::patch('/products/update/{id}',[ProductsController::class, 'update']);
Route::delete ('/products/destroy/{id}',[ProductsController::class, 'destroy']);
Route::get ('/products/show/{id}',[ProductsController::class, 'show']);











//Route::get('/users/store',[UsersController::class, 'store']);
//Route::get('/users/store', [ 'as' => 'users.store', 'uses' => 'UsersController@store']);

//Route::get('/users/create',['as'=>'create','uses'=>'UserController@create']);


//Route::get('/users/edit', [ 'as' => 'users.edit', 'uses' => 'UsersController@edit']);

//Route::get('/users/show', [ 'as' => 'users.show', 'uses' => 'UsersController@show']);

//Route::get('/users/update', [ 'as' => 'users.update', 'uses' => 'UsersController@update']);

//Route::get('/users/destory', [ 'as' => 'users.destroy', 'uses' => 'UsersController@destroy']);




