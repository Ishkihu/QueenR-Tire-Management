<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->integer('access_level')->nullable()->comment('numeric access level');
        });

        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_code', 20)->unique();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->enum('status', ['active', 'on-leave', 'terminated'])->default('active');
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_number', 20)->unique();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('contact', 20)->nullable();
            $table->integer('loyalty_points')->default(0);
            $table->timestamps();
        });

        Schema::create('auditlog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name', 50);
            $table->unsignedInteger('record_id');
            $table->string('field_name', 50)->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->enum('action_type', ['INSERT', 'UPDATE', 'DELETE']);
            $table->dateTime('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('employee_id')->nullable()->constrained('employee');
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category', 50);
            $table->decimal('amount', 12, 2)->unsigned();
            $table->date('transaction_date');
            $table->foreignId('approved_by')->nullable()->constrained('employee');
        });

        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicleType', 50)->nullable();
            $table->string('itemType', 50)->nullable();
            $table->string('brand', 100)->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('price', 10, 2)->unsigned()->default(0.00);
            $table->decimal('cost', 10, 2)->unsigned()->default(0.00);
            $table->foreignId('last_updated_by')->nullable()->constrained('employee');
            $table->enum('status', ['active', 'low', 'discontinued'])->default('active');
        });

        Schema::create('employee_performance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('employee_id')->nullable()->constrained('employee');
            $table->date('period_start_date')->nullable();
            $table->date('period_end_date')->nullable();
            $table->decimal('total_sales', 12, 2)->nullable();
            $table->decimal('total_services', 12, 2)->nullable();
            $table->decimal('performance_rating', 3, 1)->nullable();
            $table->timestamps();
        });

        Schema::create('monthly_summary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('month')->nullable();
            $table->decimal('total_sales', 14, 2)->nullable();
            $table->decimal('total_services', 14, 2)->nullable();
            $table->decimal('total_expenses', 14, 2)->nullable();
            $table->integer('customer_count')->nullable();
            $table->foreignId('top_employee_id')->nullable()->constrained('employee');
            $table->timestamps();
        });

        Schema::create('profit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('period_start_date')->nullable();
            $table->date('period_end_date')->nullable();
            $table->decimal('total_revenue', 14, 2)->nullable();
            $table->decimal('total_expenses', 14, 2)->nullable();
            $table->decimal('net_profit', 14, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50);
            $table->date('sale_date');
            $table->decimal('subtotal', 12, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 12, 2)->default(0.00);
            $table->foreignId('employee_id')->constrained('employee');
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamps();
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sale_id')->constrained('sales');
            $table->foreignId('inventory_id')->constrained('inventory');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->decimal('line_total', 10, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->timestamp('scheduled_date')->useCurrent();
            $table->foreignId('assigned_employee_id')->constrained('employee');
            $table->foreignId('customer_id')->constrained('customers');
            $table->enum('status', ['scheduled', 'in-progress', 'completed'])->default('scheduled');
            $table->timestamps();
        });

        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sale_id')->constrained('sales');
            $table->foreignId('services_id')->constrained('services');
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('transaction_code', 50);
            $table->dateTime('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('payment_method', ['Cash', 'Credit Card', 'Check', 'Online'])->default('Cash');
            $table->decimal('amount', 10, 2)->unsigned()->default(0.00);
            $table->string('reference_number', 50)->nullable();
            $table->enum('status', ['Completed', 'Pending', 'Failed'])->default('Pending');
            $table->foreignId('employee_id')->constrained('employee');
        });

        Schema::create('service_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('payment_id')->nullable()->constrained('payment');
            $table->dateTime('timestamp');
            $table->string('activity_type', 50);
            $table->text('notes')->nullable();
            $table->text('parts_used')->nullable();
            $table->foreignId('employee_id')->constrained('employee');
            $table->string('vehicles_details', 100)->nullable();
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

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->foreignId('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('service_logs');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('services');
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('profit');
        Schema::dropIfExists('monthly_summary');
        Schema::dropIfExists('employee_performance');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('auditlog');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('roles');
    }
};
