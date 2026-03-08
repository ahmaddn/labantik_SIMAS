<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('m_travel_cost_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->enum('type', ['accommodation', 'transport'])->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        Schema::create('m_travel_daily_allowances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_order_id')->nullable();
            $table->string('employee_name')->nullable();
            $table->decimal('amount_per_day', 15, 2)->nullable();
            $table->integer('days')->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('travel_order_id')
                ->references('id')
                ->on('m_official_travel_orders')
                ->onDelete('cascade');
        });

        Schema::create('m_travel_pocket_moneys', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_order_id')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('travel_order_id')
                ->references('id')
                ->on('m_official_travel_orders')
                ->onDelete('cascade');
        });

        Schema::create('m_travel_accommodations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_order_id')->nullable();
            $table->uuid('category_id')->nullable();
            $table->string('hotel_name')->nullable();
            $table->decimal('price_per_night', 15, 2)->nullable();
            $table->integer('duration_nights')->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('travel_order_id')
                ->references('id')
                ->on('m_official_travel_orders')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('m_travel_cost_categories')
                ->onDelete('restrict');
        });

        Schema::create('m_travel_transports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_order_id')->nullable();
            $table->uuid('category_id')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('airline_name')->nullable();
            $table->string('booking_code')->nullable();
            $table->string('ticket_number')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('travel_order_id')
                ->references('id')
                ->on('m_official_travel_orders')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('m_travel_cost_categories')
                ->onDelete('restrict');
        });

        Schema::create('m_travel_representative_allowances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_order_id')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('travel_order_id')
                ->references('id')
                ->on('m_official_travel_orders')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_travel_representative_allowances');
        Schema::dropIfExists('m_travel_transports');
        Schema::dropIfExists('m_travel_accommodations');
        Schema::dropIfExists('m_travel_pocket_moneys');
        Schema::dropIfExists('m_travel_daily_allowances');
        Schema::dropIfExists('m_travel_cost_categories');
    }
};
