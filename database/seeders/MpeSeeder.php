<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\RH\Models\Mpe;

class MpeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mpe::factory()->count(10)->create();
    }
}
