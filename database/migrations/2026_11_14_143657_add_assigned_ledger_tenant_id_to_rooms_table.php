<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('rooms', 'assigned_ledger_tenant_id')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->foreignId('assigned_ledger_tenant_id')
                    ->nullable()
                    ->after('accommodation_id')
                    ->constrained('tenants')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('rooms', 'assigned_ledger_tenant_id')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->dropForeign(['assigned_ledger_tenant_id']);
                $table->dropColumn('assigned_ledger_tenant_id');
            });
        }
    }
};
