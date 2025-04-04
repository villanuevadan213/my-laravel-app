<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

Route::view('/', 'home');
Route::view('/dashboard', 'dashboard');
Route::view('/sales', 'sales');

Route::resource('audits', AuditController::class);

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/create', [ItemController::class, 'create']);
Route::post('/items', [ItemController::class, 'store'])->middleware('auth');
Route::get('/items/{item}', [ItemController::class, 'show']);

Route::get('/items/{item}/edit', [ItemController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'item');

Route::patch('/items/{item}', [ItemController::class, 'update']);
Route::delete('/items/{item}', [ItemController::class, 'destroy']);

Route::get('/pos', [POSController::class, 'index'])->name('pos');
Route::post('/pos/checkout', [POSController::class, 'checkout'])->name('checkout');

//Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);