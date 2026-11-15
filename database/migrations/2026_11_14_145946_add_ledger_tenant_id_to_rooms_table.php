<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('rooms', 'ledger_tenant_id')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->unsignedBigInteger('ledger_tenant_id')
                    ->nullable()
                    ->after('current_occupants');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('rooms', 'ledger_tenant_id')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->dropColumn('ledger_tenant_id');
            });
        }
    }
};
