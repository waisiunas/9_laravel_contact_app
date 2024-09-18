<?php

use App\Http\Controllers\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('category/{id}/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('category/create', [CategoryController::class, 'store'])->name('category.create');
Route::get('category/{id}/show', [CategoryController::class, 'show'])->name('category.show');
Route::patch('category/{id}/edit', [CategoryController::class, 'update'])->name('category.edit');
