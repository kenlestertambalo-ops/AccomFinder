
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add accommodation_id first.
        if (!Schema::hasColumn('tenants', 'accommodation_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->foreignId('accommodation_id')
                    ->nullable()
                    ->constrained('accommodations')
                    ->nullOnDelete();
            });
        }

        // Add room_id after accommodation_id.
        if (!Schema::hasColumn('tenants', 'room_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->foreignId('room_id')
                    ->nullable()
                    ->constrained('rooms')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tenants', 'room_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->dropConstrainedForeignId('room_id');
            });
        }

        if (Schema::hasColumn('tenants', 'accommodation_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->dropConstrainedForeignId('accommodation_id');
            });
        }
    }
};
