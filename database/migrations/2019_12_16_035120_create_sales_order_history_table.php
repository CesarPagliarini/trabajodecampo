<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_identifier');
            $table->unsignedBigInteger('state_id');
            $table->timestamp('changed_date');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            //relationships
            $this->foreign('user_id')->references('id')->on('users');
            $this->foreign('state_id')->references('id')->on('sales_order_states');
            $this->foreign('order_identifier')->references('identifier')->on('sales_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_state_history');
    }
}
