<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function view () {
        $vehicles = Vehicle::select('vehicles.*', 'customers.*')
        ->join('customers', 'vehicles.customer_id', '=', 'customers.customer_id')
        ->orderBy('vehicles.created_at', 'desc')
        ->get();

        return view('dashboard.vehicles.vehicle', compact('vehicles'));
    }

    public function create () {
        $customers   = Customer::latest()->get();
        return view ('dashboard.vehicles.vehicle_add', compact('customers'));
    }

    public function store (Request $request) {
        $request->validate([
            'vehicle_name' => 'required|max:40',
            'vehicle_color' => 'required',
            'chassis_number' => 'required',
            'engine_number' => 'required',
            'mileage' => 'required',
            'plate_number' => 'required',
            'customer_id' => 'required'
        ]);

        Vehicle::create([
            'vehicle_name' => $request->vehicle_name,
            'vehicle_color' => $request->vehicle_color, 
            'chassis_number' => $request->chassis_number, 
            'engine_number' => $request->engine_number, 
            'mileage' => $request->mileage, 
            'plate_number' => $request->plate_number, 
            'customer_id' => $request->customer_id, 
        ]);
        $notification = array(
            'message' => 'Vehicle has been successfully added',
            'alert-type' => 'success',
        );

        return redirect()->route('vehicle')->with($notification);
    }
}
