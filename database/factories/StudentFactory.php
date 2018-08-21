<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Student::class, function (Faker $faker) {
    $name = $faker->name;
    $fio = explode(' ', $name);
    return [
        'name' => $fio[1],
        'surname' => $fio[0],
        'patronymic' => $fio[2],
        'birth_date' => $faker->date()
    ];
});
