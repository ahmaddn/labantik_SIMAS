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
        // migration baru: add_treasurer_id_to_m_official_travel_orders
        Schema::table('m_official_travel_orders', function (Blueprint $table) {
            $table->uuid('treasurer_id')->nullable()->after('headmaster_id');
            $table->foreign('treasurer_id')->references('id')->on('core_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_official_travel_orders', function (Blueprint $table) {
            //
        });
    }
};
