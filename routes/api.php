<?php
use App\Http\Controllers\RecTransactionsController;

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

// Route::resource('recurrence',RecTransactionsController::class);

Route::get ('/recurrence', [RecTransactionsController::class ,'index']);
Route::post ('/recurrence', [RecTransactionsController::class ,'store']);
Route::get ('/recurrence/{id}', [RecTransactionsController::class ,'show']);
Route::patch ('/recurrence/{id}', [RecTransactionsController::class ,'update']);
Route::delete ('/recurrence/{id}', [RecTransactionsController::class ,'destroy']);
Route::get ('/recurrence/search/{title}', [RecTransactionsController::class ,'search']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
