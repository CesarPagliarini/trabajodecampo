<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttentionCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attention_places')->insert([
            'name' => 'centro uno',
            'description'=> 'a',
            'address'=> 'a',
            'number'=>'2',
            'phone'=> 'a',
            'floor'=>'a',
            'apartment'=>'a',
            'province'=> 'a',
            'city'=> 'a',
            'country'=> 'a',
            'state'=> '1',
        ]);

        DB::table('attention_places')->insert([
            'name' => 'centro dos',
            'description'=> 'a',
            'address'=> 'a',
            'number'=>'2',
            'phone'=> 'a',
            'floor'=>'a',
            'apartment'=>'a',
            'province'=> 'a',
            'city'=> 'a',
            'country'=> 'a',
            'state'=> '1',
        ]);
    }
}
