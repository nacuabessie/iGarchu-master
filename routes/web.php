<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front-End
// Authentication
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/', function () {
    return view('login');
})->name('login');



// Admin Route
Route::post('/api/login', [AdminController::class, 'login']);
Route::get('/api/logout', [AdminController::class, 'logout'])->name('logout');

//User Route
Route::get('/organization-request', [UserController::class, 'getAllOrganizationRequest'])->name("requests");
Route::put('/api/users/{userId}/accept', [UserController::class, 'acceptUser'])->name('users.accept');
Route::put('/api/users/{userId}/reject', [UserController::class, 'rejectUser'])->name('users.reject');

Route::get('/users', [UserController::class, 'getAllUsers'])->name("users");
Route::get('/api/users/{id}', [UserController::class, 'getUserById']);
Route::post('/api/users', [UserController::class, 'create']);
Route::put('/api/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/api/users/{id}', [UserController::class, 'deleteUser']);

Route::get('/donations', [DonationController::class, 'getAllDonations'])->name("donations");
Route::put('/api/donations/close/{donationId}', [DonationController::class, 'closeDonation'])->name("donations.close");
Route::get('/api/donations/{id}', [DonationController::class, 'getDonationById']);
Route::post('/api/donations', [DonationController::class, 'create']);
Route::put('/api/donations/{id}', [DonationController::class, 'updateDonation']);
Route::delete('/api/donations/{id}', [DonationController::class, 'deleteDonation']);

Route::get('/api/users/verification/{id}', [VerificationController::class, 'getVerificationById']);