<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Supplier;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'date_received' => 'required',
            'transaction_number' => 'required',
            'items' => 'required|array',
            'items.*.name' => 'required',
            'items.*.quantity' => 'required',
            'items.*.price' => 'required',
            'items.*.description' => 'nullable',
        ]);

        $dateReceived = $validatedData['date_received'];
        $transactionNumber = $validatedData['transaction_number'];
        $supplierId = $validatedData['supplier_id'];

        $itemsData = $validatedData['items'];

        foreach ($itemsData as $itemData) {
            Item::create([
                'date_received' => $dateReceived,
                'transaction_number' => $transactionNumber,
                'supplier_id' => $supplierId,
                'name' => $itemData['name'],
                'price' => $itemData['price'],
                'quantity' => $itemData['quantity'],
                'description' => $itemData['description'],
            ]);
        }

        return response()->json(['message' => 'Items created successfully!'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'date_received' => 'required',
            'transaction_number' => 'required',
            'items' => 'required|array',
            'items.*.name' => 'required',
            'items.*.quantity' => 'required',
            'items.*.price' => 'required',
            'items.*.description' => 'nullable',
        ]);
        
        $dateReceived = $validatedData['date_received'];
        $transactionNumber = $validatedData['transaction_number'];
        $supplierId = $validatedData['supplier_id'];
        
        $itemsData = $validatedData['items'];
        
        foreach ($itemsData as $itemData) {
            $item->update([
                'date_received' => $dateReceived,
                'transaction_number' => $transactionNumber,
                'supplier_id' => $supplierId,
                'name' => $itemData['name'],
                'price' => $itemData['price'],
                'quantity' => $itemData['quantity'],
                'description' => $itemData['description'],
            ]);
        }
        
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $items = Item::findOrFail($id);
        $items->delete();

        return response()->noContent();
    }
}
