<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function view () {
        $items = Item::all();
        
        return view('dashboard.items.item', compact('items'));
    }

    public function create () {
        return view ('dashboard.items.item_add');
    }

    public function update ($id) {
        $item = Item::where('item_id', $id)->first();

        if(!$item) {
            $notification = [
                'message' => 'Item not found',
                'alert-type' => 'error',
            ];
            return redirect()->route('item')->with($notification);
        }

        return view ('dashboard.items.item_edit', compact('item'));
    }

    public function store (Request $request) {
        $request->validate([
            'item_code' => 'required|max:40',
            'item_name' => 'required|max:40',
            'price' => 'required|numeric|min:0'
        ]);

        $item = Item::create([
            'item_code' => $request->item_code,
            'item_name' => $request->item_name,
            'price' => $request->price 
        ]);

        if ($item) {
            $notification = [
                'message' => 'Item has been successfully added',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Item has been failed to added',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('item')->with($notification);
    }

    public function updateStore (Request $request) {
        $request->validate([
            'item_code' => 'required|max:40',
            'item_name' => 'required|max:40',
            'price' => 'required|numeric|min:0'
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($item) {
            $item->item_code = $request->item_code;
            $item->item_name = $request->item_name;
            $item->price = $request->price;
            $item->save();

            $notification = [
                'message' => 'Item has been successfully updated',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Item has been failed to update',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('item')->with($notification);
    }

    public function destroy ($id) {
        Item::findOrFail($id)->delete();

        $notification = [
            'message' => 'Item has been successfully delete',
            'alert-type' => 'success'
        ];

        return redirect()->route('item')->with($notification);
    }
}
