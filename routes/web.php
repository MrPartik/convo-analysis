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
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

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
Route::get('/sample', function () {
    $sText = 'get the suc of bachelor of science in information technology sample kudasai';
    $sFind = 'bachelor of science in information technology';
    $iIndex = strrpos($sText, $sFind);
    $sSubstring = substr($sText, $iIndex, strlen($sFind));
    dd($sSubstring);
    $aData = [
        [
            'text' => 'get the suc of bachelor of science in information technology',
            'intent' => 'getSuc',
            'entities' => [
                [
                    'entity' => '_BACHELOR_OF_SCIENCE_IN_INFORMATION_TECHNOLOGY_:_BACHELOR_OF_SCIENCE_IN_INFORMATION_TECHNOLOGY_',
                    'start' => 15,
                    'end' => 62,
                    'body' => 'bachelor of science in information technology',
                    'entities' => []
                ]
            ],
            'traits' => []
        ]
    ];
    return (new \App\WitApp())->trainApp($aData);
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
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [UserController::class, 'front']);
    });
    Route::get('/import', [ImportController::class, 'front']);
});
