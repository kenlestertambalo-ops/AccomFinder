<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();

            // Owner comes from the users table
            $table->foreignId('owner_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Student comes from the students table
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnDelete();

            // Temporary until we create accommodations
            $table->unsignedBigInteger('accommodation_id');

            $table->decimal('rent', 10, 2);

            $table->enum('status', ['Active', 'Inactive'])
                  ->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
