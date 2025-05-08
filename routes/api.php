<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\InventoryTransactionController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\SaleItemController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServiceLogController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\EmployeePerformanceController;
use App\Http\Controllers\Api\FinancialSummaryController;
use App\Http\Controllers\Api\AuditLogController;

// Public routes for authentication
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);

Route::get('test', function() {
    return ['message' => 'API is working'];
});


// ROUTES ARE TEMPORARILY OPEN FOR TESTING PURPOSES

Route::apiResource('customers', CustomerController::class);
Route::apiResource('audit-logs', AuditLogController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('vehicles', VehicleController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('inventory', InventoryController::class);
Route::apiResource('inventory-transactions', InventoryTransactionController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('sale-items', SaleItemController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('service-logs', ServiceLogController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('expenses', ExpenseController::class);
Route::apiResource('employee-performance', EmployeePerformanceController::class);
Route::apiResource('financial-summaries', FinancialSummaryController::class);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Authentication
    Route::post('logout', [AuthController::class, 'logout']);
    
    // API Resources
});