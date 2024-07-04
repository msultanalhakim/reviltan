<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function view () {
        $customers = Customer::leftJoin('cities', 'cities.city_id', '=', 'customers.city_id')
        ->leftJoin('provinces', 'provinces.province_id', '=', 'customers.province_id')
        ->get();

        // Fetch all vehicle_ids that are associated with bookings
        $bookedCustomerIds = Booking::pluck('customer_id')->toArray();

        return view('dashboard.customers.customer', compact('customers', 'bookedCustomerIds'));
    }

    public function create () {
        $provinces = Province::all();
        
        return view ('dashboard.customers.customer_add', compact('provinces'));
    }

    public function update ($id) {
        $customer = Customer::leftJoin('provinces', 'provinces.province_id', '=', 'customers.province_id')
        ->leftJoin('cities', 'cities.city_id', '=', 'customers.city_id')
        ->findOrFail($id);

        $provinces = Province::all();

        return view ('dashboard.customers.customer_edit', compact('customer', 'provinces'));
    }

    public function store (Request $request) {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'province' => ['required', 'integer'],
            'city' => ['required', 'integer'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('Y-m-d').' '.date('his').'.'.$file->getClientOriginalName(); 
            $file->move(public_path('assets/img/profile/'), $filename);

            Customer::create([
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'photo' => $filename
            ]);
        } else {
            Customer::create([
                'customer_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'province_id' => $request->province,
                'city_id' => $request->city
            ]);
        }

        $notification = array(
            'message' => 'Customer has been successfully added',
            'alert-type' => 'success',
        );

        return redirect()->route('customer')->with($notification);
    }

    public function updateStore (Request $request) {
        $customer = Customer::findOrFail($request->customer_id);

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($customer->email, 'email'), // Specify 'email' as the column name
            ],
        ]);

        if ($customer) {
            $oldemail = $customer->email;
            $customer->customer_name = $request->customer_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->province_id = $request->province;
            $customer->city_id = $request->city;

                    // Handle file upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($customer->photo && file_exists(public_path('assets/img/profile/' . $customer->photo))) {
                    @unlink(public_path('assets/img/profile/' . $customer->photo));
                }

                $file = $request->file('photo');
                $filename = $file->getClientOriginalName().' '.date('Y-m-d').' '.date('His'); // Ensure unique filename
                $file->move(public_path('assets/img/profile/'), $filename);
                $customer->photo = $filename;
            }

            if ($oldemail != $request->email) {
                $account = User::where('email', $oldemail)->first();
                $account->email = $customer->email;
                $account->save();
            }
            $customer->save();
            $notification = array(
                'message' => 'Customer has been updated successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('customer')->with($notification);
        }

    }

    public function destroy ($id) {
        
        $customer = Customer::findOrFail($id);
        if ($customer) {
            $account = User::where('email', $customer->email)->first();
            if ($account) {
                $account->delete();
                $customer->delete();
            } else {
                $customer->delete();
            }
        }

        $notification = [
            'message' => 'Customer has been successfully delete',
            'alert-type' => 'success',
        ];

        return redirect()->route('customer')->with($notification);
    }
}
