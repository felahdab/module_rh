<?php

namespace Modules\RH\Database\Factories;

use Modules\RH\Models\Mpe;
use Illuminate\Database\Eloquent\Factories\Factory;


use Modules\RH\Models\Marin;
use Modules\RH\Models\Unite;

/**
 * @extends Factory<\App\Models\Diplome>
 */
class MpeFactory extends Factory
{
    protected $model = Mpe::class;

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
