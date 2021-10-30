<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

// APIのルート定義
Route::middleware(['api'])->prefix('api')->group(function () {
    // ログイン用ルート
    Route::post('/login', [LoginController::class,'authenticate']);
    //認証済の場合にアクセス可能なルートの定義
    Route::middleware(['auth'])->group(function () {
        //ダッシュボード
        Route::get('/', [DashboardController::class,'index']);
    });
});
