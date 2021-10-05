<?php

use Illuminate\Support\Facades\Route;
use GetroXer\Http\Controllers\WorldProviderController;

    Route::middleware('guest')->group(function () {
        Route::get('world-population/get-population', [\GetroXer\WorldPopulation\Http\Controllers\WorldPopulationController::class, 'getPopulation']);
    });
