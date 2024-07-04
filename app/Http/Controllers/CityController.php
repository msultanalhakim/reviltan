<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Province;
use App\Models\City;

class CityController extends Controller
{
    public function view () {
        $cities = City::select('cities.*', 'provinces.*')
        ->join('provinces', 'cities.province_id', '=', 'provinces.province_id')
        ->orderBy('cities.created_at', 'desc')
        ->get();
        
        return view('dashboard.cities.city', compact('cities'));
    }

    public function create () {
        $provinces = Province::latest()->get();
        return view ('dashboard.cities.city_add', compact('provinces'));
    }

    public function update ($id) {
        $city = City::join('provinces', 'provinces.province_id', '=', 'cities.province_id')
        ->findOrFail($id);

        $provinces = Province::all();

        return view ('dashboard.cities.city_edit', compact('city', 'provinces'));
    }

    public function store (Request $request) {
        $request->validate([
            'city_name' => 'required|max:40',
            'province_id' => 'required'
        ]);

        City::create([
            'city_name' => $request->city_name,
            'province_id' => $request->province_id 
        ]);

        $notification = [
            'message' => 'City has been successfully added',
            'alert-type' => 'success',
        ];

        return redirect()->route('city')->with($notification);
    }

    public function updateStore (Request $request) {
        $request->validate([
            'city_name' => 'required|max:40',
            'province_id' => 'required'
        ]);

        $city = City::findOrFail($request->city_id);

        if ($city) {
            $city->city_name = $request->city_name;
            $city->province_id = $request->province_id;
            $city->save();

            $notification = [
                'message' => 'City has been successfully updated',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'City has been failed to update',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('city')->with($notification);
    }

    public function destroy ($id) {
        City::findOrFail($id)->delete();

        $notification = [
            'message' => 'City has been successfully delete',
            'alert-type' => 'success'
        ];

        return redirect()->route('city')->with($notification);
    }
}
