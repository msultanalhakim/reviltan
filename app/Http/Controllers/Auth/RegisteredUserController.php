<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Aturan validasi unique untuk kolom 'username' dalam tabel 'users'
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'], // Aturan validasi unique untuk kolom 'email' dalam tabel 'users'
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:255'],
        ]);
        
        $customers = Customer::where('email', $request->email)->first();
        $users = User::where('email', $request->email)->first();

        if ($customers && !$users) {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Set the user_id on the existing customer
            $user->customer_id = $customers->customer_id;
            $user->save();
    
            event(new Registered($user));
    
            Auth::login($user);

            $notification = [
                'message' => 'You have successfully registered!',
                'alert-type' => 'success',
            ];

            return redirect(route('dashboard', absolute: false))->with($notification);
        }
        
        if (!$customers && !$users) {
            // Jika tidak ada user maupun pelanggan dengan email yang sama
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Buat pelanggan baru terkait dengan user baru
            $customer = Customer::create([
                'email' => $request->email,
            ]);

            $user->customer_id = $customer->customer_id;
            $user->save(); // Save the user
            

            event(new Registered($user));

            Auth::login($user);

            $notification = [
                'message' => 'You have successfully registered!',
                'alert-type' => 'success',
            ];

            return redirect(route('dashboard', absolute: false))->with($notification);
        }
    }
}
