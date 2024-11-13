<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('utilisateurs', UtilisateurController::class);
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,
'logout']);
