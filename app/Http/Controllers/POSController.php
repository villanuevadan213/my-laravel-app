<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class POSController extends Controller
{
    public function index()
    {
        // Fetch all inventory items to display in the POS interface
        $items = Item::all();

        // Return the view with the fetched data
        return view('pos.index', compact('items'));
    }

    public function checkout(Request $request)
    {
        $cartJson = $request->input('cart'); // Get the cart data
        if (!$cartJson) {
            return redirect()->route('pos')->with('error', 'Cart is empty.');
        }

        dd($cartJson);
    
        // Decode the cart data
        $cartItems = json_decode($cartJson, true);
    
        DB::beginTransaction();
        try {
            $total = 0;
    
            // Loop through each item in the cart
            foreach ($cartItems as $itemData) {
                $item = Item::find($itemData['id']); // Find the item by ID
    
                // Check if the item exists and if there's enough stock
                if (!$item || $item->stock < $itemData['qty']) {
                    throw new \Exception("Item not found or not enough stock.");
                }
    
                // Update the stock in the inventory
                $item->stock -= $itemData['qty'];
                $item->save();
    
                // Calculate the total price
                $total += $itemData['qty'] * $itemData['price'];
    
                // Optional: You can insert this sale into a separate table for tracking sales
                // Sale::create([...]);
            }
    
            // Commit the transaction if everything is successful
            DB::commit();
    
            // Redirect back with a success message, showing the total price
            return redirect()->route('pos')->with('success', 'Checkout successful! Total: ₱' . number_format($total, 2));
    
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if there's an error
            Log::error('Checkout failed: ' . $e->getMessage());
            return redirect()->route('pos')->with('error', 'Checkout failed. ' . $e->getMessage());
        }
    }
    
}
