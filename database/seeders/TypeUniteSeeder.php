<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RH\Models\TypeUnite;
use Illuminate\Support\Facades\Log;


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
      Log::info('🏷️ Début du seed des types d\'unités');

        $records = [
            [
              "uuid"=> "5fba908c-e330-11ef-be6c-0242c0a8600a",
              "libelle_court" =>"ALFAN 1",
              "libelle_long" =>"ALFAN TOULON 1",
              "ordre" => "1",

            ],
           
            
        ];
        
        $createdCount = 0;
        $existingCount = 0;

        foreach ($records as $record) {
            $typeUnite = TypeUnite::firstOrCreate(
                [
                    'uuid' => $record['uuid'],
                
                    'libelle_court' => $record['libelle_court'],
                    'libelle_long' => $record['libelle_long'],
                    'ordre' => $record['ordre'],
                ]
            );

            if ($typeUnite->wasRecentlyCreated) {
                $createdCount++;
                Log::info("✅ Type d'unité créé: {$record['libelle_court']} (UUID: {$record['uuid']})");
            } else {
                $existingCount++;
            }
        }

        Log::info("📊 Seed des types d'unités terminé", [
            'créés' => $createdCount,
            'existants' => $existingCount,
            'total' => count($records),
        ]);
    }
}


