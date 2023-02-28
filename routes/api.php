<?php

use App\Http\Controllers\CodificationController;
use App\Http\Controllers\InventaireController;
use App\Http\Controllers\PeriodeInventaireController;
use App\Http\Controllers\UsersController;
use App\Models\PeriodeInventaire;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::apiResource('users', UsersController::class);
Route::get('users', [UsersController::class, 'index']);
Route::post('users', [UsersController::class, 'store']);
Route::post('user/email', [UsersController::class, 'findByEmail']);
Route::get('user/{id}', [UsersController::class, 'show']);
Route::put('users/{id}', [UsersController::class, 'update']);

Route::get('codifications', [CodificationController::class, 'index']);
Route::get('codifications/{id}', [CodificationController::class, 'show']);
Route::get('codifications/n_inventaire/{n_inventaire}', [CodificationController::class, 'findByNIntenventaire']);
Route::post('codification', [CodificationController::class, 'store']);
Route::post('codifications', [CodificationController::class, 'stores']);
Route::put('codifications/{id}', [CodificationController::class, 'update']);

Route::get('periodeinentaire', [PeriodeInventaireController::class, 'index']);
Route::get('periodeinentaire/{id}', [PeriodeInventaireController::class, 'show']);
Route::post('periodeinentaire', [PeriodeInventaireController::class, 'store']);
Route::put('periodeinentaire/{id}', [PeriodeInventaireController::class, 'update']);
Route::patch('periodeinentaire/activeordiseable/{id}', [PeriodeInventaireController::class, 'activeOrDiseable']);

// Route::get('periodeinentaire/n_inventaire/{n_inventaire}', [CodificationController::class, 'findByNIntenventaire']);



Route::get('inventaires', [InventaireController::class, 'index']);
Route::get('inventaire/{id}', [InventaireController::class, 'show']);
Route::get('inventaires/{id_periode_inventaire}', [InventaireController::class, 'getByPeriode']);
Route::get('inventaires/codification/{id_codification}/periodeinventaire/{id_periode_inventaire}', [InventaireController::class, 'getInventaireByCodificationAndPeriodeInventaire']);
Route::post('inventaire', [InventaireController::class, 'store']);
Route::put('inventaire/{id}', [InventaireController::class, 'update']);

// Route::get('codifications/code_localisation/{code_localisation}', [CodificationController::class, 'show']);
