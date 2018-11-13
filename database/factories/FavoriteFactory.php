<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Favorite::class, function (Faker $faker) {
    $novels = App\Models\Novel::pluck('id')->toArray();
    $users  = App\Models\User::pluck('id')->toArray();

    return [
        'novel_id' => $faker->randomElement($novels),
        'user_id'  => $faker->randomElement($users)
    ];
});
