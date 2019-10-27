<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Currency::create(['description'=>'Dolar','origin'=>'USA']);
        App\Currency::create(['description'=>'Real','origin'=>'Brasil']);
        App\Currency::create(['description'=>'Peso Argentino','origin'=>'Argentina']);

    }
}
