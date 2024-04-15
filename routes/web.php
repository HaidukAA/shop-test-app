<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// Маршруты для добавления, редактирования и удаления товаров
Route::middleware(['auth'])->group(function () {
    // Маршрут для создания нового товара
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');

    // Маршрут для редактирования товара (можно редактировать только созданный этим же пользователем)
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit')
        ->middleware('can:edit,product');

    // Маршрут для обновления информации о товаре
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update')
        ->middleware('can:update,product');

    // Маршрут для удаления товара (удалять может только админ)
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy')
        ->middleware('can:delete,product');
});

// Маршруты для просмотра товаров
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Маршруты для входа и выхода из системы
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/', [ProductController::class, 'index'])->name('home');

