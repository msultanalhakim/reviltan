<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Workshop;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function view () {
        // Fetch workshops with related vehicle and customer information
        $workshops = Workshop::select('workshops.*', 'customers.*', 'vehicles.*')
        ->leftJoin('vehicles', 'workshops.vehicle_id', '=', 'vehicles.vehicle_id')
        ->leftJoin('customers', 'vehicles.customer_id', '=', 'customers.customer_id')
        ->orderBy('workshops.created_at', 'desc')
        ->get();


        $fetchWorkshops = Workshop::get();
        $fetchVehicles = Vehicle::join('bookings', 'bookings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->where('bookings.status', 'Reserved')
        ->get();

        return view('dashboard.workshops.workshop', compact('workshops', 'fetchWorkshops', 'fetchVehicles'));
    }

    public function fetchVehicle (Request $request) {
        $data['vehicles'] = Workshop::select('workshops.*', 'vehicles.*')
            ->join('vehicles', 'workshops.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('workshop_id', $request->workshop_id)
            ->get(["vehicles.vehicle_name", "vehicles.plate_number", "vehicles.vehicle_id"]);

        $data['status'] = Workshop::where("workshop_id", $request->workshop_id)
            ->get(["status"]);
                                
        return response()->json($data);
    }

    public function create () {
        $vehicles = Vehicle::latest()->get();
        return view('dashboard.workshops.workshop_add', compact('vehicles'));
    }

    public function store (Request $request) {
        $request->validate([
            'workshop_name' => 'required',
            'status' => 'required',
            'vehicle_id' => 'required',
        ]);
                
        Workshop::create([
            'workshop_name' => $request->workshop_name,
            'status' => $request->status, 
            'vehicle_id' => $request->vehicle_id,
        ]);

        $notification = array(
            'message' => 'Workshop has been added',
            'alert-type' => 'success',
        );

        return redirect()->route('workshop')->with($notification);
    }

    public function update(Request $request) {
    // Validate the request data
    $request->validate([
        'workshop_id' => 'required|exists:workshops,workshop_id',
        'status' => 'required|string',
        'vehicle' => 'required|exists:vehicles,vehicle_id', // Assuming vehicles table has vehicle_id column
    ]);

    // Retrieve the workshop entry
    $workshop = Workshop::find($request->workshop_id);

    // Ensure the workshop entry exists
    if ($workshop) {
        // Retrieve the booking entry with the given vehicle_id and status 'Reserved'
        $booking = Booking::where('vehicle_id', $request->vehicle)
                          ->where('status', 'Reserved')
                          ->first();

        // Ensure the booking entry exists
        if ($booking) {
            // Update the workshop entry
            $workshop->status = $request->status;
            $workshop->vehicle_id = $request->vehicle;
            $workshop->booking_id = $booking->booking_id;
            $workshop->save();

            // Set success notification
            $notification = [
                'message' => 'Workshop has been successfully updated',
                'alert-type' => 'success',
            ];

            return redirect()->route('workshop')->with($notification);
        } else {
            // Set error notification for missing booking
            return redirect()->back()->withErrors(['vehicle' => 'No booking found for the specified vehicle with status Reserved.']);
        }
    } else {
        // Set error notification for missing workshop
        return redirect()->back()->withErrors(['workshop_id' => 'Workshop not found.']);
    }
}

    public function updateStatus(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'status' => 'required',
        ]);

        // Cari workshop berdasarkan ID
        $workshop = Workshop::findOrFail($id);

        // Perbarui status workshop
        $workshop->status = $request->status;
        $workshop->save();
        if ($request->status == 'Finished') {
            $booking = Booking::where('booking_id', $workshop->booking_id)
                ->where('status', '=', 'Reserved')
                ->first();
                
            if ($booking) { 
                // Update status in the bookings table
                $booking->status = 'Completed';
                $booking->save();

                $fetchTransaction = Transaction::where('customer_id', $booking->customer_id)
                                        ->where('payment_status', '=', 'Pending')
                                        ->first();
                
                if(empty($fetchTransaction)) {
                    // Create a new record in the transactions table
                    $transaction = Transaction::create([
                        'reference_number' => Str::random(15),
                        'booking_id' => $booking->booking_id,
                        'vehicle_id' => $booking->vehicle_id,
                        'customer_id' => $booking->customer_id
                    ]);
    
                    $transaction->save(); // Save the user
                
                    if($transaction) {
                        // Kosongkan semua field pada tabel workshop dengan id yang dituju
                        $workshop->update([
                            'vehicle_id' => null,
                            'booking_id' => null,
                            'status' => 'Postponed',
                        ]);

                        if ($workshop) {
                            // Buat pesan notifikasi
                            $notification = [
                                'message' => 'Status Workshop has been successfully updated',
                                'alert-type' => 'success',
                            ];
                        }
                    }
                } else {
                    // Buat pesan notifikasi
                    $notification = [
                        'message' => 'Failed to update, the customers has pending transaction',
                        'alert-type' => 'error',
                    ];
                }
            } else {
                $notification = [
                    'message' => 'Failed to updated workshop status',
                    'alert-type' => 'error',
                ];
            }
        } else {
            $booking = Booking::where('booking_id', $workshop->booking_id)
            ->where('status', '=', 'Reserved')
            ->first();

            if ($booking) {
                $booking->status = 'Canceled';
                $booking->save();

                // Cari workshop berdasarkan ID
                $workshop = Workshop::findOrFail($id);
                if ($workshop) {
                    $workshop->update([
                        'vehicle_id' => null,
                        'booking_id' => null,
                        'status' => 'Postponed',
                    ]);

                    $notification = [
                        'message' => 'Status Workshop has been successfully updated',
                        'alert-type' => 'success',
                    ];
                }

            }
        }

        // Redirect dengan pesan notifikasi
        return redirect()->route('workshop')->with($notification);
    }

}
