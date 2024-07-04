<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Rules\UniqueEmailInUsersAndCustomers;

class AccountController extends Controller
{
    public function view () {
        $accounts = User::all();

        return view('dashboard.accounts.account', compact('accounts'));
    }

    public function create () {
        return view ('dashboard.accounts.account_add');
    }

    public function update ($id) {
        $account = User::findOrFail($id);

        return view ('dashboard.accounts.account_edit', compact('account'));
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

    public function updateStore (Request $request) {
        $account = User::findOrFail($request->id);

        $request->validate([
            'username' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('users')->ignore($account->id), // Ignore the current user's ID
                    ],
            'role' => 'required',
            'status' => 'required'
        ]);


        if ($account) {
            $account->username = $request->username;
            $account->role = $request->role;
            $account->status = $request->status;
            $account->save();

            $notification = array(
                'message' => 'Account has been successfully updated',
                'alert-type' => 'success',
            );

            return redirect()->route('account')->with($notification);
        }
    }
}
