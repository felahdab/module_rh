<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\RH\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
			'id'             => 1,
			'libelle_court' => 'AL',
			'libelle_long'  => 'Amiral',
			'ordre'  => 20,
        ]);
		Grade::create([
			'id'             => 2,
			'libelle_court' => 'VAE',
			'libelle_long'  => 'Vice amiral d\'escadre',
			'ordre'  => 19,
        ]);
		Grade::create([
			'id'             => 3,
			'libelle_court' => 'VA',
			'libelle_long'  => 'Vice amiral',
			'ordre'  => 18,
        ]);
		Grade::create([
			'id'             => 4,
			'libelle_court' => 'CA',
			'libelle_long'  => 'Contre amiral',
			'ordre'  => 17,
        ]);
		Grade::create([
			'id'             => 5,
			'libelle_court' => 'CV',
			'libelle_long'  => 'Capitaine de vaisseau',
			'ordre'  => 16,
        ]);
		Grade::create([
			'id'             => 6,
			'libelle_court' => 'CF',
			'libelle_long'  => 'Capitaine de frégate',
			'ordre'  => 15,
        ]);
		Grade::create([
			'id'             => 7,
			'libelle_court' => 'CC',
			'libelle_long'  => 'Capitaine de corvette',
			'ordre'  => 14,
        ]);
		Grade::create([
			'id'             => 8,
			'libelle_court' => 'LV',
			'libelle_long'  => 'Lieutenant de vaisseau',
			'ordre'  => 13,
        ]);
		Grade::create([
			'id'             => 9,
			'libelle_court' => 'EV1',
			'libelle_long'  => 'Enseigne de vaisseau de 1ère classe',
			'ordre'  => 12,
        ]);
		Grade::create([
			'id'             => 10,
			'libelle_court' => 'EV2',
			'libelle_long'  => 'Enseigne de vaisseau de 2ème classe',
			'ordre'  => 11,
        ]);
		Grade::create([
			'id'             => 11,
			'libelle_court' => 'ASP',
			'libelle_long'  => 'Aspirant',
			'ordre'  => 10,
        ]);
		Grade::create([
			'id'             => 12,
			'libelle_court' => 'MAJ',
			'libelle_long'  => 'Major',
			'ordre'  => 9,
        ]);
		Grade::create([
			'id'             => 13,
			'libelle_court' => 'MP',
			'libelle_long'  => 'Maître principal',
			'ordre'  => 8,
        ]);
		Grade::create([
			'id'             => 14,
			'libelle_court' => 'PM',
			'libelle_long'  => 'Premier maître',
			'ordre'  => 7,
        ]);
		Grade::create([
			'id'             => 15,
			'libelle_court' => 'MT',
			'libelle_long'  => 'Maître',
			'ordre'  => 6,
        ]);
		Grade::create([
			'id'             => 16,
			'libelle_court' => 'SM',
			'libelle_long'  => 'Second maître',
			'ordre'  => 5,
        ]);
		Grade::create([
			'id'             => 17,
			'libelle_court' => 'SMQ',
			'libelle_long'  => 'Maistrancier',
			'ordre'  => 4,
        ]);
		Grade::create([
			'id'             => 18,
			'libelle_court' => 'QM1',
			'libelle_long'  => 'Quartier maître de 1ère classe',
			'ordre'  => 3,
        ]);
		Grade::create([
			'id'             => 19,
			'libelle_court' => 'QM2',
			'libelle_long'  => 'Quartier maître de 2ème classe',
			'ordre'  => 2,
        ]);
		Grade::create([
			'id'             => 20,
			'libelle_court' => 'MO1',
			'libelle_long'  => 'Matelot',
			'ordre'  => 1,
        ]);
        Grade::create([
			'id'             => 21,
			'libelle_court' => 'MO2',
			'libelle_long'  => 'Matelot',
			'ordre'  => 0,
        ]);
    }
}
