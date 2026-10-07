<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {

            if (!Schema::hasColumn('tenants', 'owner_id')) {
                $table->unsignedBigInteger('owner_id')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'accommodation_id')) {
                $table->unsignedBigInteger('accommodation_id')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'name')) {
                $table->string('name')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'start_date')) {
                $table->date('start_date')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'end_date')) {
                $table->date('end_date')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'monthly_rent')) {
                $table->decimal('monthly_rent', 10, 2)->nullable();
            }

            if (!Schema::hasColumn('tenants', 'status')) {
                $table->string('status')->default('Active');
            }

        });
    }

    public function down(): void
    {
        //
    }
};
