<?php

use App\Career;
use App\User;
use App\Role;
use Faker\Generator as Faker;
use Faker\Factory as Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

	$faker = Factory::create('es_ES');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'role_id' => Role::where('name', 'professor')->first()->id,
    ];
});

$factory->define(App\Student::class, function (Faker $faker) {

	$faker = Factory::create('es_ES');

	return [
		'control_number' => $faker->numberBetween(14000000, 20000000),
		'career_id' => Career::inRandomOrder()->get()[0]->id,
		'first_names' => $faker->firstName,
		'last_names' => $faker->lastName.' '.$faker->lastName,
		'phone_number' => $faker->ean8,
		'email' => $faker->email
	];

});

$factory->define(App\Group::class, function (Faker $faker) {

	$faker = Factory::create('es_ES');
	$professorRoleId = Role::where('name', 'professor')->first()->id;

	$daysCombinations = [123, 135, 6, 246, 12345];
	$daysCombinationKey = array_rand($daysCombinations);

	return [
		'level' => $faker->numberBetween(1, 5),
		'schedule_start' => $faker->time('H:i', 'now'),
		'schedule_end' => $faker->time('H:i', 'now'),
		'days' => $daysCombinations[$daysCombinationKey],
		'code' => $faker->numberBetween(1000, 9999),
		'name' => $faker->numberBetween(1000, 9999),
		'user_id' => User::where('role_id', $professorRoleId)->inRandomOrder()->first()->id,
	];

});