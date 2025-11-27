<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\PassportPhotoController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\MutawwifController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/daftar', [HomeController::class, 'showRegistrationForm'])->name('registration.form');
Route::post('/daftar', [HomeController::class, 'register'])->name('registration.submit');
Route::get('/daftar/sukses', [HomeController::class, 'registrationSuccess'])->name('registration.success');

Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// API endpoint untuk mendapatkan informasi kontak (public)
Route::get('/api/contact-info', [ContactController::class, 'getContactInfo'])->name('api.contact.info');

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('passports', PassportController::class);
    Route::resource('passport-photos', PassportPhotoController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('mutawwifs', MutawwifController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('contacts', ContactController::class)->names('admin.contact');
});
