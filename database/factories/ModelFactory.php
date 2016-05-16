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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Capstone\User\Model\User::class, function(Faker\Generator $faker) {
   return [
       "email" => $faker->email,
       "password" => Hash::make("parola")
   ];
});

$factory->define(App\Capstone\Profile\Model\Profile::class, function(Faker\Generator $faker) {
   return [
       "name" => $faker->name,
       "bio" => $faker->text(500),
       "skills" => $faker->text(250),
       "profile_image" => $faker->imageUrl(),
       "postcode" => $faker->postcode,
       "rate" => $faker->numberBetween(10, 500)
   ];
});

$factory->define(App\Capstone\Postcode\Model\Postcode::class, function(Faker\Generator $faker) {
    return [
        "lat" => $faker->latitude,
        "lon" => $faker->longitude
    ];
});