<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Seeder;

class RHDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            GradeSeeder::class,
            BrevetSeeder::class,
            SpecialiteSeeder::class,
            TypeUniteSeeder::class,
            UniteSeeder::class
        ]);
    }
}
