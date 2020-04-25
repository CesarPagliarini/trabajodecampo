<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('specialty_id');
            $table->string('enrollment_type')->nullable()->default(null);
            $table->string('enrollment')->nullable()->default(null);

            //relationships
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_specialties');
    }
}
