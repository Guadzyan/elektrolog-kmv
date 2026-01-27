<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('utm_source', 128)->nullable()->index();
            $table->string('utm_medium', 128)->nullable()->index();
            $table->string('utm_campaign', 128)->nullable()->index();
            $table->string('utm_content', 128)->nullable();
            $table->string('utm_term', 128)->nullable();
            $table->string('landing_url', 512)->nullable();
            $table->string('referrer', 512)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_content',
                'utm_term',
                'landing_url',
                'referrer',
            ]);
        });
    }
};
