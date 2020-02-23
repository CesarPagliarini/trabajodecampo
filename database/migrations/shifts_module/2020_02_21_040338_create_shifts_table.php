<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('attention_place_id');
            $table->unsignedBigInteger('currency_id')->default(1);

            $table->time('from');
            $table->time('to');
            $table->boolean('asisted')->default(0);
            $table->timestamp('cancel_date')->nullable()->default(null);
            $table->string('observation')->nullable()->default(null);



            $table->timestamps();

            //relations
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('professional_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('attention_place_id')->references('id')->on('attention_places');
            $table->foreign('currency_id')->references('id')->on('currencies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
