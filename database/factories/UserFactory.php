<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Data\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'uuid' => Str::uuid(),
        'name' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => Carbon::now(),
        'is_active' => true,
        'is_blocked' => false,
        'password' => 'secret',
    ];
});
