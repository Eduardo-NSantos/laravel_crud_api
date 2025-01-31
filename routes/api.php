<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json(
        [
            'status' => 'ok',
            'message' => 'API is running'
        ]
    );
});

Route::apiResource('/clients', ClientController::class);

Route::post('/login', [AuthController::class, 'login']);
