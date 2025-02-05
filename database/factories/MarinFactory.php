<?php

namespace Modules\RH\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diplome>
 */
class MarinFactory extends Factory
{
    protected $model = \Modules\RH\Models\Marin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' =>$this->faker->text(5),
            'prenom' =>$this->faker->text(5),
            'grade_id' => null,
            'specialite_id' => null,
            'brevet_id' => null,
            'unite_id' => null,
            'nid' => $this->faker->randomNumber(6, true),
        ];
    }
}
