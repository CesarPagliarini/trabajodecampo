<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('state', [1,0])->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');


            //client essencial data
            $table->string('last_name')->nullable()->default(NULL);
            $table->string('address')->nullable()->default(NULL);
            $table->string('cel_phone')->nullable()->default(NULL);
            $table->string('city')->nullable()->default(NULL);
            $table->string('region')->nullable()->default(NULL);
            $table->string('zip_code')->nullable()->default(NULL);
            $table->string('country')->nullable()->default(NULL);
            $table->date('date_of_birthday')->nullable()->default(NULL);

            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
