<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;
use App\Models\Quetion;
use App\User;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body'=> $faker->text,
        'quetion_id'=> function() {
            return Quetion::all()->random();
        },
        'user_id'=> function() {
            return User::all()->random();
        }
    ];
});
