<?php

use App\Entities\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'name' => 'AR$',
            'description' => 'Pesos argentinos',
            'origin' => '1',
            'state' => '1'
        ]);

    }
}
