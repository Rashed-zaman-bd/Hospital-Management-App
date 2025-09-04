<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use Faker\Guesser\Name;
use Symfony\Component\Translation\MessageCatalogue;

Route::get('/', [DoctorController::class, 'index'])->name('page.index');
Route::get('/about', function () {return view('frontend.pages.about_page');})->name('page.about');
Route::get('/services', function () {return view('frontend.pages.services_page');})->name('page.services');
Route::get('/departments', function () {return view('frontend.pages.departments_page');})->name('page.departments');
Route::get('/contact', function () {return view('frontend.pages.contact_page');})->name('page.contact');
Route::get('/appointment-page', function () { return view('frontend.pages.appointment_page'); })->name('page.appointment');
Route::post('/message-store', [MessageController::class, 'store'])->name('message.store');
Route::post('/appointment-store', [AppointmentController::class, 'store'])->name('appointment.store');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('user-logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-logout', [AdminController::class, 'logout'])->name('admin-logout');

    Route::get('/backend-message', [MessageController::class, 'index'])->name('backend.message');
    Route::get('/backend-message-show/{id}', [MessageController::class, 'show'])->name('backend.message.show');
    Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('delete.message');

    Route::get('/admin', [UserController::class, 'index'])->name('admin.user');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('backend.user.store');
    Route::delete('/admin/user/{request}', [UserController::class, 'destroy'])->name('delete.user');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('backend.user.update');

    Route::get('/backend/doctor', [DoctorController::class, 'show'])->name('backend.doctor');

});

//Route::get('/dashboard', function () {
//    return view('backend.index');
//})->middleware(['auth', 'verified'])->name('');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
