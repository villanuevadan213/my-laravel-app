<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        // Fetch all inventory items to display in the POS interface
        $items = Item::all();

        // Return the view with the fetched data
        return view('pos.index', compact('items'));
    }
}
