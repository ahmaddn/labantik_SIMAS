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
        Schema::table('m_official_travel_orders', function (Blueprint $table) {
            $table->uuid('recipient_employee_id')->nullable()->after('treasurer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_official_travel_orders', function (Blueprint $table) {
            $table->dropColumn('recipient_employee_id');
        });
    }
};
