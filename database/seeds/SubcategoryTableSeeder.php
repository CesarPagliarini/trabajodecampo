<?php

use Illuminate\Database\Seeder;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Subcategory::create(['description'=>'Lineal Bolita','status'=>'disponible','category_id'=>'1']);
        App\Subcategory::create(['description'=>'Lineal Rodillo','status'=>'disponible','category_id'=>'1']);
        App\Subcategory::create(['description'=>'Doble Labio','status'=>'disponible','category_id'=>'2']);
        App\Subcategory::create(['description'=>'Labio Simple','status'=>'disponible','category_id'=>'2']);

    }
}
