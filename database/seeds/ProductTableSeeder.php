<?php

use App\Entities\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $productos = [];

        for($i = 0; $i <= 5; $i++){
           $prod = [
                'name' => 'producto'.$i,
                'description' => 'Producto de test'.$i,
                'dimension' => '1',
                'unit' => '1',
                'provider' => '1',
                'subcategory_id' => '1',
                'brand_id' => '1',
                'category_id' => '1',
            ];
           array_push($productos, $prod);
        }
        DB::table('products')->insert($productos);










    }
}
