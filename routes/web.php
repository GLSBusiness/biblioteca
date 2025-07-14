<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/api/libros', [LibroController::class, 'index']);
Route::get('/api/libros/{id}', [LibroController::class, 'show']);
Route::post('/api/libros', [LibroController::class, 'store']);
Route::put('/api/libros/{id}', [LibroController::class, 'update']);
Route::delete('/api/libros/{id}', [LibroController::class, 'destroy']);
