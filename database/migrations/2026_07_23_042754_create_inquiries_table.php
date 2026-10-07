<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('inquiries', function (Blueprint $table) {
        $table->id();

        $table->foreignId('owner_id');
        $table->foreignId('tenant_id')->nullable();

        $table->text('message');

        $table->string('status')
              ->default('Unread');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
