<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WebsiteController;

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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/', [WebsiteController::class, 'landingPage'])->name('landingPage');
Route::get('/booking_page', [WebsiteController::class, 'bookingPage'])->name('bookingPage');
Route::get('/{id}/detail', [WebsiteController::class, 'detailPage'])->name('detailPage');
Route::get('/booking_form/{id}', [WebsiteController::class, 'bookingForm'])->name('bookingForm');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/contact_us', [WebsiteController::class, 'contactUs'])->name('contactUs');
Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'indexAdmin'])->name('admin.dashboard');
    Route::resource('boardingHouses', BoardingHouseController::class);
    Route::get('regencies/{id}', [RegencyController::class, 'index']);
    Route::get('districts/{id}', [DistrictController::class, 'index']);
    Route::get('villages/{id}', [VillageController::class, 'index']);
    Route::resource('facilities', FacilityController::class);
    Route::resource('roomTypes', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::post('files', [FileController::class, 'store'])->name('file.store');
    Route::post('files/remove', [FileController::class, 'removeFile'])->name('file.remove');
    Route::resource('customers', CustomerController::class);
    Route::get('customers/{customer}/updateStatus', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');
    Route::resource('bookings', BookingController::class)->except('store');
    Route::get('bookings/{booking}/updateStatus/{status}', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('transactions/{transaction}/updateStatus', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
    Route::get('messages/{message}/updateStatus', [MessageController::class, 'updateStatus'])->name('messages.updateStatus');
    Route::view('invoices', 'transactions.invoice');
    Route::get('/exportexcel', [TransactionController::class, 'exportexcel'])->name('exportexcel');
    Route::get('/exportexcelmessage', [MessageController::class, 'exportexcelmessage'])->name('exportexcelmessage');
});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('customer/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('transactions', TransactionController::class);
    Route::resource('messages', MessageController::class);
});