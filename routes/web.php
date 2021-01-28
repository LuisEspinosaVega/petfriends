<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

//Buscar usuario (❁´◡`❁)
Route::post('/searchuser',[App\Http\Controllers\HomeController::class, 'search'])->name('search');

//Rutas del HOME
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
Route::patch('/account', [App\Http\Controllers\HomeController::class, 'update'])->name('account.update');
Route::get('/profile/{username}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

//Completar el perfil (Se usara en varios modulos)
Route::post('/completeprofile', [App\Http\Controllers\HomeController::class, 'completeProfile'])->name('completeprofile');

//Rutas para guardar post
Route::post('/post', [App\Http\Controllers\PostController::class, 'create'])->name('post');
Route::delete('/post', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'detail'])->name('post.detail');
Route::patch('/post', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

//Ruta para follow/unfollow
Route::post('/community/{user}', [App\Http\Controllers\FollowerController::class, 'store'])->name('community.store');
Route::get('/community', [App\Http\Controllers\FollowerController::class, 'index'])->name('community');
Route::get('/community/messages', [App\Http\Controllers\FollowerController::class, 'messages'])->name('community.messages');
Route::post('/community', [App\Http\Controllers\FollowerController::class, 'send'])->name('community.send');
Route::get('/community/messages/{username}', [App\Http\Controllers\FollowerController::class, 'conversation'])->name('community.conversation');

//Modulo sales
Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index'])->name('sales');
Route::get('/sales/create', [App\Http\Controllers\SaleController::class, 'create'])->name('sales.create');
Route::post('/sales', [App\Http\Controllers\SaleController::class, 'store'])->name('sales.store');
Route::get('/sales/{sale}', [App\Http\Controllers\SaleController::class, 'sale'])->name('sales.sale');
Route::get('/sales/list/{username}', [App\Http\Controllers\SaleController::class, 'list'])->name('sales.list');
Route::get('/sales/list/product/{sale}', [App\Http\Controllers\SaleController::class, 'edit'])->name('sales.edit');
Route::patch('sales/list/{id}/edit', [App\Http\Controllers\SaleController::class, 'update'])->name('sales.update');
Route::delete('sales/destroy/{sale}', [App\Http\Controllers\SaleController::class, 'destroy'])->name('sales.destroy');

//rutas para modulo adopcion
Route::get('/adoption', [App\Http\Controllers\AdoptionController::class, 'index'])->name('adoption');
Route::get('/adoption/create', [App\Http\Controllers\AdoptionController::class, 'create'])->name('adoption.create');
Route::post('/adoption', [App\Http\Controllers\AdoptionController::class, 'store'])->name('adoption.store');
Route::get('/adoption/edit/{adoption}', [App\Http\Controllers\AdoptionController::class, 'edit'])->name('adoption.edit');
Route::patch('/adoption/{adoption}/edit', [App\Http\Controllers\AdoptionController::class, 'update'])->name('adoption.update');
Route::delete('/adoption/{adoption}', [App\Http\Controllers\AdoptionController::class, 'destroy'])->name('adoption.destroy');
Route::get('/adoption/detail/{adoption}', [App\Http\Controllers\AdoptionController::class, 'detail'])->name('adoption.detail');

//Solicitudes
Route::get('/adoption/requests', [App\Http\Controllers\AdoptionController::class, 'requests'])->name('adoption.requests');
Route::get('/adoption/requests/create/{adoption}', [App\Http\Controllers\AdoptionController::class, 'createRequest'])->name('adoption.requests.create');
Route::post('/adoption/requests', [App\Http\Controllers\AdoptionController::class, 'storeRequest'])->name('adoption.requests.store');
Route::get('/adoption/requests/{request}', [App\Http\Controllers\AdoptionController::class, 'detailRequest'])->name('adoption.requests.detail');
Route::delete('/adoption/requests', [App\Http\Controllers\AdoptionController::class, 'deleteRequest'])->name('adoption.requests.delete');
Route::patch('/adoption/requests/cancel', [App\Http\Controllers\AdoptionController::class, 'cancelRequest'])->name('adoption.requests.cancel');

Route::get('/adoption/process', [App\Http\Controllers\AdoptionController::class, 'process'])->name('adoption.process');
Route::get('/adoption/process/{adoption}', [App\Http\Controllers\AdoptionController::class, 'processDetail'])->name('adoption.process.detail');
