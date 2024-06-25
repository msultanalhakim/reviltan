<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        
        // Fetch booking data ordered by booking_time in ascending order
        $bookingData = Booking::where('status', '!=', 'Completed')
                            ->orderBy('booking_time', 'asc')
                            ->get();

        $userBooking = Booking::where('customer_id', $id)
                            ->where('status', '!=', 'Completed')
                            ->get();

        $bookingUnderway = Booking::join('workshops', 'workshops.booking_id', '=', 'bookings.booking_id')
        ->join('customers', 'customers.customer_id', '=', 'bookings.customer_id')
        ->where('bookings.customer_id', $id)
        ->where('bookings.status', '=', 'Completed')
        ->get();


        // Format the booking data
        $formattedBookingData = $bookingData->map(function($booking) {
            return [
                'booking_time' => Carbon::parse($booking->booking_time)->format('H:i'),
                'booking_date' => Carbon::parse($booking->booking_time)->format('l, d F Y'),
                'status' => $booking->status,
            ];
        });

        // Format the booking data
        $formattedBookingUnderway = $bookingUnderway->map(function($booking) {
            return [
                'booking_time' => Carbon::parse($booking->booking_time)->format('H:i'),
                'booking_date' => Carbon::parse($booking->booking_time)->format('l, d F Y'),
            ];
        });

        return view('dashboard.services.service', compact('userData', 'vehicleData', 'formattedBookingData', 'userBooking', 'bookingUnderway', 'formattedBookingUnderway'));
    }

    public function fetchVehicle (Request $request) {
        $data['vehicles'] = Vehicle::where("vehicle_id", $request->vehicle_id)
        ->get();
                            
        return response()->json($data);
    }
}
