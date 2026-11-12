
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('payments', 'billing_month')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->date('billing_month')->nullable()->after('tenant_id');
            });
        }

        // Give existing payment records an initial billing month
        // based on their payment date.
        DB::statement("
            UPDATE payments
            SET billing_month = DATE_FORMAT(payment_date, '%Y-%m-01')
            WHERE billing_month IS NULL
            AND payment_date IS NOT NULL
        ");
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
