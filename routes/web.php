<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketplaceController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('marketplaces', MarketplaceController::class);
