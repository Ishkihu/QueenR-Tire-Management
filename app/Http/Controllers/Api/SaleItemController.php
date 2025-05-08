<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleItemRequest;
use App\Http\Requests\UpdateSaleItemRequest;
use App\Http\Resources\SaleItemResource;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => SaleItemResource::collection(SaleItem::with(['sale', 'inventory'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreSaleItemRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $saleItem = SaleItem::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new SaleItemResource($saleItem->load(['sale', 'inventory']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(SaleItem $saleItem)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new SaleItemResource($saleItem->load(['sale', 'inventory']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateSaleItemRequest $request, SaleItem $saleItem)
    {
        try {
            $validated = $request->validated();
            
            $saleItem->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new SaleItemResource($saleItem->load(['sale', 'inventory']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(SaleItem $saleItem)
    {
        try {
            $saleItem->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Sale item deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}