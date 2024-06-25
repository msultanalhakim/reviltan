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

    public function store (Request $request) {
        $request->validate([
            'city_name' => 'required|max:40',
            'province_id' => 'required'
        ]);

        City::create([
            'city_name' => $request->city_name,
            'province_id' => $request->province_id 
        ]);

        return redirect()->route('city');
    }
}
