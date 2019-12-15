<?php

use App\Entities\Price;
use Carbon\Carbon;
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
            'product_id' => '1',
            'vigency_to' => Carbon::now()->addDays(25),
            'vigency_from' => Carbon::now()
        ]);
        DB::table('prices')->insert([
            'value' => '25',
            'currency_id' => '1',
            'product_id' => '2',
            'vigency_to' => Carbon::now()->addDays(25),
            'vigency_from' => Carbon::now()
        ]);
    }
}
