<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeePerformanceRequest;
use App\Http\Requests\UpdateEmployeePerformanceRequest;
use App\Http\Resources\EmployeePerformanceResource;
use App\Models\EmployeePerformance;
use Illuminate\Http\Request;

class EmployeePerformanceController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => EmployeePerformanceResource::collection(EmployeePerformance::with('employee')->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreEmployeePerformanceRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $performance = EmployeePerformance::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new EmployeePerformanceResource($performance->load('employee'))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(EmployeePerformance $employeePerformance)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new EmployeePerformanceResource($employeePerformance->load('employee'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateEmployeePerformanceRequest $request, EmployeePerformance $employeePerformance)
    {
        try {
            $validated = $request->validated();
            
            $employeePerformance->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new EmployeePerformanceResource($employeePerformance->load('employee'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(EmployeePerformance $employeePerformance)
    {
        try {
            $employeePerformance->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee performance record deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}