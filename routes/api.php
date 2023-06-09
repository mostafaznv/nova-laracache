<?php

use Illuminate\Support\Facades\Route;
use Mostafaznv\NovaLaraCache\Http\Controllers\Api\EntityController;
use Mostafaznv\NovaLaraCache\Http\Controllers\Api\GroupController;
use Mostafaznv\NovaLaraCache\Http\Controllers\Api\ListController;
use Mostafaznv\NovaLaraCache\Http\Controllers\Api\StatsController;

Route::as('nova-laracache.')->middleware('nova')->group(function () {
    Route::get('stats', StatsController::class)->name('stats');
    Route::get('list', ListController::class)->name('stats');

    Route::prefix('entity')->name('entity.')->group(function () {
        Route::get('show', [EntityController::class, 'show'])->name('show');
        Route::post('refresh', [EntityController::class, 'refresh'])->name('refresh');
        Route::post('delete', [EntityController::class, 'delete'])->name('delete');
    });

    Route::prefix('group')->name('group.')->group(function () {
        Route::post('refresh', [GroupController::class, 'refresh'])->name('refresh');
        Route::post('delete', [GroupController::class, 'delete'])->name('delete');
    });
});
