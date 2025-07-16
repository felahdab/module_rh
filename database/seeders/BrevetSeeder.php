<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\RH\Models\Brevet;

class BrevetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$records_to_seed = [
			[
				'uuid'             => "9d00229a-1e2e-480b-9119-f5cdce3d53e0",
				'libelle_court' => 'BE',
				'libelle_long'  => 'Brevet élémentaire',
				'ordre'  => 1,
			],
			[
				'uuid'             => "9d00229a-2193-4c9c-ab57-dfdf8eb2840b",
				'libelle_court' => 'BAT',
				'libelle_long'  => 'Brevet d\'aptitude technique',
				'ordre'  => 2,
			],
			[
				'uuid'             => "9d00229a-21f3-458b-80ae-1dd7d69bc3c7",
				'libelle_court' => 'BS',
				'libelle_long'  => 'Brevet supérieur',
				'ordre'  => 3,
			],
			[
				'uuid'             => "9d00229a-2252-422c-8e4a-dab0f4c45f5f",
				'libelle_court' => 'BM',
				'libelle_long'  => 'Brevet de maitrise',
				'ordre'  => 4,
			],
			[
				'uuid'             => "9d00229a-22ac-4978-a07d-ab40d798211c",
				'libelle_court' => 'OFF',
				'libelle_long'  => 'Officier',
				'ordre'  => 5,
			]
		];

		foreach($records_to_seed as $record)
		{
			Brevet::create($record);
		} 
    }
}
