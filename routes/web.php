<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return redirect()->route('schedules.index');
});

Route::resource('drivers', DriverController::class);
Route::resource('buses', BusController::class);
Route::resource('routes', RouteController::class);
Route::resource('schedules', ScheduleController::class);

Route::get('/', function () {
    return view('welcome');
});
