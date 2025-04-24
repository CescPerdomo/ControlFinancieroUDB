<<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;

Route::get('/prueba', [PruebaController::class, 'index']);
