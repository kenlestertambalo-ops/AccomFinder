<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {

            if (!Schema::hasColumn('accommodations', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable();
            }

            if (!Schema::hasColumn('accommodations', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable();
            }

        });
    }

    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {

            if (Schema::hasColumn('accommodations', 'latitude')) {
                $table->dropColumn('latitude');
            }

            if (Schema::hasColumn('accommodations', 'longitude')) {
                $table->dropColumn('longitude');
            }

        });
    }
};
