<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashierController;
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


Route::get('/', [CashierController::class, 'index'])->name('cashier.index');
Route::post('/cashier', [CashierController::class, 'store'])->name('cashier.store');
Route::get('/cashier/cart', [CashierController::class, 'showCart'])->name('cashier.cart');
Route::post('/cashier/cart', [CashierController::class, 'addToCart'])->name('cart.add');
Route::delete('/cashier/cart/{id}', [CashierController::class, 'removeFromCart'])->name('cart.delete');
Route::get('/cashier/checkout', [CashierController::class, 'checkout'])->name('checkout');
Route::get('/cashier/receipt/{id}', [CashierController::class, 'printReceipt'])->name('cashier.receipt');
Route::delete('/cashier/transaction/{id}', [CashierController::class, 'destroy'])->name('cashier.transaction.destroy');
Route::get('/cashier/item/create', [CashierController::class, 'create'])->name('cashier.create');
Route::post('/cashier/item', [CashierController::class, 'storeItem'])->name('cashier.storeItem');
Route::get('/cashier/item/{id}/edit', [CashierController::class, 'edit'])->name('cashier.edit');
Route::put('/cashier/item/{id}', [CashierController::class, 'update'])->name('cashier.update');

// Route untuk Hapus Item
Route::delete('/cashier/item/{id}', [CashierController::class, 'delete'])->name('cashier.delete');