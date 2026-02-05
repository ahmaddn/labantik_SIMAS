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
        Schema::create('m_detail_cover_letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cover_letter_id');
            $table->string('document_sent');
            $table->integer('qty');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('cover_letter_id')->references('id')->on('m_cover_letters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_detail_cover_letters');
    }
};
