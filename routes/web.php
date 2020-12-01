<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logged-in', function () {
    return redirect(Auth::user()->role . DS . 'thread');
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.role']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/thread', function () {
            return view('thread');
        })->name('thread-user');
        Route::get('/import', function () {
            return view('import');
        })->name('import-user');
    });
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.role']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        });
    });
});
