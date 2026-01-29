<?php

namespace Modules\RH\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\RH\Models\Unite;
use Illuminate\Support\Str;


class UniteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Unite::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        return [
            'libelle_court' => Str::limit($name, 10), 
		    'libelle_long' => $name, 
        ];
    }
}