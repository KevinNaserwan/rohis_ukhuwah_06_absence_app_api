<?php

use App\Http\Controllers\AbsencesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserClassesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::delete('/user/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');


// UserClass routes
Route::get('/classes', [UserClassesController::class, 'index'])->middleware('auth:sanctum');
Route::get('/classes/{id}', [UserClassesController::class, 'show'])->middleware('auth:sanctum');
Route::post('/classes', [UserClassesController::class, 'store'])->middleware('auth:sanctum');
Route::put('/classes/{id}', [UserClassesController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/classes/{id}', [UserClassesController::class, 'destroy'])->middleware('auth:sanctum');

// Absence routes
Route::get('/absences', [AbsencesController::class, 'index'])->middleware('auth:sanctum');
Route::get('/absences/{id}', [AbsencesController::class, 'show'])->middleware('auth:sanctum');

// QR code generation for students
Route::post('/absences/generate-qr', [AbsencesController::class, 'generateQrCode'])->middleware('auth:sanctum');

// QR code scanning and absence recording for admin
Route::post('/absences/scan-qr', [AbsencesController::class, 'scanQrCode'])->middleware('auth:sanctum');
