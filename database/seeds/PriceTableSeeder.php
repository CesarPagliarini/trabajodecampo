<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        App\Price::create(['value'=>'6','currency_id'=>'1','product_id'=>'1']);
        App\Price::create(['value'=>'200','currency_id'=>'3','product_id'=>'2']);
    }
}
