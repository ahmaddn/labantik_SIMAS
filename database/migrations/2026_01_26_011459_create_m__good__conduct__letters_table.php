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
        Schema::create('m_good_conduct_letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('headmaster_id');
            $table->uuid('student_id');
            $table->string('letter_number');
            $table->string('content');
            $table->date('issue_date');
            $table->uuid('created_by');
            $table->timestamps();

            $table->foreign('headmaster_id')->references('id')->on('core_users');
            $table->foreign('student_id')->references('id')->on('ref_student_academic_years');
            $table->foreign('student_by')->references('id')->on('core_users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_good_conduct_letters');
    }
};
