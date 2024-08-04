<?php

use App\Http\Controllers\__Auth\AuthController;
use App\Http\Controllers\BlogController;
use Auth0\Laravel\Facade\Auth0;
use Illuminate\Http\Request;
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




Route::get('/', [BlogController::class, 'index'])->name('blogs.index');


Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');

    Route::post('blogs/', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});
