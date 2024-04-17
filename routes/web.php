<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });


// Route::get('/dashboard/calendar', function () {
//     return view('/dashboard/calendar');
// });

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('dashboard/calendar', [CalendarController::class, 'index'])->name('calendar');