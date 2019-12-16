<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('dimension')->nullable()->default(null);
            $table->string('unit')->nullable()->default(null);
            $table->string('provider')->nullable()->default(null);
            $table->enum('state', [1,0])->default(1);
            $table->unsignedBigInteger('stock')->default(0);
            $table->unsignedBigInteger('subcategory_id')->nullable()->default(null);
            $table->unsignedBigInteger('brand_id')->nullable()->default(null);
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            //relationships
            $table->foreign('subcategory_id')->references('id')->on('subcategories');

            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
