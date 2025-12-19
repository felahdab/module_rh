<?php

namespace Modules\RH\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specialite>
 */
class SpecialiteFactory extends Factory
{
    protected $model = \Modules\RH\Models\Specialite::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'libelle_court' =>$this->faker->text(5),
            'libelle_long' =>$this->faker->name(),
	        'ordre' => 1,
        ];
    }
}
