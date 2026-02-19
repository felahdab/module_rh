<?php

namespace Modules\RH\Database\Factories;

use Modules\RH\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends Factory<\App\Models\Specialite>
 */
class SpecialiteFactory extends Factory
{
    protected $model = Specialite::class;
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
