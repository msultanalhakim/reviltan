<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Rules\ValidBookingTime;

class BookingController extends Controller
{
    public function view () {
        $bookings = Booking::select('bookings.*', 'customers.*')
        ->join('customers', 'bookings.customer_id', '=', 'customers.customer_id')
        ->orderBy('bookings.created_at', 'desc')
        ->get();

        return view('dashboard.bookings.booking', compact('bookings'));
    }

    public function create () {
        $customers = Customer::latest()->get();
        return view ('dashboard.bookings.booking_add', compact('customers'));
    }

    public function store (Request $request) {
        $request->validate([
            'date' => ['required', 'after_or_equal:today'],
            'time' => ['required', new ValidBookingTime($request->input('date'))],
            'customer_id' => 'required',
        ]);
                
        $datetime = Carbon::parse($request->date)->format('Y-m-d').' '.Carbon::parse($request->time)->format('H:i:s');

        Booking::create([
            'booking_time' => $datetime,
            'status' => 'Reserved', 
            'customer_id' => $request->customer_id,
        ]);

        $notification = array(
            'message' => 'Booking has been scheduled',
            'alert-type' => 'success',
        );

        return redirect()->route('booking')->with($notification);
    }
}
