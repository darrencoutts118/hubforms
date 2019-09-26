<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Field;
use App\Models\Form;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'type'    => 'text',
        'name'    => str_replace(' ', '_', $faker->words(3, true)),
        'title'   => ucwords($faker->words(3, true)),
        'rules'   => 'min:1',
    ];
});
