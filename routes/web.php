<?php

use App\Http\Controllers\getDataController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
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
//Route::get('/sample', function(){
//    $oProgram = ProgramModel::all();
//    foreach($oProgram as $oVal){
//        $oProgCat = collect(DB::select('select * from r_program_categories where match(title) against(?) limit 1', [$oVal->program]))->first();
//        $iPordCatId = $oProgCat->id ?? null;
//        DB::update('update r_program set program_category_id = ? where id = ?',
//            [$iPordCatId, $oVal->id]);
//    }
//});
Route::get('/get/data-source', [getDataController::class, 'get']);
Route::get('/get/data', [getDataController::class, 'debug']);

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
