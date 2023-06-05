<?php

use Illuminate\Support\Facades\Route;
use Mostafaznv\NovaLaraCache\Http\Controllers\EntityController;
use Mostafaznv\NovaLaraCache\Http\Controllers\ListController;
use Mostafaznv\NovaLaraCache\Http\Controllers\StatsController;

Route::as('nova-laracache.')->middleware('nova')->group(function () {
    Route::get('stats', StatsController::class)->name('stats');
    Route::get('list', ListController::class)->name('stats');

    Route::prefix('entity')->group(function () {
        Route::get('show', [EntityController::class, 'show'])->name('show');
        Route::post('refresh', [EntityController::class, 'refresh'])->name('refresh');
        Route::post('delete', [EntityController::class, 'delete'])->name('delete');
    });
});
