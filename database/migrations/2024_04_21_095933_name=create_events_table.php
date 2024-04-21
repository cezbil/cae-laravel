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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('revision')->nullable();
            $table->string('duty_code')->nullable();
            $table->dateTime('check_in_local')->nullable();
            $table->dateTime('check_in_utc')->nullable();
            $table->dateTime('check_out_local')->nullable();
            $table->dateTime('check_out_utc')->nullable();
            $table->string('activity')->nullable();
            $table->string('remark')->nullable();
            $table->string('from_station')->nullable();
            $table->dateTime('scheduled_time_departure_local')->nullable();
            $table->dateTime('scheduled_time_departure_utc')->nullable();
            $table->string('to_station')->nullable();
            $table->dateTime('scheduled_time_arrival_local')->nullable();
            $table->dateTime('scheduled_time_arrival_utc')->nullable();
            $table->string('aircraft_or_hotel')->nullable();
            $table->string('block_hours')->nullable();
            $table->string('flight_time')->nullable();
            $table->string('night_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('extras')->nullable();
            $table->string('passengers_booked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
