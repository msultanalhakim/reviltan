<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function view () {
        $transactionData = Transaction::leftJoin('customers', 'transactions.customer_id', '=', 'customers.customer_id')
                                    ->leftJoin('vehicles', 'transactions.vehicle_id', '=', 'vehicles.vehicle_id')
                                    ->select('transactions.*', 'customers.customer_name', 'customers.email', 'vehicles.vehicle_name', 'vehicles.plate_number')
                                    ->get();

        return view('dashboard.transactions.transaction', compact('transactionData'));
    }

    public function viewManage ($id) {
        $fetchCode = Item::get();
        $transactionData = Transaction::where('transactions.reference_number', $id)
                                ->join('vehicles', 'transactions.vehicle_id', '=', 'vehicles.vehicle_id')
                                ->join('customers', 'transactions.customer_id', '=', 'customers.customer_id')
                                ->select('transactions.*', 'vehicles.vehicle_name', 'vehicles.plate_number', 'customers.customer_name', 'customers.email')
                                ->firstOrFail();

        $detailsData = Detail::where('reference_number', $id)
                            ->join('items', 'items.item_id', '=', 'details.item_id')
                            ->get();

        return view('dashboard.transactions.transaction_manage', compact('fetchCode', 'transactionData', 'detailsData'));
    }

    public function fetchItem(Request $request)
    {
        $data = Item::where('item_id', $request->item_id)
            ->get(['item_id', 'item_code', 'item_name', 'price']);
    
        return response()->json($data);
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'reference_number' => 'required',
            'item_id' => 'required',
            'quantity' => ['required', 'min:0', 'max:200']
        ]);

        $reference_number = $request->reference_number;
        $item_id = $request->item_id;
        $new_quantity = $request->quantity;
    
        // Check if the Detail already exists for the given reference_number and item_id
        $existingDetail = Detail::where('reference_number', $reference_number)
                                ->where('item_id', $item_id)
                                ->first();

        if($existingDetail) {
            $existingDetail->quantity += $new_quantity;
            $existingDetail->save();

            $notification = [
                'message' => 'Quantity updated for existing item.',
                'alert-type' => 'success',
            ];
        } else {
            Detail::create([
                'reference_number' => $request->reference_number,
                'item_id' => $request->item_id,
                'quantity' => $request->quantity
            ]);

            $notification = [
                'message' => 'Item has been successfully added',
                'alert-type' => 'success',
            ];
        }

        return redirect()->route('transaction.manage', ['id' => $reference_number])->with($notification);
    }

    public function storeManage(Request $request)
    {
        $request->validate([
            'reference_number' => 'required',
            'customer_name' => 'required',
            'vehicle_name' => 'required',
            'plate_number' => 'required',
            'total' => 'required'
        ]);

        $reference_number = $request->reference_number;

        if ($request->has('action')) {
            $action = $request->input('action');
    
            if ($action === 'approve') {
                // Handle approve action
            } elseif ($action === 'reject') {
                // Handle reject action
            } elseif ($action === 'proceed') {
                // Handle proceed action
                $transaction = Transaction::where('reference_number', $reference_number)
                                        ->first();

                if ($transaction) {
                    $transaction->total = $request->total;
                    $transaction->save();
                }
            }
        }

        

        $notification = [
            'message' => 'Transaction has been successfully proceeded',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('transaction.manage', ['id' => $reference_number])->with($notification);
    }
}
