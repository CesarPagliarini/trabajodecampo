<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Role;
use Faker\Generator as Faker;


$factory->define(Role::class, function (Faker $faker) {
    $names = [
        'Administrador',
        'Gestor de usuarios',
        'Gestor de ventas',
        'Super administrador'
    ];
    return [
        'name'=>$faker->unique()->randomElement($names),
    ];
});
