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

    public function update ($id) {
        $province = Province::where('province_id', $id)->first();

        if (!$province){
            $notification = [
                'message' => 'Province not found',
                'alert-type' => 'error'
            ];
            
            return redirect()->route('province')->with($notification);
        } 

        return view ('dashboard.provinces.province_edit', compact('province'));
    }

    public function store (Request $request) {
        $request->validate([
            'province_name' => 'required|max:40',
        ]);

        Province::create([
            'province_name' => $request->province_name,
        ]);

        $notification = [
            'message' => 'Province has been successfully added',
            'alert-type' => 'success',
        ];

        return redirect()->route('province')->with($notification);
    }

    public function storeUpdate (Request $request) {
        $request->validate([
            'province_name' => 'required|max:40',
        ]);

        $province = Province::findOrFail($request->province_id);

        if ($province) {
            $province->province_name = $request->province_name;
            $province->save();

            $notification = [
                'message' => 'Province has been successfully updated',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Province has been failed to update',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('province')->with($notification);
    }

    public function destroy ($id) {
        
        $province = Province::findOrFail($id)->delete();

        if ($province) {
            $notification = [
                'message' => 'Province has been successfully delete',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Province has been failed to delete',
                'alert-type' => 'error'
            ];
        }

        return redirect()->route('province')->with($notification);
    }
}
