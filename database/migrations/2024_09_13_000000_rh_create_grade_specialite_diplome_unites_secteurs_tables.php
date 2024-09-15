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
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_specialites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_brevets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_unites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
        });
		
        Schema::create('rh_groupements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->foreignUuid('groupement_id')->references('id')->on('rh_groupements')->onDelete('cascade');
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
        });
		
        Schema::create('rh_secteurs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->foreignUuid('service_id')->references('id')->on('rh_services')->onDelete('cascade');
            $table->integer('ordre')->nullable(false);
            $table->json('data')->nullable();
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
