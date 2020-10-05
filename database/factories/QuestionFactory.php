<?php

use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(2,5)),"."),
        'body' =>  rtrim($faker->sentence(rand(2,5)),"."),
    ];
});
