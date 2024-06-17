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
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'index']);
Route::delete('/user/{id}', [UserController::class, 'delete']);


// UserClass routes
Route::get('/classes', [UserClassesController::class, 'index']);
Route::get('/classes/{id}', [UserClassesController::class, 'show']);
Route::post('/classes', [UserClassesController::class, 'store']);
Route::put('/classes/{id}', [UserClassesController::class, 'update']);
Route::delete('/classes/{id}', [UserClassesController::class, 'destroy']);

// Absence routes
Route::get('/absences', [AbsencesController::class, 'index']);
Route::get('/absences/{id}', [AbsencesController::class, 'show']);

// QR code scanning and absence recording for admin
Route::post('/absences/scan-qr-code', [AbsencesController::class, 'scanQrCode']);
