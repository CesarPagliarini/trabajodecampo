<?php

use App\Entities\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Categoria 1',
            'description' => 'Categoria de test 1',
            'state' => '1'
        ]);

        DB::table('categories')->insert([
            'name' => 'Categoria 2',
            'description' => 'Categoria de test 2',
            'state' => '1'
        ]);

    }
}
