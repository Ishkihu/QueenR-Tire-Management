<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => ExpenseResource::collection(Expense::with(['approver', 'supplier'])->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreExpenseRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $expense = Expense::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new ExpenseResource($expense->load(['approver', 'supplier']))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Expense $expense)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new ExpenseResource($expense->load(['approver', 'supplier']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        try {
            $validated = $request->validated();
            
            $expense->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new ExpenseResource($expense->load(['approver', 'supplier']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Expense deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}