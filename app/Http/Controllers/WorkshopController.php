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
        $fetchVehicles = Vehicle::get();

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

    public function underway ($id) {
        $workshop = Workshop::findOrFail($id);

        $workshop->update([
            'status' => 'Underway' 
        ]);

        $notification = [
            'message' => 'Status workshop has been updated',
            'alert-type' => 'success',
        ];

        return redirect()->route('workshop')->with($notification);
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
            ->where('status', '!=', 'Completed')
            ->first();

        if ($booking) {
            // Update status in the bookings table
            $booking->status = 'Completed';
            $booking->save();

           // Generate UUID
            $uuid = Uuid::uuid4()->toString();

            // Create a new record in the transactions table
            $transaction = Transaction::create([
                'reference_number' => Str::random(10),
                'vehicle_id' => $booking->vehicle_id,
                'booking_id' => $booking->booking_id
            ]);
            
            $transaction->save(); // Save the user
        }
    }

    // // Kosongkan semua field pada tabel workshop dengan id yang dituju
    // $workshop->update([
    //     'vehicle_id' => null,
    //     'booking_id' => null,
    //     'status' => 'Postponed',
    // ]);

    // Buat pesan notifikasi
    $notification = [
        'message' => 'Status Workshop has been updated',
        'alert-type' => 'success',
    ];

    // Redirect dengan pesan notifikasi
    return redirect()->route('workshop')->with($notification);
}

}
