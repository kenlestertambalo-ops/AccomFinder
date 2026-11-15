<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('tenants', 'student_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->unsignedBigInteger('student_id')
                    ->nullable()
                    ->after('owner_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tenants', 'student_id')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->dropColumn('student_id');
            });
        }
    }
};
