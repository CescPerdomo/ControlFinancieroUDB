<<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', [DashboardController::class,'index'])->name('dashboard');

// Rutas de módulos existentes...
Route::resource('incomes', IncomeController::class);
Route::resource('expenses', ExpenseController::class);

// Ruta para exportar PDF
Route::get('/report/pdf', [ReportController::class,'exportPdf'])
     ->name('report.pdf');

