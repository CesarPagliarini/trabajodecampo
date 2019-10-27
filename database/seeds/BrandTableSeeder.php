<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        App\Brand::create(['description'=>'SKF','origin'=>'SUECIA']);
        App\Brand::create(['description'=>'ZKL','origin'=>'REPUBLICA CHECA']);
        App\Brand::create(['description'=>'DBH','origin'=>'ARGENTINA']);
    }
}
