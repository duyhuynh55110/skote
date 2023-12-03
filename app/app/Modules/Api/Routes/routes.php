<?php

use App\Modules\Api\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'domain' => 'api.skote.local',
        'middleware' => ['api']
    ],
    function () {
        Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:firebase-auth-jwt');
        Route::post('/sign-up', [AuthController::class, 'signInByAccessToken']);
    }
);
