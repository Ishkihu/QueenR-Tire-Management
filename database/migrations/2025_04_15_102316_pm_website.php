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
            $table->integer('access_level')->nullable()->comment('numeric access level');
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
            $table->unsignedBigInteger('role_id')->nullable()->comment('Foreign Key to roles table');
            $table->enum('status', ['active', 'on-leave', 'terminated'])->default('active');

            $table->index('role_id');
            // TODO: Add foreign key constraint for role_id
        });

        Schema::create('auditlog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name', 50);
            $table->unsignedInteger('record_id');
            $table->string('field_name', 50)->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->enum('action_type', ['INSERT', 'UPDATE', 'DELETE']);
            $table->dateTime('timestamp')->useCurrent();
            $table->unsignedInteger('employee_id')->nullable();

            $table->index('employee_id');
            // TODO: Add foreign key constraint for employee_id
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category', 50);
            $table->decimal('amount', 12, 2)->unsigned();
            $table->date('transaction_date');
            $table->unsignedBigInteger('approved_by')->nullable()->comment('Foreign Key');

            $table->index('category');
            $table->index('transaction_date');
            $table->index('approved_by');
            // TODO: Add foreign key constraint for approved_by
        });

        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicleType', 50)->nullable();
            $table->string('itemType', 50)->nullable();
            $table->string('brand', 100)->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('price', 10, 2)->unsigned()->default(0.00);
            $table->decimal('cost', 10, 2)->unsigned()->default(0.00);
            $table->unsignedBigInteger('last_updated_by')->nullable()->comment('Foreign Key');
            $table->enum('status', ['active', 'low', 'discontinued'])->default('active');

            $table->index('last_updated_by');
            $table->index('quantity');
            // TODO: Add foreign key constraint for last_updated_by
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('inventory_id');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->decimal('line_total', 10, 2)->default(0.00);
            $table->timestamps();

            // TODO: Add foreign key constraints for sale_id and inventory_id
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->index();
            $table->date('sale_date')->index();
            $table->decimal('subtotal', 12, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 12, 2)->default(0.00);
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            // TODO: Add foreign key constraints for employee_id and customer_id
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->timestamp('scheduled_date')->useCurrent();
            $table->unsignedBigInteger('assigned_employee_id');
            $table->unsignedBigInteger('customer_id');
            $table->enum('status', ['scheduled', 'in-progress', 'completed'])->default('scheduled');
            $table->timestamps();

            // TODO: Add foreign key constraints for assigned_employee_id and customer_id
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number', 20)->unique();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('contact', 20)->nullable();
            $table->integer('loyalty_points')->default(0);
            $table->timestamps();
        });
        
        Schema::create('profit', function (Blueprint $table) {
            $table->id();
            $table->date('period_start_date')->nullable()->index();
            $table->date('period_end_date')->nullable()->index();
            $table->decimal('total_revenue', 14, 2)->nullable();
            $table->decimal('total_expenses', 14, 2)->nullable();
            $table->decimal('net_profit', 14, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('monthly_summary', function (Blueprint $table) {
            $table->id();
            $table->date('month')->nullable()->index();
            $table->decimal('total_sales', 14, 2)->nullable();
            $table->decimal('total_services', 14, 2)->nullable();
            $table->decimal('total_expenses', 14, 2)->nullable();
            $table->integer('customer_count')->nullable();
            $table->unsignedBigInteger('top_employee_id')->nullable();
            $table->timestamps();

            // TODO: Add foreign key constraint for top_employee_id
        });

        Schema::create('employee_performance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable()->index();
            $table->date('period_start_date')->nullable()->index();
            $table->date('period_end_date')->nullable()->index();
            $table->decimal('total_sales', 12, 2)->nullable();
            $table->decimal('total_services', 12, 2)->nullable();
            $table->decimal('performance_rating', 3, 1)->nullable();
            $table->timestamps();

            // TODO: Add foreign key constraint for employee_id
        });

        Schema::create('payment', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('sale_id')->index()->comment('FK');
            $table->unsignedBigInteger('services_id')->index()->comment('FK');
            $table->unsignedBigInteger('customer_id')->index()->comment('FK');
            $table->string('transaction_code', 50)->collation('utf8mb4_unicode_ci');
            $table->dateTime('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('payment_method', ['Cash', 'Credit Card', 'Check', 'Online'])->default('Cash');
            $table->decimal('amount', 10, 2)->unsigned()->default(0.00);
            $table->string('reference_number', 50)->nullable()->collation('utf8mb4_unicode_ci');
            $table->enum('status', ['Completed', 'Pending', 'Failed'])->default('Pending')->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('employee_id')->index()->comment('FK');
        });
        
        
        Schema::create('service_logs', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('service_id')->index()->comment('FK');
            $table->unsignedBigInteger('payment_id')->nullable()->index()->comment('FK');
            $table->dateTime('timestamp')->index();
            $table->string('activity_type', 50)->collation('utf8mb4_unicode_ci');
            $table->text('notes')->nullable()->collation('utf8mb4_unicode_ci');
            $table->text('parts_used')->nullable()->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('employee_id')->index()->comment('FK');
            $table->string('vehicles_details', 100)->nullable()->collation('utf8mb4_unicode_ci');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_performance');
        Schema::dropIfExists('monthly_summary');
        Schema::dropIfExists('profit');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('services');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('auditlog');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('service_logs');
    }
};