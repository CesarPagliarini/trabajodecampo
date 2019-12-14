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

        DB::table('products')->insert([
            'name' => 'Shampoo anti caspa',
            'description' => 'El mejor shampoo anticaspa recomendado por los mejores dermatologos',
            'dimension' => '1',
            'unit' => '1',
            'provider' => 'Kellerhoff',
            'subcategory_id' => '1',
            'brand_id' => '1',
            'category_id' => '1',
        ]);
        DB::table('products')->insert([
            'name' => 'Acondicionador rulos rebeldes',
            'description' => 'Con este super acondicionador decile chau a los rulos rebeldes',
            'dimension' => '1',
            'unit' => '1',
            'provider' => 'Kellerhoff',
            'subcategory_id' => '1',
            'brand_id' => '1',
            'category_id' => '1',
        ]);










    }
}
