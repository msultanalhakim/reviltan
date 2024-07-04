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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');
    // Route::prefix('vehicles')->group(function () {
    //     Route::get('/', VehicleController::class, 'vehicleList')->name('customer.vehicles');
    //     Route::get('/add', VehicleController::class, 'vehicleAdd')->name('customer.vehicle.add');
    //     Route::post('/store', VehicleController::class, 'vehicleStore')->name('customer.vehicle.store');
    //     Route::get('/update/{id}', VehicleController::class, 'vehicleUpdate')->name('customer.vehicle.update');
    //     Route::post('/update/store', VehicleController::class, 'vehicleUpdateStore')->name('customer.vehicle.update.store');
    //     Route::get('/destroy/{id}', VehicleController::class, 'vehicleDestroy')->name('customer.vehicle.destroy');
    // });
    Route::middleware(['role:User'])->group(function () {


        // Route::prefix('service')->group(function () {
        //     Route::get('/', 'ServiceController@view')->name('service');
        //     Route::post('/booking', 'ServiceController@serviceBooking')->name('service.booking');
        //     Route::post('/discount', 'ServiceController@serviceDiscount')->name('service.discount');
        //     Route::post('/store', 'ServiceController@serviceStore')->name('service.store');
        //     Route::get('/remove/{id}', 'ServiceController@serviceRemove')->name('service.remove');
        //     Route::post('/api/fetch-vehicle-data', 'ServiceController@fetchVehicle');
        // });
    });
    Route::get('/customer/vehicles', [VehicleController::class, 'vehicleList'])->name('customer.vehicles');
    Route::get('/customer/vehicles/add', [VehicleController::class, 'vehicleAdd'])->name('customer.vehicle.add');
    Route::post('/customer/vehicles/store', [VehicleController::class, 'vehicleStore'])->name('customer.vehicle.store');
    Route::get('/customer/vehicles/update/{id}', [VehicleController::class, 'vehicleUpdate'])->name('customer.vehicle.update');
    Route::post('/customer/vehicles/update/store', [VehicleController::class, 'vehicleUpdateStore'])->name('customer.vehicle.update.store');
    Route::get('/customer/vehicles/destroy/{id}', [VehicleController::class, 'vehicleDestroy'])->name('customer.vehicle.destroy');

    Route::get('/service', [ServiceController::class, 'view'])->name('service');
    Route::post('/service/booking', [ServiceController::class, 'serviceBooking'])->name('service.booking');
    Route::post('/service/discount', [ServiceController::class, 'serviceDiscount'])->name('service.discount');
    Route::post('/service/store', [ServiceController::class, 'serviceStore'])->name('service.store');
    Route::get('/service/remove/{id}', [ServiceController::class, 'serviceRemove'])->name('service.remove');
    Route::post('/api/fetch-vehicle-data', [ServiceController::class, 'fetchVehicle']);
    Route::middleware(['role:Administrator'])->group(function () {


    });
    Route::get('/booking', [BookingController::class, 'view'])->name('booking');


    Route::get('/workshop', [WorkshopController::class, 'view'])->name('workshop');
    Route::get('/workshop/add', [WorkshopController::class, 'create'])->name('workshop.add');
    Route::post('/workshop/store', [WorkshopController::class, 'store'])->name('workshop.store');
    Route::post('/workshop/underway/{id}', [WorkshopController::class, 'underway'])->name('workshop.underway');
    Route::post('/workshop/{id}/update-status', [WorkshopController::class, 'updateStatus'])->name('workshop.updateStatus');

    Route::get('/transaction', [TransactionController::class, 'view'])->name('transaction');
    Route::get('/transaction/add', [TransactionController::class, 'create'])->name('transaction.add');
    Route::post('/transaction/add/store', [TransactionController::class, 'store'])->name('transaction.store');
    Route::post('/transaction/item/store', [TransactionController::class, 'storeItem'])->name('transaction.item.store');
    Route::get('/transaction/manage/{id}', [TransactionController::class, 'viewManage'])->name('transaction.manage');    
    Route::post('/transaction/manage/store', [TransactionController::class, 'storeManage'])->name('transaction.manage.store');    
    Route::get('/transaction/delete/{id}', [TransactionController::class, 'deleteTransaction'])->name('transaction.delete');
    Route::post('/api/fetch-item', [TransactionController::class, 'fetchItem']);

    Route::get('/history', [HistoryController::class, 'view'])->name('history');
    Route::get('/history/add', [HistoryController::class, 'view'])->name('history.add');

    Route::get('/province', [ProvinceController::class, 'view'])->name('province');
    Route::get('/province/add', [ProvinceController::class, 'create'])->name('province.add');
    Route::get('/province/update/{id}', [ProvinceController::class, 'update'])->name('province.update');
    Route::post('/province/store', [ProvinceController::class, 'store'])->name('province.store');
    Route::post('/province/update/store', [ProvinceController::class, 'updateStore'])->name('province.update.store');
    Route::get('/province/destroy/{id}', [ProvinceController::class, 'destroy'])->name('province.destroy');
    
    Route::get('/city', [CityController::class, 'view'])->name('city');
    Route::get('/city/add', [CityController::class, 'create'])->name('city.add');
    Route::get('/city/update/{id}', [CityController::class, 'update'])->name('city.update');
    Route::post('/city/store', [CityController::class, 'store'])->name('city.store');
    Route::post('/city/update/store', [CityController::class, 'updateStore'])->name('city.update.store');
    Route::get('/city/destroy/{id}', [CityController::class, 'destroy'])->name('city.destroy');

    Route::get('/customer', [CustomerController::class, 'view'])->name('customer');
    Route::get('/customer/add', [CustomerController::class, 'create'])->name('customer.add');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('/customer/update/store', [CustomerController::class, 'updateStore'])->name('customer.update.store');
    Route::get('/customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/account', [AccountController::class, 'view'])->name('account');
    Route::get('/account/add', [AccountController::class, 'create'])->name('account.add');
    Route::get('/account/update/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::post('/account/update/store', [AccountController::class, 'updateStore'])->name('account.update.store');
    Route::post('/account/store', [AccountController::class, 'store'])->name('account.store');
    Route::get('/account/destroy/{id}', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::get('/vehicle', [VehicleController::class, 'view'])->name('vehicle');
    Route::get('/vehicle/add', [VehicleController::class, 'create'])->name('vehicle.add');
    Route::get('/vehicle/update/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::post('/vehicle/update/store', [VehicleController::class, 'storeUpdate'])->name('vehicle.update.store');
    Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/vehicle/destroy/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

    Route::get('/booking', [BookingController::class, 'view'])->name('booking');
    Route::get('/booking/add', [BookingController::class, 'create'])->name('booking.add');
    Route::get('/booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/update/store', [BookingController::class, 'updateStore'])->name('booking.update.store');
    Route::post('/api/fetch-customers', [BookingController::class, 'fetchCustomers']);
    Route::get('/booking/destroy/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

    
    Route::get('/workshop', [WorkshopController::class, 'view'])->name('workshop');
    Route::get('/workshop/add', [WorkshopController::class, 'create'])->name('workshop.add');
    Route::post('/workshop/store', [WorkshopController::class, 'store'])->name('workshop.store');
    Route::post('/workshop/update', [WorkshopController::class, 'update'])->name('workshop.update');
    Route::post('/api/fetch-vehicle', [WorkshopController::class, 'fetchVehicle']);

    Route::get('/coupon', [CouponController::class, 'view'])->name('coupon');
    Route::get('/coupon/add', [CouponController::class, 'create'])->name('coupon.add');
    Route::get('/coupon/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::post('/coupon/update/store', [CouponController::class, 'updateStore'])->name('coupon.update.store');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/destroy/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');

    Route::get('/item', [ItemController::class, 'view'])->name('item');
    Route::get('/item/add', [ItemController::class, 'create'])->name('item.add');
    Route::get('/item/update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::post('/item/update/store', [ItemController::class, 'updateStore'])->name('item.update.store');
    Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/destroy/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
});

// Authenticated routes
Route::middleware('auth', 'verified')->group(function () {
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
