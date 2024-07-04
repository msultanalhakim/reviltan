<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\User;
use App\Models\City;
use App\Models\Province;

class UserController extends Controller
{
    public function view () {
        $id = Auth::user()->customer_id;
        $authUser = Auth::user();

        $checkCity = Customer::where('customer_id', $authUser->customer_id)->whereNull('city_id')->first();
        $checkProvince = Customer::where('customer_id', $authUser->customer_id)->whereNull('province_id')->first();

        // Menggunakan Eloquent untuk membuat kueri yang setara dengan kueri SQL yang diberikan
        if ($checkCity || $checkProvince) {
            $data['userData'] = Customer::join('users', 'users.customer_id', '=' ,'customers.customer_id')
                            ->select('users.*', 'customers.*')
                            ->where('customers.customer_id', $id)
                            ->first();
        } else {
            $data['userData'] = Customer::join('users', 'users.customer_id', '=' ,'customers.customer_id')
                            ->join('provinces', 'provinces.province_id', '=', 'customers.province_id')
                            ->join('cities', 'cities.city_id', '=', 'customers.city_id')
                            ->select('users.*', 'customers.*', 'provinces.*', 'cities.*')
                            ->where('customers.customer_id', $id)
                            ->first();
        }
                    
        $data['provinces'] = Province::orderBy('province_name', 'asc')->get(['province_name', 'province_id']);


        return view('dashboard.profile', $data);
    }

    public function fetchCity (Request $request) {
        $data['cities'] = City::where("province_id", $request->province_id)
                                ->get(["city_name", "city_id"]);
                                
        return response()->json($data);
    }

    public function store(Request $request) {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id], // Assuming 'id' is the primary key
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'integer'],
            'city' => ['nullable', 'integer'],
            'photo' => ['nullable', 'image', 'max:2048'], // Assuming photo is an image and has a max size
        ]);

        $dataUser = User::find($user->id); 
        $dataCustomer = Customer::find($user->customer_id);
        
        $name = ucwords(strtolower($request->name)); // Capitalize first letter of each word

        if ($dataUser && $dataCustomer) {
            // Update user data
            $dataUser->username = $request->username;
            $dataUser->save();

            // Update customer data
            $dataCustomer->customer_name = $name;
            $dataCustomer->phone = $request->phone;
            $dataCustomer->address = $request->address;
            $dataCustomer->province_id = $request->province;
            $dataCustomer->city_id = $request->city;

            // Handle file upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($dataCustomer->photo && file_exists(public_path('assets/img/profile/' . $dataCustomer->photo))) {
                    @unlink(public_path('assets/img/profile/' . $dataCustomer->photo));
                }

                $file = $request->file('photo');
                $filename = $file->getClientOriginalName().' '.date('Y-m-d').' '.date('His'); // Ensure unique filename
                $file->move(public_path('assets/img/profile/'), $filename);
                $dataCustomer->photo = $filename;
            }

            $dataCustomer->save();

            $notification = array(
                'message' => 'Profile has been updated successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }

        // If user or customer not found, return an error
        $notification = array(
            'message' => 'User or Customer not found',
            'alert-type' => 'error',
        );

        return redirect()->back()->with($notification);
    }


    public function changePassword () {
        $id = Auth::user()->customer_id;
        $userData = Customer::join('users', 'users.customer_id', '=', 'customers.customer_id')
        ->where('customers.customer_id', $id)
        ->first();

        return view('dashboard.profile_change_password', compact('userData'));
    }

    public function storePassword (Request $request) {
        // Validation
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['min:8','required' ,'confirmed']
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $notification = [
                'message' => 'The old password is incorrect',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        } else {
            $newPassword = Hash::make($request->new_password);

            if ($newPassword) {
                User::whereId(auth()->user()->id)->update([
                    'password' => $newPassword
                ]);

                $notification = [
                    'message' => 'Password updated successfully',
                    'alert-type' => 'success',
                ];

                Auth::logout();
                return redirect()->route('login')->with($notification);
            } else {
                $notification = [
                    'message' => 'Failed to update password',
                    'alert-type' => 'error',
                ];

                return back()->with($notification);
            }
        }
    }
    
    public function destroy(Request $request): RedirectResponse
    {
        $notification = [
            'message' => 'You have been successfully logged out!',
            'alert-type' => 'success',
        ];
        
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('alert-type', $notification['alert-type']); // Flash the alert type
        Session::flash('message', $notification['message']); // Flash the message
        
        return redirect('/login');
        
    }
    
    public function emailVerify () {
        return view('auth.verify-email');
    }
}
