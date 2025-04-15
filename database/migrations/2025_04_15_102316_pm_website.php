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
            $table->unsignedBigInteger('role_id')->nullable()->comment('Foreign Key');
            $table->enum('status', ['active', 'on-leave', 'terminated'])->default('active');

            $table->index('role_id');
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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('auditlog');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('roles');
    }
};