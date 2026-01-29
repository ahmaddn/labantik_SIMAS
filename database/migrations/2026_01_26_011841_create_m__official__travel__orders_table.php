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
        Schema::create('m_official_travel_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('headmaster_id')->nullable();
            $table->string('letter_number');
            $table->string('purpose')->nullable();
            $table->string('departure_from')->nullable();
            $table->string('departure_to')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('departure_place')->nullable();
            $table->date('return_date')->nullable();
            $table->string('duration_days')->nullable();
            $table->date('issue_date')->nullable();
            $table->string('budget_resource')->nullable();
            $table->string('code')->nullable();
            $table->string('acc')->nullable();
            $table->uuid('created_by');
            $table->integer('download_count')->default(0);
            $table->timestamps();

            $table->foreign('headmaster_id')->references('id')->on('core_users');
            $table->foreign('created_by')->references('id')->on('core_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_official_travel_orders');
    }
};
