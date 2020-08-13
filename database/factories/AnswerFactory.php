<?php

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body'    => rtrim($faker->sentence(rand(5,10)),"."),
        'correct' => rand(0,1),
    ];
});
