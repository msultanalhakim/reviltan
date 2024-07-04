<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function view () {
        $vehicles = Vehicle::select('vehicles.*', 'customers.*')
        ->join('customers', 'vehicles.customer_id', '=', 'customers.customer_id')
        ->orderBy('vehicles.created_at', 'desc')
        ->get();

        $bookedVehicleIds = Booking::pluck('vehicle_id')->toArray();

        return view('dashboard.vehicles.vehicle', compact('vehicles', 'bookedVehicleIds'));
    }

    public function vehicleList () {
        $id = Auth::user()->customer_id;
        $vehicles = Vehicle::where('customer_id', $id)
                        ->get();

        // Fetch all vehicle_ids that are associated with bookings
        $bookedVehicleIds = Booking::pluck('vehicle_id')->toArray();
        
        return view('dashboard.vehicles.customer-vehicles', compact('vehicles', 'bookedVehicleIds'));
    }

    public function create () {
        $customers   = Customer::latest()->get();
        return view ('dashboard.vehicles.vehicle_add', compact('customers'));
    }

    public function vehicleAdd () {
        return view ('dashboard.vehicles.customer-vehicles-add');
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
    
    public function vehicleStore (Request $request) {
        $id = Auth::user()->customer_id;

        $request->validate([
            'vehicle_name' => 'required|max:40',
            'vehicle_color' => 'required',
            'chassis_number' => 'required',
            'engine_number' => 'required',
            'mileage' => 'required',
            'plate_number' => 'required',
        ]);

        $vehicle_name = ucwords(strtolower($request->vehicle_name)); // Capitalize first letter of each word
        $vehicle_color = ucwords(strtolower($request->vehicle_color)); // Capitalize first letter of each word
        $chassis_number = strtoupper($request->chassis_number); // All uppercase
        $engine_number = strtoupper($request->engine_number); // All uppercase
        $mileage = strtoupper($request->mileage); // All uppercase
        $plate_number = strtoupper($request->plate_number); // All uppercase

        Vehicle::create([
            'vehicle_name' => $vehicle_name,
            'vehicle_color' => $vehicle_color, 
            'chassis_number' => $chassis_number, 
            'engine_number' => $engine_number, 
            'mileage' => $mileage, 
            'plate_number' => $plate_number, 
            'customer_id' => $id, 
        ]);

        $notification = array(
            'message' => 'Vehicle has been successfully added',
            'alert-type' => 'success',
        );

        return redirect()->route('customer.vehicles')->with($notification);
    }

    public function update ($id) {
        $vehicle = Vehicle::join('customers', 'customers.customer_id', '=', 'vehicles.customer_id')
        ->where('vehicle_id', $id)->first();

        $customers = Customer::all();
    
        return view('dashboard.vehicles.vehicle_edit', compact('vehicle', 'customers'));
    }

    public function vehicleUpdate ($id) {
        $vehicle = Vehicle::where('vehicle_id', $id)->first();
    
        // Check if the authenticated user is the owner of the vehicle
        if (Auth::user()->customer_id !== $vehicle->customer_id) {
            // If not, redirect to a different page with an error message
            $notification = array(
                'message' => 'You do not have permission to edit this vehicle.',
                'alert-type' => 'danger',
            );
            return redirect()->route('customer.vehicles')->with($notification);
        }
    
        return view('dashboard.vehicles.customer-vehicles-edit', compact('vehicle'));
    }

    public function storeUpdate (Request $request) {
        $request->validate([
            'vehicle_id' => 'required',
            'vehicle_name' => 'required|max:40',
            'vehicle_color' => 'required',
            'chassis_number' => 'required',
            'engine_number' => 'required',
            'mileage' => 'required',
            'plate_number' => 'required',
            'customer_id' => 'required'
        ]);

        $vehicle = Vehicle::where('vehicle_id', $request->vehicle_id)
        ->first();

        if ($vehicle) {
            $vehicle->vehicle_name = $request->vehicle_name;
            $vehicle->vehicle_color = $request->vehicle_color;
            $vehicle->chassis_number = $request->chassis_number;
            $vehicle->engine_number = $request->engine_number;
            $vehicle->mileage = $request->mileage;
            $vehicle->plate_number = $request->plate_number;
            $vehicle->customer_id = $request->customer_id;
            $vehicle->save();

            $notification = array(
                'message' => 'Vehicle has been successfully updated',
                'alert-type' => 'success',
            );
    
            return redirect()->route('vehicle')->with($notification);
        }
    }

    public function vehicleUpdateStore (Request $request) {
        $request->validate([
            'vehicle_id' => 'required',
            'vehicle_name' => 'required|max:40',
            'vehicle_color' => 'required',
            'chassis_number' => 'required',
            'engine_number' => 'required',
            'mileage' => 'required',
            'plate_number' => 'required'
        ]);

        $vehicle = Vehicle::where('vehicle_id', $request->vehicle_id)
        ->first();

        if ($vehicle) {
            $vehicle->vehicle_name = $request->vehicle_name;
            $vehicle->vehicle_color = $request->vehicle_color;
            $vehicle->chassis_number = $request->chassis_number;
            $vehicle->engine_number = $request->engine_number;
            $vehicle->mileage = $request->mileage;
            $vehicle->plate_number = $request->plate_number;
            $vehicle->save();

            $notification = array(
                'message' => 'Vehicle has been successfully updated',
                'alert-type' => 'success',
            );
    
            return redirect()->route('customer.vehicles')->with($notification);
        }
    }

    public function destroy ($id) {
        Vehicle::findOrFail($id)->delete();

        $notification = [
            'message' => 'Vehicle has been successfully delete',
            'alert-type' => 'success'
        ];

        return redirect()->route('vehicle')->with($notification);
    }

    public function vehicleDestroy ($id) {
        Vehicle::findOrFail($id)->delete();

        $notification = [
            'message' => 'Vehicle has been successfully delete',
            'alert-type' => 'success'
        ];

        return redirect()->route('customer.vehicles')->with($notification);
    }

}
