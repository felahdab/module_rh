<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
              "5fba908c-e330-11ef-be6c-0242c0a8600a",
              "GTR/B",
              "GTR BREST",
              "abc123",
              1
            ],
            [
              "5fbb7f3e-e330-11ef-be6c-0242c0a8600a",
              "GTR/T",
              "GTR TOULON",
              "abc123",
              2
            ],
            [
              "5fbe091a-e330-11ef-be6c-0242c0a8600a",
              "AQN_A",
              "AQUITAINE A",
              "abc123",
              3
            ],
            [
              "5fc0bde1-e330-11ef-be6c-0242c0a8600a",
              "AQN_B",
              "AQUITAINE B",
              "abc123",
              1
            ],
            [
              "5fc36c69-e330-11ef-be6c-0242c0a8600a",
              "PCE_A",
              "PROVENCE A",
              "abc123",
              1
            ],
            [
              "5fc5e6a0-e330-11ef-be6c-0242c0a8600a",
              "PCE_B",
              "PROVENCE B",
              "abc123",
              1
            ],
            [
              "5fc7d756-e330-11ef-be6c-0242c0a8600a",
              "LGC_A",
              "LANGUEDOC A",
              "abc123",
              1
            ],
            [
              "5fc8d986-e330-11ef-be6c-0242c0a8600a",
              "LGC_B",
              "LANGUEDOC B",
              "abc123",
              1
            ],
            [
              "5fc9de72-e330-11ef-be6c-0242c0a8600a",
              "AVG",
              "AUVERGNE",
              "abc123",
              1
            ],
            [
              "5fcad25d-e330-11ef-be6c-0242c0a8600a",
              "BTE_A",
              "BRETAGNE A",
              "abc123",
              2
            ],
            [
              "5fcbdc7e-e330-11ef-be6c-0242c0a8600a",
              "BTE_B",
              "BRETAGNE B",
              "abc123",
              2
            ],
            [
              "5fccf62a-e330-11ef-be6c-0242c0a8600a",
              "NMD",
              "NORMANDIE",
              "abc123",
              2
            ],
            [
              "5fce0984-e330-11ef-be6c-0242c0a8600a",
              "ALS",
              "ALSACE",
              "abc123",
              2
            ],
            [
              "5fcf24d8-e330-11ef-be6c-0242c0a8600a",
              "LRN",
              "LORRAINE",
              "abc123",
              3
            ],
            [
              "5fd04505-e330-11ef-be6c-0242c0a8600a",
              "HE",
              "HORS ESCOUADE",
              "abc123",
              2
            ],
            [
              "5fd15843-e330-11ef-be6c-0242c0a8600a",
              "FCM",
              "Formation Continue Modularisée",
              "abc123",
              1
            ],
        ];
        
        foreach ($records as $record){
            DB::insert('insert into rh_unites (uuid, libelle_court, libelle_long,code_sirh_unite,type_unite_id) values (?, ?, ?, ?, ?)', $record);
        }
    }
}
