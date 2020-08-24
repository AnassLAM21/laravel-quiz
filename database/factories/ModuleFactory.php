<?php
use App\Models\Module;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    
    return [
        'title' => rtrim($faker->sentence(rand(5,10)),"."),
        'body' =>  $faker->paragraph(rand(3,7),true),
        'user_id'  =>  User::pluck('id')->random(),
    ];
});


