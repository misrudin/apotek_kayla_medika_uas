<?php

use App\Exports\ProductsExport;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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


// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'register'])->middleware('guest');

// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');

// Logout Route
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

// Home Route (requires authentication)
Route::get('/', function () {
    return view('home.index');
})->middleware('auth')->name('home');

Route::middleware(['auth'])->prefix('master-data')->group(function () {
    Route::resource('products', ProductController::class);
    // Route::resource('category', ProductController::class);
});

Route::resource('transactions', TransactionController::class)->middleware('auth');

Route::middleware(['auth'])->prefix('report')->group(function () {
    Route::get('transactions', [ReportController::class, 'transactionPDF'])->name('report.transactions');
    Route::get('products', [ReportController::class, 'productPDF'])->name('report.products');

    Route::get('products/excel', function () {
        return Excel::download(new ProductsExport, 'products_report.xlsx');
    })->name('report.products.excel');
});

