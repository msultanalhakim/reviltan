<?php

use App\Models\City;
use App\Models\Booking;
use App\Models\History;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
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


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/', [DashboardController::class, 'view']);
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');

    Route::controller(UserController::class)->group(function() {
        Route::get('/profile', 'view')->name('profile.view');
        Route::get('/profile/change-password', 'changePassword')->name('profile.change_password');
        Route::post('/profile/change-password/store', 'storePassword')->name('profile.store_password');
        Route::get('/profile/logout', 'destroy')->name('profile.logout');
        Route::post('api/fetch-city', 'fetchCity');
        Route::post('/profile/store', 'store')->name('profile.store');
    });
    Route::middleware('role:User')->group(function() {
        Route::controller(VehicleController::class)->group(function() {
            Route::get('/customer/vehicles', 'vehicleList')->name('customer.vehicles');
            Route::get('/customer/vehicles/add', 'vehicleAdd')->name('customer.vehicle.add');
            Route::post('/customer/vehicles/store', 'vehicleStore')->name('customer.vehicle.store');
            Route::get('/customer/vehicles/update/{id}', 'vehicleUpdate')->name('customer.vehicle.update');
            Route::post('/customer/vehicles/update/store', 'vehicleUpdateStore')->name('customer.vehicle.update.store');
            Route::get('/customer/vehicles/destroy/{id}', 'vehicleDestroy')->name('customer.vehicle.destroy');
        });

        Route::controller(ServiceController::class)->group(function() {
            Route::get('/service', 'view')->name('service');
            Route::post('/service/booking', 'serviceBooking')->name('service.booking');
            Route::post('/service/discount', 'serviceDiscount')->name('service.discount');
            Route::post('/service/store', 'serviceStore')->name('service.store');
            Route::get('/service/remove/{id}', 'serviceRemove')->name('service.remove');
            Route::post('/api/fetch-vehicle-data', 'fetchVehicle');
        });

        Route::controller(HistoryController::class)->group(function() {
            Route::get('/history', 'view')->name('history');
            Route::get('/history/details/{id}', 'viewDetails')->name('history.details');
        });
    });

    Route::middleware(['role:Administrator'])->group(function () {
        Route::controller(AccountController::class)->group(function() {
            Route::get('/account', 'view')->name('account');
            Route::get('/account/add', 'create')->name('account.add');
            Route::get('/account/update/{id}', 'update')->name('account.update');
            Route::post('/account/update/store', 'updateStore')->name('account.update.store');
            Route::post('/account/store', 'store')->name('account.store');
            Route::get('/account/destroy/{id}', 'destroy')->name('account.destroy');
        });

        Route::controller(CustomerController::class)->group(function() {
            Route::get('/customer', 'view')->name('customer');
            Route::get('/customer/add', 'create')->name('customer.add');
            Route::post('/customer/store', 'store')->name('customer.store');
            Route::get('/customer/update/{id}', 'update')->name('customer.update');
            Route::post('/customer/update/store', 'updateStore')->name('customer.update.store');
            Route::get('/customer/destroy/{id}', 'destroy')->name('customer.destroy');
        });

        Route::controller(VehicleController::class)->group(function() {
            Route::get('/vehicle', 'view')->name('vehicle');
            Route::get('/vehicle/add', 'create')->name('vehicle.add');
            Route::get('/vehicle/update/{id}', 'update')->name('vehicle.update');
            Route::post('/vehicle/update/store', 'storeUpdate')->name('vehicle.update.store');
            Route::post('/vehicle/store', 'store')->name('vehicle.store');
            Route::get('/vehicle/destroy/{id}', 'destroy')->name('vehicle.destroy');
        });

        Route::controller(WorkshopController::class)->group(function() {
            Route::get('/workshop', 'view')->name('workshop');
            Route::get('/workshop/add', 'create')->name('workshop.add');
            Route::post('/workshop/store', 'store')->name('workshop.store');
            Route::post('/workshop/update', [WorkshopController::class, 'update'])->name('workshop.update');
            Route::post('/workshop/underway/{id}', 'underway')->name('workshop.underway');
            Route::post('/workshop/{id}/update-status', 'updateStatus')->name('workshop.updateStatus');
            Route::post('/api/fetch-vehicle', [WorkshopController::class, 'fetchVehicle']);
        });

        Route::controller(BookingController::class)->group(function() {
            Route::get('/booking', 'view')->name('booking');
            Route::get('/booking/add', 'create')->name('booking.add');
            Route::get('/booking/update/{id}', 'update')->name('booking.update');
            Route::post('/booking/store', 'store')->name('booking.store');
            Route::post('/booking/update/store', 'updateStore')->name('booking.update.store');
            Route::post('/api/fetch-customers', 'fetchCustomers');
            Route::get('/booking/destroy/{id}', 'destroy')->name('booking.destroy');
        });

        Route::controller(TransactionController::class)->group(function() {
            Route::get('/transaction', 'view')->name('transaction');
            Route::get('/transaction/add', 'create')->name('transaction.add');
            Route::post('/transaction/add/store', 'store')->name('transaction.store');
            Route::post('/transaction/item/store', 'storeItem')->name('transaction.item.store');
            Route::get('/transaction/manage/{id}', 'viewManage')->name('transaction.manage');    
            Route::post('/transaction/manage/store', 'storeManage')->name('transaction.manage.store');    
            Route::get('/transaction/delete/{id}', 'deleteTransaction')->name('transaction.delete');
            Route::post('/api/fetch-item', 'fetchItem');
        });

        Route::controller(ItemController::class)->group(function() {
            Route::get('/item', 'view')->name('item');
            Route::get('/item/add', 'create')->name('item.add');
            Route::get('/item/update/{id}', 'update')->name('item.update');
            Route::post('/item/update/store', 'updateStore')->name('item.update.store');
            Route::post('/item/store', 'store')->name('item.store');
            Route::get('/item/destroy/{id}', 'destroy')->name('item.destroy');
        });

        Route::controller(CouponController::class)->group(function() {
            Route::get('/coupon', 'view')->name('coupon');
            Route::get('/coupon/add', 'create')->name('coupon.add');
            Route::get('/coupon/update/{id}', 'update')->name('coupon.update');
            Route::post('/coupon/update/store', 'updateStore')->name('coupon.update.store');
            Route::post('/coupon/store', 'store')->name('coupon.store');
            Route::get('/coupon/destroy/{id}', 'destroy')->name('coupon.destroy');
        });

        Route::controller(CityController::class)->group(function() {
            Route::get('/city', 'view')->name('city');
            Route::get('/city/add', 'create')->name('city.add');
            Route::get('/city/update/{id}', 'update')->name('city.update');
            Route::post('/city/store', 'store')->name('city.store');
            Route::post('/city/update/store', 'updateStore')->name('city.update.store');
            Route::get('/city/destroy/{id}', 'destroy')->name('city.destroy');
        });

        Route::controller(ProvinceController::class)->group(function() {
            Route::get('/province', 'view')->name('province');
            Route::get('/province/add', 'create')->name('province.add');
            Route::get('/province/update/{id}', 'update')->name('province.update');
            Route::post('/province/store', 'store')->name('province.store');
            Route::post('/province/update/store', 'updateStore')->name('province.update.store');
            Route::get('/province/destroy/{id}', 'destroy')->name('province.destroy');
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

require __DIR__.'/auth.php';
