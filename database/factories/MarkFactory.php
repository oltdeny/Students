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

$factory->define(App\Models\Mark::class, function (Faker $faker) {
    return [
        'mark' => $faker->numberBetween(1, 5),
        'subject_id' => function () {
            return factory(App\Models\Subject::class)->create()->id;
        },
        'student_id' => function () {
            return factory(App\Models\Student::class)->create()->id;
        },
        'group_id' => function (array $post) {
            return App\Models\Student::find($post['student_id'])->group_id;
        }
    ];
});
