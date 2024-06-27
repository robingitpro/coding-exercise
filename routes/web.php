<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::resource('customers', CustomerController::class);
        Route::resource('invoices', InvoiceController::class);
    }
);
