<?php

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'document' => $faker->text(),
        'user_id' => $faker->unique()->randomNumber($nbDigits = 2),
        'admin_id' => $faker->unique()->randomNumber($nbDigits = 2)
    ];
});
 