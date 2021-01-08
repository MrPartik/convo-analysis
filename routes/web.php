<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

/**
 * sample api
 */
Route::get('/get/sample', function(){
    $sIntent = \request()->get('intent');
    $aData = [];
//    if($sIntent === 'getHeis')
        $aData = \Illuminate\Support\Facades\DB::select('SELECT PROGRAM id, HEI.region category, CITY sub_category, HEI.yr_established year , COUNT(*)  total FROM R_PROGRAM AS PROGRAM INNER JOIN R_HEI AS HEI ON PROGRAM.code = HEI.code GROUP BY city');
    return [
        'data_source' =>  $aData,
        'chart'       => \request()->get('chart') ?? 'bar'
    ];
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logged-in', function () {
    return redirect(Auth::user()->role);
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.role']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [ThreadController::class, 'front']);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.role']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [UserController::class, 'front']);
        Route::get('/import', [ImportController::class, 'front']);
    });
});
