<?php

use Faker\Generator as Faker;

$factory->define(App\Module::class, function (Faker $faker) {
    
    return [
        'title' => rtrim($faker->sentence(rand(5,10)),"."),
        'body' =>  $faker->paragraph(rand(3,7),true),
        'user_id'  =>  App\User::pluck('id')->random(),
    ];
});


