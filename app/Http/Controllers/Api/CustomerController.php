<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => CustomerResource::collection(Customer::with(['vehicles', 'services'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $validated = $request->validated();
            $customer = Customer::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new CustomerResource($customer->load(['vehicles', 'services']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Customer $customer)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new CustomerResource($customer->load(['vehicles', 'services']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            $validated = $request->validated();
            $customer->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new CustomerResource($customer->load(['vehicles', 'services']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}