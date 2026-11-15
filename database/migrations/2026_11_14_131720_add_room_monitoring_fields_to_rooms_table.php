<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedInteger('current_occupants')
                ->default(0)
                ->after('capacity');

            $table->string('bathroom_type')
                ->default('Shared')
                ->after('bathrooms');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn([
                'current_occupants',
                'bathroom_type',
            ]);
        });
    }
};
