<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => VehicleResource::collection(Vehicle::with(['customer', 'services'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreVehicleRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $vehicle = Vehicle::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new VehicleResource($vehicle->load(['customer', 'services']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Vehicle $vehicle)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new VehicleResource($vehicle->load(['customer', 'services']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $validated = $request->validated();
            
            $vehicle->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new VehicleResource($vehicle->load(['customer', 'services']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}