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
            $table->unsignedBigInteger('admin_id');
            $table->string('observation');


            $table->timestamps();

            //relations
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('state_id')->references('state')->on('order_states');
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
