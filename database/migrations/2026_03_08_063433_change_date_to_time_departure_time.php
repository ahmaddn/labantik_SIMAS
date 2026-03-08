<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('m_official_travel_orders', function (Blueprint $table) {
            $table->time('departure_time')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('m_official_travel_orders', function (Blueprint $table) {
            $table->date('departure_time')->nullable()->change();
        });
    }
};
