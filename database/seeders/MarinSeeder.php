<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\RH\Models\Marin;
use Modules\RH\Models\Grade;
use Modules\RH\Models\Brevet;
use Modules\RH\Models\Specialite;
use Modules\RH\Models\Unite;

class MarinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env' != 'production')){
            // Creer 9 marins
            Marin::factory()->count(9)->create();
            
            // Creer un mentor
            Marin::create([
                'uuid'      =>  (string) \Illuminate\Support\Str::uuid(),
                'nid'       => 'nid_mentor',
                'nom'       => 'MENTOR',
                'prenom'    => 'Prenom',
                //'grade_id'      =>  Grade::factory()->create()->id,
                'grade_id'      =>  Grade::inRandomOrder()->first()->id,
                'specialite_id' =>  Specialite::inRandomOrder()->first()->id,
                'brevet_id'     =>  Brevet::inRandomOrder()->first()->id,
                'unite_id'      =>  Unite::inRandomOrder()->first()->id,
                'data'      => json_encode(['role' => 'mentor']),
                'user_id'   => null,
            ]);
        }
       
    }
}