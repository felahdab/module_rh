<?php

namespace Modules\RH\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\RH\Models\Grade;
use Modules\RH\Models\Brevet;
use Modules\RH\Models\Specialite;
use Modules\RH\Models\Unite;

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
        $nom = $this->faker->text(5);
        $prenom = $this->faker->text(5);
        return [
            'nom'           =>  $nom,
            'prenom'        =>  $prenom,
            'email'         =>  $prenom.'.'.$nom.'@intradef.gouv.fr',
            // 'grade_id'      =>  Grade::factory(),
            'grade_id'      =>  Grade::inRandomOrder()->first()?->id,
            'specialite_id' =>  Specialite::inRandomOrder()->first()?->id,
            'brevet_id'     =>  Brevet::inRandomOrder()->first()?->id,
            'unite_id'      =>  Unite::inRandomOrder()->first()?->id,
            //'nid' => $this->faker->randomNumber(6, true),
            'nid'           =>  $this->faker->unique()->numerify('nid-#####'),
            'uuid'          =>  $this->faker->uuid,
        ];
    }
}
