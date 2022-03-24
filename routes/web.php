<?php

use App\Http\Controllers\Accountant\ReportController as AccountantReportController;
use App\Http\Controllers\Documents\DocumentController;
use App\Http\Controllers\Reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth',
])->group(function () {
    Route::prefix('/documents')->name('documents.')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('index');
        Route::get('/{document}', [DocumentController::class, 'show'])->name('show');
    });

    Route::prefix('/reports')->name('reports.')->group(function () {
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::get('/{report}', [ReportController::class, 'show'])->name('show');
        Route::get('/{report}/approve', [ReportController::class, 'update'])->name('approve');
    });

    Route::prefix('/accountant')->name('accountant.')->group(function () {
        Route::view('/', 'accountant.index')->name('index');
        Route::get('/report', [AccountantReportController::class, 'create'])->name('create');
    });
});
