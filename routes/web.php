<?php

use App\Http\Controllers\PusherController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Middleware\PreventDirectAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::post('/broadcast', [PusherController::class, 'broadcast']);
Route::post('/receive', [PusherController::class, 'receive']);

Route::get('/online', function () {
        // return view('online');
        abort('503');
});

Route::middleware(['logged_in'])->group(function () {
    
    Route::get('/puzzle', function () {
        return view('puzzle');
    });
    Route::get('/profile', [FirebaseController::class, 'profile']);
    
    Route::get('/shop', [FirebaseController::class, 'shop']);
    
    Route::post('/online-checkout', [FirebaseController::class, 'buy']);
    Route::post('/posts', [FirebaseController::class, 'posts']);
});

Route::get('/{route}', function ($route) {
    try{
        return view($route);
    } catch (Exception $e) {
        abort('404');
    }
});

Route::middleware(['is_admin'])->group(function () {
    Route::get('/shop/add', [FirebaseController::class, 'add']);
    Route::post('/shop/store', [FirebaseController::class, 'store']);
    Route::get('/shop/list', [FirebaseController::class, 'list']);

    Route::get('/shop/edit/{id}', [FirebaseController::class, 'edit']);
    Route::patch('/shop/update/{id}', [FirebaseController::class, 'update']);
    
    Route::delete('/shop/delete/{id}', [FirebaseController::class, 'destroy']);
});



Route::post('/register/new', [FirebaseAuthController::class, 'register']);
Route::post('/login/auth', [FirebaseAuthController::class, 'login']);
Route::post('/logout', [FirebaseAuthController::class, 'logout']);
