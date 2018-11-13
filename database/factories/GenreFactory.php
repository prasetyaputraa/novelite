<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(
            [
                'Action',
                'Adventure',
                'Mistery',
                'Sci-Fi',
                'Drama',
                'Horror',
                'Fantasy',
                'History',
                'Adult',
                'Political'
            ]
        ),
        'icon' => 'icon-genre-default.png'

    ];
});
