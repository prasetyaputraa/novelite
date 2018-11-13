<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Novel::class, function (Faker $faker) {
    $genres = App\Models\Genre::pluck('id')->toArray();

    return [
        'title'       => $faker->words(3, true),
        'description' => $faker->paragraph,
        'author'      => $faker->name,
        'genre_id'    => $faker->randomElement($genres),
        'cover'       => 'cover-novel-default.jpg'
        //
    ];
});
