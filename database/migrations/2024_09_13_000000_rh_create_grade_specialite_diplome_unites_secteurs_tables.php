<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $default_value = "";

        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $default_value = DB::raw('(gen_random_uuid())');
        }
        elseif (DB::connection() instanceof \Illuminate\Database\MySqlConnection){
            $default_value = DB::raw('(UUID())');
        }

        Schema::create('rh_grades', function (Blueprint $table) use ($default_value){
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_specialites', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court')->nullable(false)->default("");
            $table->string('libelle_long', 200)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_brevets', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_unites', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });
		
        Schema::create('rh_groupements', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });
		
		Schema::create('rh_services', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->foreignId('groupement_id')->references('id')->on('rh_groupements')->onDelete('cascade');
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });
		
        Schema::create('rh_secteurs', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court', 10)->nullable(false)->default("");
            $table->string('libelle_long', 100)->nullable(false)->default("");
            $table->foreignId('service_id')->references('id')->on('rh_services')->onDelete('cascade');
            $table->integer('ordre')->nullable(false)->default(0);
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
