<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;

Route::apiResource('libros', LibroController::class);
Route::get('/libros', [LibroController::class, 'index']);