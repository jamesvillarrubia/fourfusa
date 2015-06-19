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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'username'=> $faker->userName,
        'email' => $faker->email,
        'password' => $faker->password,
        'remember_token' => str_random(10)
    ];
});


$factory->define(App\Task::class, function ($faker) {
    return [
        'title' => $faker->sentence(6),
        'isDone' => $faker->numberBetween(0,1),
        'user_id' => $faker->numberBetween(1, 10),
        'content' => $faker->paragraph(4),
        'date_string'=> 'after the 1st of July',
        'date_lang' => 'en',
        'due_date_utc' => $faker->iso8601('now'),
        'start_date_utc' => $faker->iso8601('now'),
        'collapsed' => $faker->numberBetween(0,1),
        'indent' => $faker->numberBetween(0,10),
        'priority' => $faker->numberBetween(0,10),
 		'item_order' => $faker->numberBetween(0,30),
 		'children' =>  serialize([1,2,4,5]),
 		'assigned_by_uid' => $faker->numberBetween(4,10),
		'responsible_uid' => $faker->numberBetween(0,3),
    ];
});

$factory->define(App\Label::class, function ($faker) {
    return [
        'name' => $faker->sentence(rand(3,4))
    ];
});
