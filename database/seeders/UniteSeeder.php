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

            ],
            [
              "5fbb7f3e-e330-11ef-be6c-0242c0a8600a",
              "GTR/T",
              "GTR TOULON",

            ],
            [
              "5fbe091a-e330-11ef-be6c-0242c0a8600a",
              "AQN_A",
              "AQUITAINE A",

            ],
            [
              "5fc0bde1-e330-11ef-be6c-0242c0a8600a",
              "AQN_B",
              "AQUITAINE B",

            ],
            [
              "5fc36c69-e330-11ef-be6c-0242c0a8600a",
              "PCE_A",
              "PROVENCE A",

            ],
            [
              "5fc5e6a0-e330-11ef-be6c-0242c0a8600a",
              "PCE_B",
              "PROVENCE B",

            ],
            [
              "5fc7d756-e330-11ef-be6c-0242c0a8600a",
              "LGC_A",
              "LANGUEDOC A",

            ],
            [
              "5fc8d986-e330-11ef-be6c-0242c0a8600a",
              "LGC_B",
              "LANGUEDOC B",

            ],
            [
              "5fc9de72-e330-11ef-be6c-0242c0a8600a",
              "AVG",
              "AUVERGNE",

            ],
            [
              "5fcad25d-e330-11ef-be6c-0242c0a8600a",
              "BTE_A",
              "BRETAGNE A",

            ],
            [
              "5fcbdc7e-e330-11ef-be6c-0242c0a8600a",
              "BTE_B",
              "BRETAGNE B",

            ],
            [
              "5fccf62a-e330-11ef-be6c-0242c0a8600a",
              "NMD",
              "NORMANDIE",

            ],
            [
              "5fce0984-e330-11ef-be6c-0242c0a8600a",
              "ALS",
              "ALSACE",

            ],
            [
              "5fcf24d8-e330-11ef-be6c-0242c0a8600a",
              "LRN",
              "LORRAINE",

            ],
            [
              "5fd04505-e330-11ef-be6c-0242c0a8600a",
              "HE",
              "HORS ESCOUADE",

            ],
            [
              "5fd15843-e330-11ef-be6c-0242c0a8600a",
              "FCM",
              "Formation Continue Modularisée",

            ],
        ];
        
        foreach ($records as $record){
            DB::insert('insert into rh_unites (uuid, libelle_court, libelle_long) values (?, ?, ?)', $record);
        }
    }
}
