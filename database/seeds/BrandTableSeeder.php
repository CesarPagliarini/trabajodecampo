<?php

use App\Entities\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Johnsons',
            'description' => 'Productos varios',
            'origin' => 'Usa',
            'state' => '1'
        ]);
        DB::table('brands')->insert([
            'name' => 'P&G',
            'description' => 'Productos varios',
            'origin' => 'Usa',
            'state' => '1'
        ]);
        DB::table('brands')->insert([
            'name' => 'Capilatis',
            'description' => 'Productos varios',
            'origin' => 'Usa',
            'state' => '1'
        ]);
        DB::table('brands')->insert([
            'name' => '919',
            'description' => 'Productos varios peluquerias',
            'origin' => 'Brasil',
            'state' => '1'
        ]);
        DB::table('brands')->insert([
            'name' => 'P&G',
            'description' => 'Productos odontologicos',
            'origin' => 'Brasil',
            'state' => '1'
        ]);
        DB::table('brands')->insert([
            'name' => 'P&G',
            'description' => 'Productos de tocador',
            'origin' => 'Argentina',
            'state' => '1'
        ]);

    }
}
