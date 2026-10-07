<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_properties', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->unsignedBigInteger('accommodation_id');

            $table->timestamps();

            // Prevent the same student from saving
            // the same accommodation more than once.
            $table->unique([
                'student_id',
                'accommodation_id'
            ]);

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('accommodation_id')
                ->references('id')
                ->on('accommodations')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_properties');
    }
};
