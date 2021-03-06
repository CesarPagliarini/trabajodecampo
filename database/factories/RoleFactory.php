<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Role;
use Faker\Generator as Faker;


$factory->define(Role::class, function (Faker $faker) {
    $names = [
        'Administrador',
        'Cliente',
        'Profesional'
    ];
    return [
        'name'=>$faker->unique()->randomElement($names),
        'description'=>$faker->sentence(3),
    ];
});
