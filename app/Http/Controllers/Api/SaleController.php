<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => SaleResource::collection(Sale::with(['items', 'employee', 'customer'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreSaleRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $sale = Sale::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new SaleResource($sale->load(['items', 'employee', 'customer']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Sale $sale)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new SaleResource($sale->load(['items', 'employee', 'customer']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        try {
            $validated = $request->validated();
            
            $sale->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new SaleResource($sale->load(['items', 'employee', 'customer']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Sale $sale)
    {
        try {
            $sale->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Sale deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}