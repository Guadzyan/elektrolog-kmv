<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->index('client_id');

            $table->dateTime('starts_at')->index();
            $table->unsignedSmallInteger('duration_minutes')->default(60);

            $table->string('status', 32)->default('pending')->index();
            $table->string('source', 32)->default('web')->index();

            $table->string('needle_type', 16)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['starts_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
