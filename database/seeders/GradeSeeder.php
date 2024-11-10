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
		$grades_to_seed = [
			[
			  "id" => "9d74f78a-4146-4d29-8654-fa3fc198f2e4",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "AL",
			  "libelle_long" => "Amiral",
			  "ordre" => 20,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-43f6-4bc0-b212-9aae64dd2224",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "VAE",
			  "libelle_long" => "Vice amiral d'escadre",
			  "ordre" => 19,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4542-48cb-b447-1221067aaa6c",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "VA",
			  "libelle_long" => "Vice amiral",
			  "ordre" => 18,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4697-4f61-b83b-a1c378c2f451",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "CA",
			  "libelle_long" => "Contre amiral",
			  "ordre" => 17,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-47da-40c6-b8c1-0312a97e68b3",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "CV",
			  "libelle_long" => "Capitaine de vaisseau",
			  "ordre" => 16,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4928-4e6c-b696-41a939cab841",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "CF",
			  "libelle_long" => "Capitaine de frégate",
			  "ordre" => 15,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4a77-4532-b4fa-bfe687c74fec",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "CC",
			  "libelle_long" => "Capitaine de corvette",
			  "ordre" => 14,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4bc1-4581-88b6-0f92e26cc8db",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "LV",
			  "libelle_long" => "Lieutenant de vaisseau",
			  "ordre" => 13,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4d0b-4c74-9eb8-49b6c7d61755",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "EV1",
			  "libelle_long" => "Enseigne de vaisseau de 1ère classe",
			  "ordre" => 12,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4e79-452f-b877-886f914f489c",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "EV2",
			  "libelle_long" => "Enseigne de vaisseau de 2ème classe",
			  "ordre" => 11,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-4ffb-4c62-863a-4dc9638ec3fd",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "ASP",
			  "libelle_long" => "Aspirant",
			  "ordre" => 10,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-51f7-42ec-ad52-db956d075a82",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "MAJ",
			  "libelle_long" => "Major",
			  "ordre" => 9,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-53eb-483e-9b2d-eba63724aeb2",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "MP",
			  "libelle_long" => "Maître principal",
			  "ordre" => 8,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-558a-4117-be2c-91a9b5a28226",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "PM",
			  "libelle_long" => "Premier maître",
			  "ordre" => 7,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-570d-4847-a267-7854e0f92446",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "MT",
			  "libelle_long" => "Maître",
			  "ordre" => 6,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-5912-4ce7-92f5-7d812ce75fa6",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "SM",
			  "libelle_long" => "Second maître",
			  "ordre" => 5,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-5bfd-47a8-86e4-22fccc1816d7",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "SMQ",
			  "libelle_long" => "Maistrancier",
			  "ordre" => 4,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-5f15-468e-8741-effb304bc27e",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "QM1",
			  "libelle_long" => "Quartier maître de 1ère classe",
			  "ordre" => 3,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-623a-4aaf-bdbb-1f07cbc8914f",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "QM2",
			  "libelle_long" => "Quartier maître de 2ème classe",
			  "ordre" => 2,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-6518-465c-bf62-6c9d413a8d2f",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "MO1",
			  "libelle_long" => "Matelot",
			  "ordre" => 1,
			  "data" => null,
			],
			[
			  "id" => "9d74f78a-67d7-4899-8ad2-cd321cc04427",
			  "created_at" => "2024-11-10T16:42:28.000000Z",
			  "updated_at" => "2024-11-10T16:42:28.000000Z",
			  "libelle_court" => "MO2",
			  "libelle_long" => "Matelot",
			  "ordre" => 0,
			  "data" => null,
			],
		];
		
		foreach($grades_to_seed as $grade)
		{
			Grade::create($grade);
		}        
    }
}
