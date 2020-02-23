<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules_', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schedule_header');
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('attention_place_id');
            $table->unsignedBigInteger('shift_id')->nullable()->default(null);
            $table->date('date');
            $table->boolean('disponible')->default(1);
            $table->timestamp('cancel_date')->nullable()->default(null);
            $table->string('observation')->nullable()->default(null);

            $table->timestamps();

            //relations
            $table->foreign('schedule_header')->references('id')->on('schedule_headers');
            $table->foreign('professional_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('attention_place_id')->references('id')->on('attention_places');
            $table->foreign('shift_id')->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules_');
    }
}
