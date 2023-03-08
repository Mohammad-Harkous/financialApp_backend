<?php
use App\Http\Controllers\RecTransactionsController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Api\AuthController;

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
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category', [CategoryController::class, 'index']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);


Route::post('/goal', [GoalController::class, 'store']);
Route::get('/goal', [GoalController::class, 'index']);
Route::get('/goal/active', [GoalController::class, 'active']);
Route::patch('/goal/{id}', [GoalController::class, 'update']);
Route::delete('/goal/{id}', [GoalController::class, 'destroy']);




// Route::resource('recurrence',RecTransactionsController::class);

Route::get ('/recurrence', [RecTransactionsController::class ,'index']);
Route::post ('/recurrence', [RecTransactionsController::class ,'store']);
Route::get ('/recurrence/{id}', [RecTransactionsController::class ,'show']);
Route::patch ('/recurrence/{id}', [RecTransactionsController::class ,'update']);
Route::delete ('/recurrence/{id}', [RecTransactionsController::class ,'destroy']);
Route::get ('/recurrence/search/{ent}', [RecTransactionsController::class ,'search']);
Route::delete ('/recurrence/end/{id}/{date}', [RecTransactionsController::class ,'end']);






// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{id}', [UsersController::class, 'show']);
    Route::patch('/users/{id}', [UsersController::class, 'update']);
    Route::delete('/users/{id}', [UsersController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
