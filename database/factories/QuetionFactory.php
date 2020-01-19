<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Quetion;
use Faker\Generator as Faker;
use App\User;
Use App\Models\Category;

$factory->define(Quetion::class, function (Faker $faker) {
    return [
        //
        'title'=> $faker->sentence,
        'slug'=>str_slug($faker->sentence),
        'body'=> $faker->text,
        'category_id'=> function () {
            return Category::all()->random();
        },
        'user_id'=> function () {
            return User::all()->random();
        }
    ];
});
