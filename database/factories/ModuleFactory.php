<?php
use App\Models\Module;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    
    return [
        'title' => rtrim($faker->sentence(rand(1,3)),"."),
        'body' =>  $faker->paragraph(rand(1,3),true),
        'user_id'  =>  User::pluck('id')->random(),
    ];
});


