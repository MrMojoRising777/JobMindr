<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/profile')->controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::post('/import', [ExcelController::class, 'import'])->name('excel.import');

    Route::prefix('/companies')->controller(CompanyController::class)->name('companies.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/{company?}', 'storeOrUpdate')->name('store');
        Route::get('/{company}', 'show')->name('show');
    });

    Route::prefix('/contacts')->controller(ContactController::class)->name('contacts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/{contact?}', 'storeOrUpdate')->name('store');
        Route::get('/{contact}', 'show')->name('show');
    });

    Route::prefix('/applications')->controller(ApplicationController::class)->name('applications.')->group(function () {
        Route::get('/stats', 'stats')->name('stats');

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{application}', 'show')->name('show');
        Route::put('/{application}', 'update')->name('update');

        Route::post('/filter', 'filter')->name('filter');
    });
});

require __DIR__.'/auth.php';
