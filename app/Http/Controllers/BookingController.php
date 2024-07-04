<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Rules\ValidBookingTime;

class BookingController extends Controller
{
    public function view () {
        $bookings = Booking::select('bookings.*', 'customers.*', 'vehicles.*')
        ->join('customers', 'bookings.customer_id', '=', 'customers.customer_id')
        ->join('vehicles', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
        ->orderBy('bookings.created_at', 'desc')
        ->get();

        $processedBooked = Transaction::pluck('booking_id')->toArray();

        return view('dashboard.bookings.booking', compact('bookings', 'processedBooked'));
    }

    public function fetchCustomers (Request $request) {
        $data['vehicles'] = Vehicle::join('customers', 'customers.customer_id', 'vehicles.customer_id')
        ->where('vehicles.customer_id', $request->customer_id)
        ->get();
                                
        return response()->json($data);
    }

    public function create () {
        $customers = Customer::latest()->get();

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

        return view ('dashboard.bookings.booking_add', compact('customers', 'formattedBookingData'));
    }

    public function update ($id) {
        $bookingData = Booking::join('customers', 'customers.customer_id', '=', 'bookings.customer_id')
        ->join('vehicles', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
        ->where('booking_id', $id)
        ->first();

        $customers = Customer::all();

        $bookings = Booking::where('status', '=', 'Reserved')
        ->orderBy('booking_time', 'asc')
        ->get();

        if ($bookings) {
            // Format the booking data
            $formattedBookingData = $bookings->map(function($booking) {
                return [
                    'booking_time' => Carbon::parse($booking->booking_time)->format('H:i'),
                    'booking_date' => Carbon::parse($booking->booking_time)->format('l, d F Y'),
                    'status' => $booking->status,
                ];
            });
        }

        if ($bookingData) {
            $date = Carbon::parse($bookingData->booking_time)->format('F j, Y');
            $time = Carbon::parse($bookingData->booking_time)->format('H:i');
        } else {
            $notification = array(
                'message' => 'Error! Booking data not found',
                'alert-type' => 'error',
            );

            return redirect()->route('booking')->with($notification);
        }


        return view ('dashboard.bookings.booking_edit', compact('bookingData', 'customers', 'date', 'time', 'formattedBookingData'));
    }

    public function store (Request $request) {
        $request->validate([
            'date' => ['required', 'after_or_equal:today'],
            'time' => ['required', new ValidBookingTime($request->input('date'))],
            'customer' => 'required',
            'vehicle' => 'required',
        ]);
        
        $datetime = Carbon::parse($request->date)->format('Y-m-d').' '.Carbon::parse($request->time)->format('H:i:s');

        $booking = Booking::create([
            'booking_time' => $datetime,
            'status' => 'Reserved', 
            'customer_id' => $request->customer,
            'vehicle_id' => $request->vehicle
        ]);

        if ($booking) {
            $notification = array(
                'message' => 'Booking has been scheduled',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Booking has been failed to added',
                'alert-type' => 'error',
            );
        }
        
        return redirect()->route('booking')->with($notification);
    }

    public function updateStore (Request $request) {
        $request->validate([
            'date' => ['required', 'after_or_equal:today'],
            'time' => ['required', new ValidBookingTime($request->input('date'))],
            'customer' => 'required',
            'vehicle' => 'required',
        ]);

        
        // Parse the date string and format it as 'Y-m-d'
        $date = Carbon::createFromFormat('F j, Y', $request->date)->format('Y-m-d');
        $time = Carbon::createFromFormat('H:i', $request->time)->format('H:i:s');

        $datetime = $date . ' ' . $time;
        
        $booking = Booking::findOrFail($request->booking_id);

        if ($booking) {
            $booking->booking_time = $datetime;
            $booking->customer_id = $request->customer;
            $booking->vehicle_id = $request->vehicle;
            $booking->save();

            $notification = array(
                'message' => 'Booking has been rescheduled',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Booking has been failed to update',
                'alert-type' => 'error',
            );
        }
        
        return redirect()->route('booking')->with($notification);
    }

    public function destroy ($id) {
        
        $booking = Booking::findOrFail($id);
        if ($booking) {
                $booking->delete();
                $notification = [
                    'message' => 'Booking has been successfully delete',
                    'alert-type' => 'success',
                ];
            } else {
                $notification = [
                    'message' => 'Booking has been failed to delete',
                    'alert-type' => 'error',
                ];
            }
        return redirect()->route('booking')->with($notification);
    }
}
