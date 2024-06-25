<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function view () {
        return view('dashboard.customers.customer');
    }

    public function create () {
        return view ('dashboard.customers.customer_add');
    }

    public function StoreType(Request $request) {
        $request->validate([
            'type_name' => 'required|unique:property_types|max:40',
            'type_icon' => 'required'
        ]);

        Customer::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon 
        ]);

        $notification = [
            'message' => 'Property Type has been added',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.types')->with($notification);
    }

    public function EditType($id) {
        $types = Customer::findOrFail($id);
        return view('backend.type.edit_type', compact('types'));
    }

    public function UpdateType(Request $request) {
        
        $pid = $request->id;

        Customer::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon 
        ]);

        $notification = [
            'message' => 'Property Type has been updated',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.types')->with($notification);
    }

    public function DeleteType($id) {
        
        Customer::findOrFail($id)->delete();

        $notification = [
            'message' => 'Property Type has been delete',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.types')->with($notification);
    }
}
