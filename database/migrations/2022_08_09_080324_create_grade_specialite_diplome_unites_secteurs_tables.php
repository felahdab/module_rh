<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rh_grades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('grade_libcourt', 10)->nullable(false)->default("");
            $table->string('grade_liblong', 100)->nullable(false)->default("");
            $table->integer('ordre_classmt')->nullable(false);
        });
		
		Schema::create('rh_specialites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('specialite_libcourt', 20)->nullable(false)->default("");
            $table->string('specialite_liblong', 256)->nullable(false)->default("");
        });
		
		Schema::create('rh_brevets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('diplome_libcourt', 10)->nullable(false)->default("");
            $table->string('diplome_liblong', 150)->nullable(false)->default("");
			$table->integer('ordre_classmt')->nullable(false);
        });
		
		Schema::create('rh_unites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unite_libcourt', 50)->nullable(false)->default("");
            $table->string('unite_liblong', 150)->nullable(false)->default("");
        });
		
		Schema::create('rh_secteurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('secteur_libcourt', 20)->nullable(false)->default("");
            $table->string('secteur_liblong', 256)->nullable(false)->default("");
			$table->foreignId('service_id')->nullable(false);
        });
		
		Schema::create('rh_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('service_libcourt', 15)->nullable(false)->default("");
            $table->string('service_liblong', 256)->nullable(false)->default("");
			$table->foreignId('groupement_id')->nullable(false);
        });
		
		Schema::create('rh_groupements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('groupement_libcourt', 15)->nullable(false)->default("");
            $table->string('groupement_liblong', 256)->nullable(false)->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rh_grades');
		Schema::dropIfExists('rh_specialites');
		Schema::dropIfExists('rh_brevets');
		Schema::dropIfExists('rh_unites');
    }
};
