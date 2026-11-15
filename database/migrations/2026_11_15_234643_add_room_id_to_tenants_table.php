
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('tenants', 'room_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->unsignedBigInteger('room_id')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tenants', 'room_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->dropColumn('room_id');
            });
        }
    }
};
