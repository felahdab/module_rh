<?php

namespace Modules\RH\Database\Factories;

use Modules\RH\Models\Marin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\RH\Models\Grade;
use Modules\RH\Models\Brevet;
use Modules\RH\Models\Specialite;
use Modules\RH\Models\Unite;

/**
 * @extends Factory<\App\Models\Diplome>
 */
class MarinFactory extends Factory
{
    protected $model = Marin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nom = $this->faker->lastName();
        $prenom = $this->faker->firstName();
        $email = $this->faker->email();
        return [
            'nom'           =>  $nom,
            'prenom'        =>  $prenom,
            'email'         =>  $email,
            // 'grade_id'      =>  Grade::factory(),
            'grade_id'      =>  Grade::inRandomOrder()->first()?->id,
            'specialite_id' =>  Specialite::inRandomOrder()->first()?->id,
            'brevet_id'     =>  Brevet::inRandomOrder()->first()?->id,
            //'unite_id'      =>  Unite::inRandomOrder()->first()?->id,
            //'nid' => $this->faker->randomNumber(6, true),
            'nid'           =>  $this->faker->unique()->numerify('nid-#####'),
            'uuid'          =>  $this->faker->uuid,
        ];
    }
}
