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
        Schema::create('m_reason_student_return_letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_return_letters_id');
            $table->text('reason');
            $table->timestamps();

            $table->foreign('cover_letter_id')->references('id')->on('m_cover_letters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_reason_student_return_letters');
    }
};
