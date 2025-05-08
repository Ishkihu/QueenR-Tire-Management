<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => PaymentResource::collection(Payment::with(['sale', 'service', 'customer', 'employee'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StorePaymentRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $payment = Payment::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new PaymentResource($payment->load(['sale', 'service', 'customer', 'employee']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Payment $payment)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new PaymentResource($payment->load(['sale', 'service', 'customer', 'employee']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        try {
            $validated = $request->validated();
            
            $payment->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new PaymentResource($payment->load(['sale', 'service', 'customer', 'employee']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}