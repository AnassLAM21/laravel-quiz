<?php

use App\Choice;
use Faker\Generator as Faker;

$factory->define(Choice::class, function (Faker $faker) {
    return [
        'body'    => rtrim($faker->sentence(rand(5,10)),"."),
        'is_right_choice' => rand(0,1),
    ];
});
