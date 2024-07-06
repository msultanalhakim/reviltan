<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Detail;
use App\Models\Booking;
use App\Models\History;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Rules\ValidBookingTime;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function view () {
        $id = Auth::user()->customer_id;
        $authUser = Auth::user();

        $checkCity = Customer::where('customer_id', $authUser->customer_id)->whereNull('city_id')->first();
        $checkProvince = Customer::where('customer_id', $authUser->customer_id)->whereNull('province_id')->first();

        // Menggunakan Eloquent untuk membuat kueri yang setara dengan kueri SQL yang diberikan
        if ($checkCity || $checkProvince) {
            $userData = Customer::join('users', 'users.customer_id', '=' ,'customers.customer_id')
                            ->select('users.*', 'customers.*')
                            ->where('customers.customer_id', $id)
                            ->first();
        } else {
            $userData = Customer::join('users', 'users.customer_id', '=' ,'customers.customer_id')
                            ->join('provinces', 'provinces.province_id', '=', 'customers.province_id')
                            ->join('cities', 'cities.city_id', '=', 'customers.city_id')
                            ->select('users.*', 'customers.*', 'provinces.*', 'cities.*')
                            ->where('customers.customer_id', $id)
                            ->first();
        }

        $vehicleData = Vehicle::join('customers', 'vehicles.customer_id', '=', 'customers.customer_id')
                            ->select('customers.*', 'vehicles.*')
                            ->where('vehicles.customer_id', $id)
                            ->get();

        $userBooking = Booking::where('customer_id', $id)
                            ->where('status', '=', 'Reserved')
                            ->get();

        if ($userBooking) {
            // Format the booking data
            $formattedUserBooking = $userBooking->map(function($booking) {
                return [
                    'booking_time' => Carbon::parse($booking->booking_time)->format('H:i'),
                    'booking_date' => Carbon::parse($booking->booking_time)->format('l, d F Y'),
                ];
            });
        }

        // Fetch booking data ordered by booking_time in ascending order
        $bookingData = Booking::where('status', '=', 'Reserved')
                            ->orderBy('booking_time', 'asc')
                            ->get();
        if ($bookingData) {
            // Format the booking data
            $formattedBookingData = $bookingData->map(function($booking) {
                return [
                    'booking_time' => Carbon::parse($booking->booking_time)->format('H:i'),
                    'booking_date' => Carbon::parse($booking->booking_time)->format('l, d F Y'),
                    'status' => $booking->status,
                ];
            });
        }
        
        $bookingAccepted = Booking::where('status', '=', 'Reserved')
        ->where('customer_id', $id)
        ->first();

        if ($bookingAccepted) {
            $formattedBookingAccepted = [
                'booking_time' => Carbon::parse($bookingAccepted->booking_time)->format('H:i'),
                'booking_date' => Carbon::parse($bookingAccepted->booking_time)->format('l, d F Y'),
                'status' => $bookingAccepted->status,
            ];
        } else {
            $formattedBookingAccepted = null;
        }

        $bookingUnderway = Booking::join('workshops', 'workshops.booking_id', '=', 'bookings.booking_id')
                                ->join('customers', 'customers.customer_id', '=', 'bookings.customer_id')
                                ->where('bookings.customer_id', $id)
                                ->where('bookings.status', '=', 'Reserved')
                                ->get();

        $bookingFinished = Booking::join('workshops', 'workshops.booking_id', '=', 'bookings.booking_id')
        ->join('customers', 'customers.customer_id', '=', 'bookings.customer_id')
        ->where('bookings.customer_id', $id)
        ->where('bookings.status', '=', 'Reserved')
        ->where('workshops.status', '=', 'Finished')
        ->get();

        $transactionData = Transaction::join('bookings', 'bookings.booking_id', '=', 'transactions.booking_id')
                                ->join('customers', 'customers.customer_id', '=', 'transactions.customer_id')
                                ->join('vehicles', 'vehicles.vehicle_id', '=', 'transactions.vehicle_id')
                                ->where('bookings.customer_id', $id)
                                ->where('bookings.status', '=', 'Completed')
                                ->where(function($query) {
                                    $query->whereNull('transactions.transaction_status')
                                          ->orWhere('transactions.transaction_status', '');
                                })
                                ->latest('transactions.created_at')
                                ->first();

        if (!$transactionData) {
            return view('dashboard.services.service', compact('userData', 'vehicleData', 'userBooking', 'bookingUnderway', 'bookingFinished', 'transactionData', 'formattedBookingData', 'formattedUserBooking', 'formattedBookingAccepted'));
        } else {
            $detailsData = Detail::where('reference_number', $transactionData->reference_number)
            ->join('items', 'items.item_id', '=', 'details.item_id')
            ->get();
    
            $coupon = Coupon::where('coupon_code', $transactionData->coupon_code)
            ->first();
            // dd($transactionData->reference_number,$transactionData->customer_name );
            return view('dashboard.services.service', compact('userData', 'vehicleData', 'userBooking', 'bookingUnderway', 'bookingFinished', 'transactionData', 'coupon', 'detailsData', 'formattedBookingData', 'formattedUserBooking', 'formattedBookingAccepted'));
        }
    }

    public function fetchVehicle (Request $request) {
        $data['vehicles'] = Vehicle::where("vehicle_id", $request->vehicle_id)
        ->get();
                            
        return response()->json($data);
    }

    public function serviceBooking (Request $request) {
        $request->validate([
            'customer_id' => 'required',
            'vehicle_id' => 'required',
            'date' => ['required', 'after_or_equal:today'],
            'time' => ['required', new ValidBookingTime($request->input('date'))],
        ]);            
                
        $datetime = Carbon::parse($request->date)->format('Y-m-d').' '.Carbon::parse($request->time)->format('H:i:s');

        $booking = Booking::create([
            'booking_time' => $datetime,
            'status' => 'Reserved', 
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id
        ]);

        if ($booking) {
            $notification = array(
                'message' => 'Booking has been successfully added',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Booking has been failed to added',
                'alert-type' => 'error',
            );
        }

        return redirect()->route('service')->with($notification);
    }

    public function serviceDiscount (Request $request) {
        $request->validate([
            'coupon' => 'required|exists:coupons,coupon_code',
        ]);

        $reference_number = $request->reference_number;
        $coupon = $request->coupon;

        $couponData = Coupon::where('coupon_code', $coupon)
                            ->first();

        if ($couponData) {
            $transactionData = Transaction::where('reference_number', $reference_number)
            ->first();

            $transactionData->coupon_code = $coupon;
            $transactionData->save();

            $notification = array(
                'message' => 'Promo has been added successfully',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Promo has been failed to added',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('service')->with($notification);
    }

    public function serviceRemove ($id) {
        $transactionData = Transaction::where('reference_number', $id)
                                ->first();

        if ($transactionData) {
            $transactionData->coupon_code = '';
            $transactionData->save();
    
            $notification = array(
                'message' => 'Promo removed successfully',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Promo has been failed to removed',
                'alert-type' => 'error',
            );
        }

        return redirect()->route('service')->with($notification);

    }

    public function serviceStore (Request $request) {
        $request->validate([
            'reference_number' => 'required',
        ]);

        $reference_number = $request->reference_number;
        $transaction = Transaction::where('reference_number', $reference_number)
        ->first();

        if ($request->has('action')) {
            $action = $request->input('action');
    
            if ($action == 'proceed') {
                $request->validate([
                    'payment_method' => 'required',
                ]);
                $payment_method = $request->payment_method;
                $total = $request->total;

                if($transaction) {
                    if ($payment_method == 'Bank Transfer') {
                        // Handle file upload
                        if ($request->hasFile('receipt')) {
                            $file = $request->file('receipt');
                            $extension = $file->getClientOriginalExtension(); // Get the original file extension
                            $filename = 'Receipt-'.$transaction->reference_number.' '.date('Y-m-d').' '.date('his').'.'.$extension; 
                            // Ensure a unique filename
                            $file->move(public_path('assets/img/receipt/'), $filename);
                            $transaction->file = $filename;
                        }
                    }
                    $transaction->total = $total;
                    $transaction->payment_method = $payment_method;
                    $transaction->save();

                    $notification = array(
                        'message' => 'Transaction has been submitted',
                        'alert-type' => 'success',
                    );
                }
                return redirect()->route('service')->with($notification);
                
            } elseif ($action == 'finish') {
                if ($transaction) {
                    $transaction->transaction_status = 'Finished';
                    $transaction->save();

                    $customer = Customer::where('customer_id', $transaction->customer_id)->first();
                    $vehicle = Vehicle::where('vehicle_id', $transaction->vehicle_id)->first();
                    $coupon = Coupon::where('coupon_code', $transaction->coupon_code)->first();

                    History::create([
                        'reference_number' => $transaction->reference_number,
                        'customer_name' => $customer->customer_name,
                        'email' => $customer->email,
                        'phone' => $customer->phone,
                        'address' => $customer->address,
                        'vehicle_name' => $vehicle->vehicle_name,
                        'vehicle_color' => $vehicle->vehicle_color,
                        'chassis_number' => $vehicle->chassis_number,
                        'engine_number' => $vehicle->engine_number,
                        'mileage' => $vehicle->mileage,
                        'plate_number' => $vehicle->plate_number,
                        'total' => $transaction->total,
                        'discount' => $coupon->price,
                        'coupon_code' => $transaction->coupon_code,
                        'payment_method' => $transaction->payment_method,
                        'payment_status' => $transaction->payment_status,
                        'transaction_status' => 'Finished',
                    ]);

                    $notification = array(
                        'message' => 'Transaction has been finished',
                        'alert-type' => 'success',
                    );

                    return redirect()->route('service')->with($notification);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
