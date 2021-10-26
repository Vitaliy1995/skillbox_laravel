<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->word,
        'name' => $faker->words(3, true),
        'annotation' => $faker->sentence,
        'description' => $faker->sentences(6, true),
        'published' => true,
        'owner_id' => factory(\App\User::class)
    ];
});
