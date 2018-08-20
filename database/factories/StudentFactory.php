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
    return [
        'group_id' => function () {
            return factory(App\Models\Group::class)->create()->id;
        },
        'name' => $faker->name,
        'surname' => $faker->name,
        'patronymic' => $faker->name,
        'birth_date' => $faker->date()
    ];
});
