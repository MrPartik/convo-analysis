<?php

use App\Http\Controllers\getDataController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use App\Library\utils;
use App\Models\ProgramCategoryModel;
use App\Models\ProgramModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
Route::get('/sample', function() {
    return \preg_match('/suc/' ,'suc sattelite');
    return (new \App\WitApp())->getUtterances();
    $aCourses = \explode(',', 'BACHELOR IN BANKING AND FINANCE , BACHELOR OF SCIENCE IN CRIMINOLOGY');
    return utils::getStringedArray($aCourses);
});

Route::get('/get/data-source', [getDataController::class, 'get']);
(\config('app.env') === 'local') && Route::get('/get/data', [getDataController::class, 'debug']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logged-in', function () {
    return redirect(Auth::user()->role);
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.role']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [ThreadController::class, 'bot_front']);
        Route::get('/dashboard', [ThreadController::class, 'front']);
        Route::get('/library', [LibraryController::class, 'front']);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.role']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [UserController::class, 'front']);
        Route::get('/import', [ImportController::class, 'front']);
    });
});
