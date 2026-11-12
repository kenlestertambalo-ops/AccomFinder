<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('tenants', 'due_day')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->unsignedTinyInteger('due_day')
                    ->default(5)
                    ->after('monthly_rent');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tenants', 'due_day')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->dropColumn('due_day');
            });
        }
    }
};
