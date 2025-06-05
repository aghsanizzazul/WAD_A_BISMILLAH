<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelatihController;

Route::middleware('api')->group(function () {
    Route::apiResource('pelatih', PelatihController::class);
});