<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->integer('access_level')->nullable();
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('contact_person', 50);
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });

        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_code', 20)->unique();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->unsignedBigInteger('role_id')->nullable(); // FK to roles
            $table->enum('status', ['active', 'on-leave', 'terminated'])->default('active');

            $table->index('role_id');
        });

        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->nullable();
            $table->string('vehicleType', 50)->nullable();
            $table->string('itemType', 50)->nullable();
            $table->string('brand', 100)->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('cost', 10, 2)->default(0.00);
            $table->unsignedBigInteger('last_updated_by')->nullable(); // FK to employee
            $table->enum('status', ['active', 'low', 'discontinued'])->default('active');
            $table->unsignedBigInteger('supplier_id')->nullable(); // FK to supplier

            $table->index(['last_updated_by', 'supplier_id']);
        });

        Schema::create('inventory_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventory_id'); // FK to inventory
            $table->integer('quantity_change');
            $table->string('transaction_type');
            $table->dateTime('transaction_date');
            $table->unsignedBigInteger('employee_id'); // FK to employee
            $table->text('notes')->nullable();
        });

        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_number', 20)->unique();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('contact', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
        });

        Schema::create('vehicle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id'); // FK to customer
            $table->string('car_brand');
            $table->string('model');
            $table->string('year');
            $table->string('license_plate');
        });

        Schema::create('sale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->date('sale_date');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('total_amount', 12, 2);
            $table->unsignedBigInteger('employee_id'); // FK to employee
            $table->unsignedBigInteger('customer_id'); // FK to customer
        });

        Schema::create('sale_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id'); // FK to sale
            $table->unsignedBigInteger('inventory_id'); // FK to inventory
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('line_total', 10, 2);
        });

        Schema::create('service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->timestamp('scheduled_date')->useCurrent();
            $table->integer('estimated_duration');
            $table->unsignedBigInteger('assigned_employee_id'); // FK to employee
            $table->unsignedBigInteger('customer_id'); // FK to customer
            $table->unsignedBigInteger('vehicle_id'); // FK to vehicle
            $table->enum('status', ['scheduled', 'in-progress', 'completed'])->default('scheduled');
        });

        Schema::create('service_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id'); // FK to service
            $table->timestamp('timestamp')->useCurrent();
            $table->string('activity_type');
            $table->text('notes')->nullable();
            $table->text('parts_used')->nullable();
            $table->unsignedBigInteger('employee_id'); // FK to employee
        });

        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id')->nullable(); // FK to sale
            $table->unsignedBigInteger('service_id')->nullable(); // FK to service
            $table->unsignedBigInteger('customer_id'); // FK to customer
            $table->string('transaction_code');
            $table->dateTime('payment_date');
            $table->enum('payment_method', ['cash', 'credit_card', 'bank_transfer']);
            $table->decimal('amount', 12, 2);
            $table->string('reference_number')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->unsignedBigInteger('employee_id'); // FK to employee
        });

        Schema::create('expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->decimal('amount', 12, 2);
            $table->date('transaction_date');
            $table->unsignedBigInteger('approved_by'); // FK to employee
            $table->unsignedBigInteger('supplier_id'); // FK to supplier
        });

        Schema::create('financial_summary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('period_start_date');
            $table->date('period_end_date');
            $table->decimal('total_revenue', 14, 2);
            $table->decimal('total_expenses', 14, 2);
            $table->decimal('net_profit', 14, 2);
            $table->decimal('total_sales', 14, 2);
            $table->decimal('total_services', 14, 2);
            $table->integer('customer_count');
            $table->unsignedBigInteger('generated_by'); // FK to employee
        });

        Schema::create('employee_performance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id'); // FK to employee
            $table->date('period_start_date');
            $table->date('period_end_date');
            $table->decimal('total_sales', 12, 2);
            $table->decimal('total_services', 12, 2);
            $table->decimal('performance_rating', 3, 1);
        });

        Schema::create('audit_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name');
            $table->unsignedBigInteger('record_id');
            $table->string('field_name')->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('action_type');
            $table->dateTime('timestamp')->useCurrent();
            $table->unsignedBigInteger('employee_id'); // FK to employee
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_log');
        Schema::dropIfExists('employee_performance');
        Schema::dropIfExists('financial_summary');
        Schema::dropIfExists('expense');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('service_log');
        Schema::dropIfExists('service');
        Schema::dropIfExists('sale_item');
        Schema::dropIfExists('sale');
        Schema::dropIfExists('vehicle');
        Schema::dropIfExists('customer');
        Schema::dropIfExists('inventory_transaction');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('roles');
    }
};
