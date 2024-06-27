<?php

use App\Models\City;
use App\Models\Booking;
use App\Models\History;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');
    Route::get('/booking', [BookingController::class, 'view'])->name('booking');
    Route::get('/service', [ServiceController::class, 'view'])->name('service');
    Route::post('/service/booking', [ServiceController::class, 'serviceBooking'])->name('service.booking');
    Route::post('/api/fetch-vehicle-data', [ServiceController::class, 'fetchVehicle']);
    Route::get('/workshop', [WorkshopController::class, 'view'])->name('workshop');
    Route::get('/workshop/add', [WorkshopController::class, 'create'])->name('workshop.add');
    Route::post('/workshop/store', [WorkshopController::class, 'store'])->name('workshop.store');
    Route::post('/workshop/underway/{id}', [WorkshopController::class, 'underway'])->name('workshop.underway');
    Route::post('/workshop/{id}/update-status', [WorkshopController::class, 'updateStatus'])->name('workshop.updateStatus');
    Route::get('/transaction', [TransactionController::class, 'view'])->name('transaction');
    Route::post('/transaction/item/store', [TransactionController::class, 'storeItem'])->name('transaction.item.store');
    Route::get('/transaction/manage/{id}', [TransactionController::class, 'viewManage'])->name('transaction.manage');    
    Route::post('/transaction/manage/store', [TransactionController::class, 'storeManage'])->name('transaction.manage.store');    
    Route::get('/transaction/delete/{id}', [TransactionController::class, 'deleteTransaction'])->name('transaction.delete');
    Route::post('/api/fetch-item', [TransactionController::class, 'fetchItem']);
    Route::get('/history', [HistoryController::class, 'view'])->name('history');
    Route::get('/history/add', [HistoryController::class, 'view'])->name('history.add');
    Route::get('/province', [ProvinceController::class, 'view'])->name('province');
    Route::get('/province/add', [ProvinceController::class, 'create'])->name('province.add');
    Route::post('/province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('/city', [CityController::class, 'view'])->name('city');
    Route::get('/city/add', [CityController::class, 'create'])->name('city.add');
    Route::post('/city/store', [CityController::class, 'store'])->name('city.store');
    Route::get('/customer', [CustomerController::class, 'view'])->name('customer');
    Route::get('/customer/add', [CustomerController::class, 'create'])->name('customer.add');
    Route::get('/account', [AccountController::class, 'view'])->name('account');
    Route::get('/account/add', [AccountController::class, 'create'])->name('account.add');
    Route::post('/account/store', [AccountController::class, 'store'])->name('account.store');
    Route::get('/vehicle', [VehicleController::class, 'view'])->name('vehicle');
    Route::get('/vehicle/add', [VehicleController::class, 'create'])->name('vehicle.add');
    Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/booking', [BookingController::class, 'view'])->name('booking');
    Route::get('/booking/add', [BookingController::class, 'create'])->name('booking.add');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/workshop', [WorkshopController::class, 'view'])->name('workshop');
    Route::get('/workshop/add', [WorkshopController::class, 'create'])->name('workshop.add');
    Route::post('/workshop/store', [WorkshopController::class, 'store'])->name('workshop.store');
    Route::post('/api/fetch-vehicle', [WorkshopController::class, 'fetchVehicle']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'view'])->name('profile.view');
    Route::get('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change_password');
    Route::post('/profile/change-password/store', [UserController::class, 'storePassword'])->name('profile.store_password');
    Route::get('/profile/logout', [UserController::class, 'destroy'])->name('profile.logout');
    Route::post('api/fetch-city', [UserController::class, 'fetchCity']);
    Route::post('/profile/store', [UserController::class, 'store'])->name('profile.store');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Email verification routes
Route::middleware(['auth'])->group(function () {
    // Route::get('/email/verify', function () {
    //     return view('auth.verify-email');
    // })->name('verification.notice');

    // Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    //     $request->fulfill();
    //     return redirect('/dashboard');
    // })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
});




require __DIR__.'/auth.php';
