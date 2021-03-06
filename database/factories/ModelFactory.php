<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'email'      => $faker->unique()->safeEmail,
        'telephone'  => $faker->e164PhoneNumber,
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        'message'    => $faker->text,
        'channel_id' => function () {
            return App\Channel::inRandomOrder()->get()->first()->id;
        },
        'user_id' => function () {
            return App\User::where('id', '>', '10')->get()->random();
        },
    ];
});
