<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('payments', 'billing_month')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->date('billing_month')->nullable()->after('tenant_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('payments', 'billing_month')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropColumn('billing_month');
            });
        }
    }
};
