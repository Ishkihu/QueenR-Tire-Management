<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryTransactionRequest;
use App\Http\Requests\UpdateInventoryTransactionRequest;
use App\Http\Resources\InventoryTransactionResource;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => InventoryTransactionResource::collection(InventoryTransaction::with(['inventory', 'employee'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreInventoryTransactionRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $transaction = InventoryTransaction::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new InventoryTransactionResource($transaction->load(['inventory', 'employee']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(InventoryTransaction $inventoryTransaction)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new InventoryTransactionResource($inventoryTransaction->load(['inventory', 'employee']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateInventoryTransactionRequest $request, InventoryTransaction $inventoryTransaction)
    {
        try {
            $validated = $request->validated();
            
            $inventoryTransaction->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new InventoryTransactionResource($inventoryTransaction->load(['inventory', 'employee']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(InventoryTransaction $inventoryTransaction)
    {
        try {
            $inventoryTransaction->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Inventory transaction deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}