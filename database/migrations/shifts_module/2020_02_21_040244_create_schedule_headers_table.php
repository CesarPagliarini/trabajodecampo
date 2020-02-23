<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('attention_place_id');
            $table->date('from');
            $table->date('to');
            $table->string('days');
            $table->string('morning_schedule');
            $table->string('afternoon_schedule');
            $table->string('run_schedule');


            $table->timestamps();

            //relations

            $table->foreign('professional_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('attention_place_id')->references('id')->on('attention_places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_headers');
    }
}
