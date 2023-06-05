<?php

use Illuminate\Support\Facades\Route;
use Mostafaznv\NovaLaraCache\Http\Controllers\NovaLaraCacheController;

Route::get('/', [NovaLaraCacheController::class, 'home'])->name('nova-laracache.tool');
