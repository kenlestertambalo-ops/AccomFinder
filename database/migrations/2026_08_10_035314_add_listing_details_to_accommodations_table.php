<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accommodations', function (Blueprint $table) {

            if (!Schema::hasColumn('accommodations', 'type')) {
                $table->string('type')->nullable()->after('price');
            }

            if (!Schema::hasColumn('accommodations', 'bedrooms')) {
                $table->integer('bedrooms')->default(0)->after('type');
            }

            if (!Schema::hasColumn('accommodations', 'bathrooms')) {
                $table->integer('bathrooms')->default(0)->after('bedrooms');
            }

            if (!Schema::hasColumn('accommodations', 'size')) {
                $table->decimal('size', 10, 2)->nullable()->after('bathrooms');
            }

            if (!Schema::hasColumn('accommodations', 'amenities')) {
                $table->text('amenities')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('accommodations', function (Blueprint $table) {

            $columns = [
                'type',
                'bedrooms',
                'bathrooms',
                'size',
                'amenities',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('accommodations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
