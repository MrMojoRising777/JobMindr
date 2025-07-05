<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('/profile')->controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::post('/import', [ExcelController::class, 'import'])->name('excel.import');

    Route::prefix('/companies')->controller(CompanyController::class)->name('companies.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{company}', 'show')->name('show');
    });

    Route::prefix('/contacts')->controller(ContactController::class)->name('contacts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/{contact?}', 'storeOrUpdate')->name('store');
        Route::get('/{contact}', 'show')->name('show');
    });

    Route::prefix('/applications')->controller(ApplicationController::class)->name('applications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{application}', 'show')->name('show');

        Route::post('/filter', 'filter')->name('filter');
    });
});

require __DIR__.'/auth.php';
