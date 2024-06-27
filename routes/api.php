<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('store', [ApiController::class, 'store'])->name('api.store');
Route::get('load', [ApiController::class, 'load'])->name('api.load');
Route::patch('edit', [ApiController::class, 'edit'])->name('api.edit');
