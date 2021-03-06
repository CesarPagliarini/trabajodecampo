<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('attention_place_id');
            $table->unsignedBigInteger('time_unit');
            $table->boolean('work_holiday')->default(0)->index();
            $table->boolean('show_amount')->default(0)->index();
            $table->boolean('is_highlighted')->default(0)->index();
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->unsignedDecimal('amount');
            $table->boolean('is_temporal')->default(0);
            $table->enum('state', [1,0])->default(1);

            $table->timestamps();

            //relations

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
        Schema::dropIfExists('professional_configurations');
    }
}
