<?php

namespace Modules\RH\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use Modules\RH\Models\Marin;
use Modules\RH\Models\Unite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diplome>
 */
class MpeFactory extends Factory
{
    protected $model = \Modules\RH\Models\Mpe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_debut'    =>  $this->faker->date('Y-m-d'),
            'date_fin'      =>  $this->faker->date('Y-m-d'),
            'unite_id'      =>  Unite::inRandomOrder()->first()->id,
            'marin_id'      =>  Marin::inRandomOrder()->first()->id,
            
            'uuid'          =>  $this->faker->uuid,
        ];
    }
}
