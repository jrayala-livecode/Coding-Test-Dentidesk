<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\IncomeCategoryController;
use App\Http\Controllers\API\ExpenseCategoryController;
use App\Http\Controllers\API\TotalsController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('incomes', IncomeController::class);
    Route::apiResource('expenses', ExpenseController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/monthly-total', [TotalsController::class, 'monthlyTotal']);
    Route::get('/get-income-expenses-category', [TotalsController::class, 'getIncomeAndExpensesByCategory']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('api.register');

Route::middleware('auth:sanctum')->get('/check-auth', function (Request $request) {
    return response()->json(['message' => 'Authenticated']);
});


Route::get('/expense-categories', [ExpenseCategoryController::class, 'index']);
Route::get('/expense-categories/{expenseCategory}', [ExpenseCategoryController::class, 'show']);

Route::get('/income-categories', [IncomeCategoryController::class, 'index']);
Route::get('/income-categories/{incomeCategory}', [IncomeCategoryController::class, 'show']);
