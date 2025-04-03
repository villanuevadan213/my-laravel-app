<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        $items = Item::with('supplier')->latest()->simplePaginate(3);

        return view('items.index', [
            'items' => $items
        ]);
    }

    public function create() {
        return view('items.create');
    }

    public function show(Item $item) {
        return view('items.show', ['item' => $item]);
    }

    public function store() {
        request()->validate([
            'name' => ['required', 'min:3'],
            'price' => ['required']
        ]);
    
        Item::create([
            'name' => request('name'),
            'price' => request('price'),
            'supplier_id' => 1
        ]);
    
        return redirect('/items');
    }

    public function edit(Item $item) {
        return view('items.edit', ['item' => $item]);
    }

    public function update(Item $item) {
        request()->validate([
            'name' => ['required', 'min:3'],
            'price' => ['required']
        ]);
    
        $item->update([
            'name' => request('name'),
            'price' => request('price'),
        ]);
    
        return redirect('/items/' . $item->id);
    }

    public function destroy(Item $item) {
        $item->delete();

        return redirect('/items');
    }
}
