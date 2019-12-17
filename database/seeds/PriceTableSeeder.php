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

        $prices = [];
        for($i = 1; $i <= 6; $i++){
            $price = [
                'value' => ($i%2===0) ? $i+98 : $i+99,
                'currency_id' => '1',
                'product_id' => $i,
                'vigency_to' => Carbon::now()->addDays(25),
                'vigency_from' => Carbon::now()
            ];
            array_push($prices,$price);
        }
        DB::table('prices')->insert($prices);
    }
}
