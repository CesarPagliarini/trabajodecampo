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
            $table->boolean('monday')->default(0)->index();
            $table->boolean('tuesday')->default(0)->index();
            $table->boolean('wednesday')->default(0)->index();
            $table->boolean('thursday')->default(0)->index();
            $table->boolean('friday')->default(0)->index();
            $table->boolean('saturday')->default(0)->index();
            $table->boolean('sunday')->default(0)->index();
            $table->string('morning_schedule')->nullable()->default(null);
            $table->string('afternoon_schedule')->nullable()->default(null);
            $table->string('run_schedule')->nullable()->default(null);


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
