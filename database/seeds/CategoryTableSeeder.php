<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create(['description'=>'Rodamientos','status'=>'disponible']);
        App\Category::create(['description'=>'Retenes','status'=>'disponible']);
    }
}
