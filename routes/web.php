<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'index']);
Route::get('/nearby-stores', [UserController::class, 'getNearbyStores']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/stores', [StoreController::class, 'index'])->name('stores.index');
    Route::get('/admin/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/admin/stores', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/admin/stores/edit/{id}', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/admin/stores/{id}', [StoreController::class, 'update'])->name('stores.update');
    Route::delete('/admin/stores/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');
});

require __DIR__.'/auth.php';
