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

        Schema::create('rh_marins', function (Blueprint $table) use ($default_value){
            $table->id('id');
            $table->uuid('uuid')->default($default_value);
            $table->string('nom');
            $table->string('prenom');
            $table->string('matricule', 20)->nullable(true)->default("");
            $table->string('nid', 15)->nullable(true)->default("")->unique();
            $table->date('date_embarq')->nullable(true);
            $table->date('date_debarq')->nullable(true);
            $table->foreignId('grade_id')->nullable(true)->references('id')->on('rh_grades');
            $table->foreignId('specialite_id')->nullable(true)->references('id')->on('rh_specialites');
            $table->foreignId('brevet_id')->nullable(true)->references('id')->on('rh_brevets');
            $table->foreignId('unite_id')->nullable(true)->references('id')->on('rh_unites');
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
