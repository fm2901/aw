<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/{order}/edit/', [OrderController::class, 'edit'])->name('orders.edit')->middleware(['can:edit orders']);
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update')->middleware(['can:edit orders']);
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create')->middleware(['can:create purchases']);
    Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit')->middleware(['can:create purchases']);
    Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update')->middleware(['can:create orders']);
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store')->middleware(['can:create orders']);
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/purchases/', [PurchaseController::class, 'index'])->name('purchases.index');

    Route::get('/users/', [UserController::class, 'index'])->name('users.index')->middleware(['can:edit users']);
    Route::get('/users/edit/{id?}', [UserController::class, 'edit'])->name('users.edit')->middleware(['can:edit users']);
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware(['can:edit users']);

    Route::delete('/photos/{id}', [FileController::class, 'destroy'])->name('photo.delete')->middleware(['can:edit orders']);
});


require __DIR__.'/auth.php';
