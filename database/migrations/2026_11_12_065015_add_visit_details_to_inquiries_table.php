<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('inquiries', 'room_id')) {
            Schema::table('inquiries', function (Blueprint $table) {
                $table->foreignId('room_id')
                    ->nullable()
                    ->constrained('rooms')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('inquiries', 'room_id')) {
            Schema::table('inquiries', function (Blueprint $table) {
                $table->dropConstrainedForeignId('room_id');
            });
        }
    }
};
