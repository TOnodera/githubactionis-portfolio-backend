<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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


// APIのルート定義
Route::middleware(['api'])->prefix('api')->group(function () {
    // ログイン用ルート
    Route::post('/login', [LoginController::class,'authenticate']);
    //認証済の場合にアクセス可能なルートの定義
    Route::middleware(['auth'])->group(function () {
        //ダッシュボード
        Route::get('/', [DashboardController::class,'index']);
        //ブログ
        Route::get('/blogs', [BlogController::class,'index']);
        //ユーザー
        Route::get('/users', [UserController::class,'index']);
        //ロール
        Route::get('/roles', [RoleController::class,'index']);
        Route::post('/roles', [RoleController::class, 'create']);
    });
});
