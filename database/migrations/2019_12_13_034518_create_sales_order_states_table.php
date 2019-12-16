<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('sales_order_states')->insert([
            'name' => 'PENDIENTE',
            'description' => 'PENDIENTE'
        ]);
        DB::table('sales_order_states')->insert([
            'name' => 'RECHAZADA',
            'description' => 'RECHAZADA'
        ]);
        DB::table('sales_order_states')->insert([
            'name' => 'ACEPTADA',
            'description' => 'ACEPTADA'
        ]);
        DB::table('sales_order_states')->insert([
            'name' => 'EN PREPARACION',
            'description' => 'EN PREPARACION'
        ]);
        DB::table('sales_order_states')->insert([
            'name' => 'ENTREGADA ',
            'description' => 'ENTREGADA'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order_states');
    }
}
