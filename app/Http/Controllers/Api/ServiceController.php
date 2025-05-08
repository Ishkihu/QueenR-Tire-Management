<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => ServiceResource::collection(Service::with(['employee', 'customer', 'vehicle', 'serviceLogs'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $service = Service::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new ServiceResource($service->load(['employee', 'customer', 'vehicle', 'serviceLogs']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Service $service)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new ServiceResource($service->load(['employee', 'customer', 'vehicle', 'serviceLogs']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        try {
            $validated = $request->validated();
            
            $service->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new ServiceResource($service->load(['employee', 'customer', 'vehicle', 'serviceLogs']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Service deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}