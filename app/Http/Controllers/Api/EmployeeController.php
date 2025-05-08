<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => EmployeeResource::collection(Employee::with('role')->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $employee = Employee::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new EmployeeResource($employee->load('role'))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Employee $employee)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new EmployeeResource($employee->load('role'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $validated = $request->validated();
            
            $employee->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new EmployeeResource($employee->load('role'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}