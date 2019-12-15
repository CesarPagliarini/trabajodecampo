<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStockMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('origin')->default(1);
            $table->unsignedBigInteger('quantity_before');
            $table->unsignedBigInteger('quantity_after');
            $table->unsignedBigInteger('order_identifier');

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_identifier')->references('identifier')->on('sales_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stock_movements');
    }
}
