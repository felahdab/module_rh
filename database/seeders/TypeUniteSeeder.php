<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TypeUniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      /*
      DB:table('rh_type_unites')->insert([
        ['uuid'=>'5fba908c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALFAN 1', 'libelle_long' => 'ALFAN TOULON 1']
        ['uuid'=>'5fbb7f3e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALFAN 2', 'libelle_long' => 'ALFAN TOULON 2']
        ['uuid'=>'5fbe091a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALFAN 3', 'libelle_long' => 'ALFAN TOULON 3']
       // ['uuid'=>'', 'libelle_court' => '', 'libelle_long' => '']
      ]);
      */

        $records = [
            [
              "5fba908c-e330-11ef-be6c-0242c0a8600a",
              "ALFAN 1",
              "ALFAN TOULON 1",

            ],
            [
              "5fbb7f3e-e330-11ef-be6c-0242c0a8600a",
              "ALFAN 2",
              "ALFAN TOULON 2",

            ],
            [
              "5fbe091a-e330-11ef-be6c-0242c0a8600a",
              "ALFAN 3",
              "ALFAN TOULON 3",

            ],
            [
              "5fc0bde1-e330-11ef-be6c-0242c0a8600a",
              "ALFAN 4",
              "ALFAN TOULON 4",

            ],
            
        ];
        
        foreach ($records as $record){
            DB::insert('insert into rh_type_unites (uuid, libelle_court, libelle_long) values (?, ?, ?)', $record);
        }
    }
}
