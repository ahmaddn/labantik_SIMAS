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
        Schema::create('m_travel_order_followers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_order_id')->nullable();
            $table->uuid('follower_id')->nullable();
            $table->timestamps();

            $table->foreign('travel_order_id')->references('id')->on('official_travel_orders');
            $table->foreign('follower_id')->references('id')->on('core_employees');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_travel_order_followers');
    }
};
