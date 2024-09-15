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
            $table->uuid('grade_id')->nullable(true);
            $table->uuid('specialite_id')->nullable(true);
            $table->uuid('brevet_id')->nullable(true);
            $table->uuid('secteur_id')->nullable(true);
            $table->uuid('unite_id')->nullable(true);
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
