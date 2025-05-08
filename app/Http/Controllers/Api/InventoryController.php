<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => InventoryResource::collection(Inventory::with(['supplier', 'transactions'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreInventoryRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $inventory = Inventory::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new InventoryResource($inventory->load(['supplier', 'transactions']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Inventory $inventory)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new InventoryResource($inventory->load(['supplier', 'transactions']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        try {
            $validated = $request->validated();
            
            $inventory->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new InventoryResource($inventory->load(['supplier', 'transactions']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Inventory $inventory)
    {
        try {
            $inventory->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Inventory item deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}