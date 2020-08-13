<?php

use App\Module;
use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {

    $moduleIds = App\Module::pluck('id');
    $moduleCount = App\Module::all()->count();

    return [
        'module_id' => $moduleCount > 0 ? $moduleIds->random() : null,
        'user_id' => App\User::pluck('id')->random(),
    ];
});
