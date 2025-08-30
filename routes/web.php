<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {return view('index');})->name('page.index');

Route::get('/about', function () {return view('frontend.pages.about_page');})->name('page.about');
Route::get('/services', function () {return view('frontend.pages.services_page');})->name('page.services');
Route::get('/departments', function () {return view('frontend.pages.departments_page');})->name('page.departments');
Route::get('/contact', function () {return view('frontend.pages.contact_page');})->name('page.contact');
Route::get('/appointment-page', function () { return view('frontend.pages.appointment_page'); })->name('page.appointment');

Route::post('/message-store', [MessageController::class, 'store'])->name('message.store');
Route::post('/appointment-store', [AppointmentController::class, 'store'])->name('appointment.store');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
