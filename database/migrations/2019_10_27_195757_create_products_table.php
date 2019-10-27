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
            $table->string('description');
            $table->string('dimension');
            $table->string('unit');
            $table->string('status');
            $table->string('provider'); 
            $table->bigInteger('subcategory_id')->nullable()->foreign()->references('id')->on('subcategories');
            $table->bigInteger('brand_id')->foreign()->references('id')->on('brands');
            $table->bigInteger('category_id')->foreign()->references('id')->on('categories'); 
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
        Schema::dropIfExists('products');
    }
}
