<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

// Registration and login routes
Route::get('/register', [ViewController::class, 'showRegistrationForm'])->name('register.view');

Route::get('/login', [ViewController::class, 'showLoginForm'])->name('login');

// Dashboard and transactions routes (require authentication)

Route::get('/transactions', [ViewController::class, 'showTransactions'])->name('transactions');
