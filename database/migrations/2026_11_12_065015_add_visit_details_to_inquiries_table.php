<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {

            $table->unsignedBigInteger('room_id')->nullable();

            $table->string('inquiry_type')
                ->default('General');

            $table->date('visit_date')->nullable();

            $table->time('visit_time')->nullable();

            $table->string('visit_status')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {

            $table->dropColumn([
                'room_id',
                'inquiry_type',
                'visit_date',
                'visit_time',
                'visit_status',
            ]);

        });
    }
};
