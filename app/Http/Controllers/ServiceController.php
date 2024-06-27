<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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

        $bookingUnderway = Booking::join('workshops', 'workshops.booking_id', '=', 'bookings.booking_id')
                                ->join('customers', 'customers.customer_id', '=', 'bookings.customer_id')
                                ->where('bookings.customer_id', $id)
                                ->where('bookings.status', '=', 'Reserved')
                                ->get();

        $transactionData = Transaction::join('bookings', 'bookings.booking_id', '=', 'transactions.booking_id')
                                ->where('bookings.customer_id', $id)
                                ->where('bookings.status', '=', 'Completed')
                                ->where('transactions.payment_status', '=', 'Pending')
                                ->latest('transactions.created_at') // Mengurutkan berdasarkan waktu pembuatan transaksi terbaru
                                ->first(); // Mengambil data pertama dari hasil urutan terbaru

        
        return view('dashboard.services.service', compact('userData', 'vehicleData', 'userBooking', 'bookingUnderway', 'transactionData', 'formattedBookingData', 'formattedUserBooking'));
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

        Booking::create([
            'booking_time' => $datetime,
            'status' => 'Reserved', 
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id
        ]);

        $notification = array(
            'message' => 'Booking has been successfully added',
            'alert-type' => 'success',
        );

        return redirect()->route('service')->with($notification);
    }
}
