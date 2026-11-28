<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('bookings.index');
});

Route::resource('rooms', RoomController::class)->except(['show']);
Route::resource('instruments', InstrumentController::class)->except(['show']);
Route::resource('bookings', BookingController::class)->except(['show']);