<?php

use App\Module;
use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {

    $moduleIds = App\Module::pluck('id');
    $moduleCount = App\Module::all()->count();

    return [

        'publish' => rand(0,1),
        'published_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d H:i:s')        ,
        'time' => date('H:i:s', rand(500,1000)),
        'views_count' => rand(0,1000),
        'votes_count' => rand(-1000,1000),
        'module_id' => $moduleCount > 0 ? $moduleIds->random() : null,
        'user_id' => App\User::pluck('id')->random(),
    ];
});
