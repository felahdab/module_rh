<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RH\Models\LieuUnite;

class LieuUniteSeeder extends Seeder
{
    public function run()
    {
        LieuUnite::firstOrCreate(
            [
                'uuid' =>'5fbb7tln-e330-11ef-be6c-0242c0a8600a',
                'libelle_court' => 'TLN',
                'libelle_long' => 'Toulon',
                'ordre'     => '1',
            ]
        );
        LieuUnite::firstOrCreate(
            [
                'uuid' =>'5fbb7bst-e330-11ef-be6c-0242c0a8600a',
                'libelle_court' => 'BST',
                'libelle_long' => 'Brest',
                'ordre'     => '2',
            ]
        );
    }
}
