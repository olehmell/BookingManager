<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ImportMappingController;
use App\Http\Controllers\Imports\BookingImportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# Agents
Route::prefix('agents')->group(function () {
    Route::get('/', [AgentController::class, 'index'])->name('agents.index');
    Route::post('/', [AgentController::class, 'store'])->name('agents.store');
    Route::patch('{id}', [AgentController::class, 'update'])->name('agents.update');
    Route::get('{id}', [AgentController::class, 'show'])->name('agents.show');
    Route::delete('{id}', [AgentController::class, 'destroy'])->name('agents.destroy');

    # Agents Products
    Route::prefix('products')->group(function () {
        Route::post('/', [AgentProductController::class, 'store'])->name('agents.products.store');
    });
});

# Product Types
Route::prefix('types')->group(function() {
    Route::get('/', [ProductTypeController::class, 'index'])->name('types.index');
    Route::get('{id}', [ProductTypeController::class, 'show'])->name('types.show');
    Route::post('/', [ProductTypeController::class, 'store'])->name('types.store');
    Route::patch('{id}', [ProductTypeController::class, 'update'])->name('types.update');
    Route::delete('{id}', [ProductTypeController::class, 'destroy'])->name('types.destroy');
});

# Products
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::patch('{id}', [ProductController::class, 'update'])->name('products.update');
});

# Bookings
Route::prefix('bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('{id}', [BookingController::class, 'update'])->name('bookings.update');
});

# Booking Import
Route::prefix('bookings/import')->group(function () {
    Route::post('/', [BookingImportController::class, 'store'])->name('bookings.import.store');
    Route::patch('{id}/process', [BookingImportController::class, 'update'])->name('bookings.import.process');
});

Route::prefix('bookings/import/mappings')->group(function () {
    Route::post('/', [ImportMappingController::class, 'store'])->name('bookings.import.mappings.store');

});
