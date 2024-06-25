<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailInUsersAndCustomers;
use App\Models\User;
use App\Models\Customer;

class AccountController extends Controller
{
    public function view () {
        $accounts = User::all();

        return view('dashboard.accounts.account', compact('accounts'));
    }

    public function create () {
        return view ('dashboard.accounts.account_add');
    }

    public function store (Request $request) {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Unique validation rule for 'username' in 'users' table
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', new UniqueEmailInUsersAndCustomers], // Custom validation rule for 'email'
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:255'],
            'role' => ['required']
        ]);

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
    
            // Buat pelanggan baru terkait dengan user baru
            $customer = Customer::create([
                'email' => $request->email,
            ]);

            // Set the user's customer_id to the newly created customer's ID
            $user->customer_id = $customer->id;
            $user->save(); // Save the user
        
            event(new Registered($user));
        
            Auth::login($user);
            $user->save();
    
            event(new Registered($user));
        
            return redirect(route('dashboard.users.user', absolute: false));
        }
}
