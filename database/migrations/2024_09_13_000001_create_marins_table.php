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
        Schema::create('rh_marins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('matricule', 20)->nullable(true)->default("");
            $table->string('nid', 15)->nullable(true)->default("");
            $table->date('date_embarq')->nullable(true);
            $table->date('date_debarq')->nullable(true);
            $table->foreignUuid('grade_id')->references('id')->on('rh_grades')->nullable(true);
            $table->foreignUuid('specialite_id')->references('id')->on('rh_specialites')->nullable(true);
            $table->foreignUuid('brevet_id')->references('id')->on('rh_brevets')->nullable(true);
            $table->foreignUuid('secteur_id')->references('id')->on('rh_secteurs')->nullable(true);
            $table->foreignUuid('unite_id')->references('id')->on('rh_unites')->nullable(true);
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rh_marins');
    }
};
