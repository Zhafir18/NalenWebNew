<?php

use App\Http\Controllers\ProductController;

Route::get('home', [ProductController::class, 'index'])->name('home');
Route::get('/products/index', [ProductController::class, 'productIndex'])->name('products.index');
Route::get('/products/all', [ProductController::class, 'allProducts'])->name('products.all');
Route::get('/products/create', [ProductController::class, 'showForm'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/{product_id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/product/{product_id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'deletes'])->name('products.deletes');
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');
