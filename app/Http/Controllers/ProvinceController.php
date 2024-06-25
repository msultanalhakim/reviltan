<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function view () {
        $provinces = Province::latest()->get();
        return view('dashboard.provinces.province', compact('provinces'));
    }

    public function create () {
        return view ('dashboard.provinces.province_add');
    }

    public function store (Request $request) {
        $request->validate([
            'province_name' => 'required|max:40',
        ]);

        Province::create([
            'province_name' => $request->province_name,
        ]);

        // $notification = [
        //     'message' => 'Property Type has been added',
        //     'alert-type' => 'success',
        // ];

        return redirect()->route('province');
    }

    public function AdminChangePassword() {
        $id = Auth::user()->id;
        $profileData = Province::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request) {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
            // 'new_password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised()],
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
                Province::whereId(auth()->user()->id)->update([
                    'password' => $newPassword
                ]);

                $notification = [
                    'message' => 'Password updated successfully',
                    'alert-type' => 'success',
                ];

                return back()->with($notification);
            } else {
                $notification = [
                    'message' => 'Failed to update password',
                    'alert-type' => 'error',
                ];

                return back()->with($notification);
            }
        }
    }
}
