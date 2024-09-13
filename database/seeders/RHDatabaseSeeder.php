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
            GradeSeeder::class
        ]);
    }
}
