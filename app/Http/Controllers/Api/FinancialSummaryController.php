<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinancialSummaryRequest;
use App\Http\Requests\UpdateFinancialSummaryRequest;
use App\Http\Resources\FinancialSummaryResource;
use App\Models\FinancialSummary;
use Illuminate\Http\Request;

class FinancialSummaryController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => FinancialSummaryResource::collection(FinancialSummary::with('generator')->get())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreFinancialSummaryRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $summary = FinancialSummary::create($validated);

            return response()->json([
                'status' => 'success',
                'data' => new FinancialSummaryResource($summary->load('generator'))
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(FinancialSummary $financialSummary)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => new FinancialSummaryResource($financialSummary->load('generator'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateFinancialSummaryRequest $request, FinancialSummary $financialSummary)
    {
        try {
            $validated = $request->validated();
            
            $financialSummary->update($validated);

            return response()->json([
                'status' => 'success',
                'data' => new FinancialSummaryResource($financialSummary->load('generator'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(FinancialSummary $financialSummary)
    {
        try {
            $financialSummary->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Financial summary deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}