<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('identifier')->unique();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('shipping_way')->default(1);
            $table->unsignedBigInteger('sub_total');
            $table->unsignedBigInteger('client_id');
            $table->string('observation')->nullable();


            $table->timestamps();

            //relations

            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('state_id')->references('id')->on('sales_order_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order');
    }
}
