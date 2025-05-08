<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuditLogRequest;
use App\Http\Requests\UpdateAuditLogRequest;
use App\Http\Resources\AuditLogResource;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => AuditLogResource::collection(AuditLog::with(['employee'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreAuditLogRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $auditLog = AuditLog::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new AuditLogResource($auditLog->load('employee'))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(AuditLog $auditLog)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new AuditLogResource($auditLog->load('employee'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateAuditLogRequest $request, AuditLog $auditLog)
    {
        try {
            $validated = $request->validated();
            
            $auditLog->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new AuditLogResource($auditLog->load('employee'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(AuditLog $auditLog)
    {
        try {
            $auditLog->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Audit log deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}