<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function view () {
        $coupons = Coupon::all();
        
        return view('dashboard.coupons.coupon', compact('coupons'));
    }

    public function create () {
        return view ('dashboard.coupons.coupon_add');
    }

    public function update ($id) {
        $coupon = Coupon::where('coupon_id', $id)->first();

        if(!$coupon) {
            $notification = [
                'message' => 'Coupon not found',
                'alert-type' => 'error',
            ];
            return redirect()->route('coupon')->with($notification);
        }

        return view ('dashboard.coupons.coupon_edit', compact('coupon'));
    }

    public function store (Request $request) {
        $request->validate([
            'coupon_code' => 'required|max:40',
            'price' => 'required|numeric|min:0'
        ]);

        $coupon = Coupon::create([
            'coupon_code' => $request->coupon_code,
            'price' => $request->price 
        ]);

        if ($coupon) {
            $notification = [
                'message' => 'Coupon has been successfully added',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Coupon has been failed to added',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('coupon')->with($notification);
    }

    public function updateStore (Request $request) {
        $request->validate([
            'coupon_code' => 'required|max:40',
            'price' => 'required|numeric|min:0'
        ]);

        $coupon = Coupon::findOrFail($request->coupon_id);

        if ($coupon) {
            $coupon->coupon_code = $request->coupon_code;
            $coupon->price = $request->price;
            $coupon->save();

            $notification = [
                'message' => 'Coupon has been successfully updated',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Coupon has been failed to update',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('coupon')->with($notification);
    }

    public function destroy ($id) {
        Coupon::findOrFail($id)->delete();

        $notification = [
            'message' => 'Coupon has been successfully delete',
            'alert-type' => 'success'
        ];

        return redirect()->route('coupon')->with($notification);
    }
}
