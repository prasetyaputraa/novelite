<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Chapter::class, function (Faker $faker) {
    $novels = App\Models\Novel::pluck('id')->toArray();

    return [
        'title'    => $faker->words(5, true),
        'novel_id' => $faker->randomElement($novels),
        'url'      => 'chapter-default-doument.pdf'
    ];
});
