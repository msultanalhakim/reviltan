<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function view() {
        $email = Auth::user()->email;
        $histories = History::where('email', $email)->get();

        return view('dashboard.histories.history', compact('histories'));
    }

    public function viewDetails($id) {
        $history = History::where('reference_number', $id)->first();
        $items = Detail::where('reference_number', $history->reference_number)
        ->join('items', 'details.item_id', '=', 'items.item_id')
        ->get();

        return view('dashboard.histories.history_details', compact('history', 'items'));
    }
}
