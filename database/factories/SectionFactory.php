<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Section::class, function (Faker $faker) {
    $paths = glob('storage/app/logo/*.{jpg,jpeg,gif,png}', GLOB_BRACE);
    $fileIdx = rand(0, count($paths) - 1);
    return [
        'name' => $faker->company,
        'description' => $faker->catchPhrase,
        'logo' => basename($paths[ $fileIdx ]),
    ];
});
