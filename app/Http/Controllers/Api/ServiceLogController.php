<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceLogRequest;
use App\Http\Requests\UpdateServiceLogRequest;
use App\Http\Resources\ServiceLogResource;
use App\Models\ServiceLog;
use Illuminate\Http\Request;

class ServiceLogController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => ServiceLogResource::collection(ServiceLog::with(['service', 'employee'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreServiceLogRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $serviceLog = ServiceLog::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new ServiceLogResource($serviceLog->load(['service', 'employee']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(ServiceLog $serviceLog)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new ServiceLogResource($serviceLog->load(['service', 'employee']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateServiceLogRequest $request, ServiceLog $serviceLog)
    {
        try {
            $validated = $request->validated();
            
            $serviceLog->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new ServiceLogResource($serviceLog->load(['service', 'employee']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(ServiceLog $serviceLog)
    {
        try {
            $serviceLog->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Service log deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}