<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate(["name" => "rh::change_module_configuration", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "rh::voir_tous_les_marins", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "rh::attribuer_une_unite_a_un_utilisateur", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "rh::attribuer_une_unite_a_un_marin", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "rh::associer_un_marin_et_un_utilisateur", "guard_name" => "web"]);
    }
}
