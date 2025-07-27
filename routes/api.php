<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function(){
    Route::get('/', [UserProfileController::class, 'index']);
    Route::post('/', [UserProfileController::class, 'create']);
    Route::get('/{id}', [UserProfileController::class, 'show']);
    Route::put('/{id}', [UserProfileController::class, 'update']);
    Route::delete('/{id}', [UserProfileController::class, 'destroy']);
});
