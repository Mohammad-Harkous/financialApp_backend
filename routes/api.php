<?php
use App\Http\Controllers\TransactionsController;

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


Route::get ('/transactions', [TransactionsController::class ,'index']);
Route::post ('/transactions', [TransactionsController::class ,'store']);
Route::get ('/transactions/{id}', [TransactionsController::class ,'show']);
Route::patch ('/transactions/{id}', [TransactionsController::class ,'update']);
Route::delete ('/transactions/{id}', [TransactionsController::class ,'destroy']);
Route::get ('/transactions/search/{title}', [TransactionsController::class ,'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
