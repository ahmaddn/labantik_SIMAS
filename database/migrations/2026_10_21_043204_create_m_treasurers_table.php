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
        Schema::create('m_treasurers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('employee_id')->nullable();
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('position')->default('Bendahara');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('core_employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_treasurers');
    }
};
