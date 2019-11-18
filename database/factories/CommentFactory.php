<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->sentences(3, true),
        'user_id' => mt_rand(1,3),
        'created_at' => $faker->dateTimeBetween('-1 years', '+1 years'),
        'updated_at' => $faker->dateTimeBetween('+0 days', '+2 years')
    ];
});
