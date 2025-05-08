<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => SupplierResource::collection(Supplier::with('inventory')->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreSupplierRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $supplier = Supplier::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new SupplierResource($supplier->load('inventory'))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Supplier $supplier)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new SupplierResource($supplier->load('inventory'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        try {
            $validated = $request->validated();
            
            $supplier->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new SupplierResource($supplier->load('inventory'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Supplier deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}