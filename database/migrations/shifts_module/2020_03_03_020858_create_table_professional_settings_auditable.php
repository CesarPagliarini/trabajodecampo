<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfessionalSettingsAuditable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_professional_settings_auditable', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('attention_place_id');
            $table->unsignedBigInteger('time_unit');
            $table->boolean('work_holiday');
            $table->boolean('show_amount');
            $table->boolean('is_highlighted');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedDecimal('amount');
            $table->boolean('is_temporal');
            $table->string('user_auditable');
            $table->dateTime('created_at');
            $table->string('state');
            $table->string('movement_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_professional_settings_auditable');
    }
}
