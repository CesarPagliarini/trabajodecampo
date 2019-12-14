<?php

use App\Entities\Price;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            'value' => '25',
            'currency_id' => '1',
            'state' => '1',
            'product_id' => '1'
        ]);
        DB::table('prices')->insert([
            'value' => '25',
            'currency_id' => '1',
            'state' => '1',
            'product_id' => '2'
        ]);
    }
}
