<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('calendars.calendar');
});

Route::get('/calendar', function () {
    return view('calendars.calendar');
})->name('calendar.home');

// カレンダーのイベント
Route::controller(EventController::class)->group(function () {
    Route::get('events','index')->name('event.index');
    Route::get('/calendar/create', 'create')->name('event.create');
    Route::post('/calendar/store', 'store')->name('event.store');
    Route::get('/calendar/edit/{calendar}', 'edit')->name('event.edit');
    Route::put('/calendar/update/{calendar}', 'update')->name('event.update');
    Route::delete('/calendar/delete/{calendar}', 'destroy')->name('event.destroy');
    Route::get('/home', 'home')->name('event.home');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');