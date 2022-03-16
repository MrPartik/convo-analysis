<?php

use App\Http\Controllers\getDataController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use App\Library\utils;
use App\Models\AcademicYearModel;
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
Route::get('/entities', function () {
//    $aStringReplace = [
//        '.' => '--_--',
//        '/' => '_-__-_',
//        '(' => '_-__-',
//        ')' => '-__-_',
//        ' ' => '_',
//        '&' => '--_-_--'
//    ];
    // _-__-_ = /
    // --_--_ = .
    // _-__- = (
    // -__-_ = )
    // --_-_-- = &
//    $mValue = [];
//    return  (new \App\WitApp())->getIntentByText('get the summary of SUC in Bachelor of library & information science');
//    return  (new \App\WitApp())->getUtterances();
//    $aPrograms = (new \App\Services\libraryService(new \App\Repositories\libraryRepository()))->getAllPrograms();
//    return $aEntities = (new \App\WitApp())->getEntities();

//    foreach ($aPrograms as $sProgram) {
//        $sProgram = utils::convertEntityName($sProgram);
//        $mValue[] = $sProgram;
//    }
//    return $mValue;
//    $mValue = array_diff($mValue, $aEntities);
//    foreach ($mValue as $sProgram) {
//        try {
//            $mValue[] = (new \App\WitApp())->createEntities($sProgram, $sProgram);
//        } catch (Exception $exception) {
//
//        }
//    }

//    foreach ($aPrograms as $sProgram) {
//        $sProgram = '_' . str_replace(' ', '_', strtoupper(trim($sProgram))) . '_';
//        foreach($aStringReplace as $sSymbol => $sPattern) {
//            $sProgram = str_replace($sPattern, $sSymbol, $sProgram);
//        }
//        $mValue[] = $sProgram;
//    }
//    return $mValue;
});
Route::get('/sample', function () {
    $sText = 'get the suc of bachelor of science in information technology';
    $sFind = 'bachelor of science in information technology';
    $iIndex = strrpos($sText, $sFind);
    $sSubstring = substr($sText, $iIndex, strlen($sFind));
    $aData = [
        [
            'text' => $sText,
            'intent' => 'getSuc',
            'entities' => [
                [
                    'entity' => '_BACHELOR_OF_SCIENCE_IN_INFORMATION_TECHNOLOGY_:_BACHELOR_OF_SCIENCE_IN_INFORMATION_TECHNOLOGY_',
                    'start' => $iIndex,
                    'end' => $iIndex + strlen($sSubstring),
                    'body' => 'bachelor of science in information technology',
                    'entities' => []
                ]
            ],
            'traits' => []
        ]
    ];
    $aDataTobe = [
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
    return [$aData, $aDataTobe];
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
    Route::group(['prefix' => 'top'], function () {
        Route::get('/', [ThreadController::class, 'bot_front']);
        Route::get('/dashboard', [ThreadController::class, 'front']);
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [ThreadController::class, 'front']);
        Route::get('/library', [LibraryController::class, 'front']);
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [UserController::class, 'front']);
    });
    Route::get('/import', [ImportController::class, 'front']);
});
