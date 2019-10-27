<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create(['description'=>'6204 2RS','dimension'=>'20x47x14','unit'=>'milimeter','status'=>'disponible','provider'=>'Giovagnoli','brand_id'=>'1','category_id'=>'1','subcategory_id'=>'1']);
        App\Product::create(['description'=>'5200','dimension'=>'60x80x10','unit'=>'milimeter','status'=>'disponible','provider'=>'Retenes DBH','brand_id'=>'2','category_id'=>'3','subcategory_id'=>'3']);

    }
}
