<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/orders/edit/{id?}', [OrderController::class, 'edit'])->name('orders.edit')->middleware(['can:create orders']);
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store')->middleware(['can:create orders']);
    Route::get('/orders/', [OrderController::class, 'index'])->name('orders.index');


    Route::get('/purchases/edit', [PurchaseController::class, 'edit'])->name('purchases.edit')->middleware(['can:create orders']);
    Route::post('/purchases/store', [PurchaseController::class, 'store'])->name('purchases.store')->middleware(['can:create orders']);
    Route::get('/purchases/{id}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/purchases/', [PurchaseController::class, 'index'])->name('purchases.index');
});


require __DIR__.'/auth.php';
