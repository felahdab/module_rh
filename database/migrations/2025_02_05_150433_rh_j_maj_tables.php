<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $default_value = "";

        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $default_value = DB::raw('(gen_random_uuid())');
        }
        elseif (DB::connection() instanceof \Illuminate\Database\MySqlConnection){
            $default_value = DB::raw('(UUID())');
        }


        
        // Rajout champ supplementaire (email ,display_name et code) dans table RH_marins
        Schema::table('rh_marins', function (Blueprint $table) {
            $table->string('email')->unique()->nullable();
            $table->string('display_name')->nullable();
            $table->string('code_sirh_user')->nullable();
        });

        // Rajout categorie mere fille et code dans RH_unites 
        Schema::table('rh_unites', function (Blueprint $table) {
            $table->string('code_sirh_unite')->nullable();
            // Ajout de la colonne id_mere
            $table->unsignedBigInteger('id_mere')->nullable();
            // Definir la cle etrangere pour id_mere
            $table->foreign('id_mere')->references('id')->on('rh_unites');
        });

       
        // Creation table RH_type_unites
        Schema::create('rh_type_unites', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->timestamps();
            $table->string('libelle_court')->nullable(false)->default("");
            $table->string('libelle_long', 200)->nullable(false)->default("");
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
        });

        //Liaison entre RH_unites et RH_type_unites
        Schema::table('rh_unites', function (Blueprint $table) {
            $table->foreignId('type_unite_id')->nullable()->references('id')->on('rh_type_unites');
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rh_marins', function (Blueprint $table) {
            // Supprimer clef
        $table->dropUnique(['email']);
        // Supprimer les champs ajoutés  
        $table->dropColumn('email');   
        $table->dropColumn('display_name'); 
        $table->dropColumn('code_sirh_user'); 
        });


        Schema::table('rh_unites', function (Blueprint $table) {
          
            // Supprime cle etrangere
            $table->dropForeign(['id_mere']);
            $table->dropForeign(['type_unite_id']);
            // Supprime colonnes 
            $table->dropColumn('id_mere');
            $table->dropColumn('code_sirh_unite'); 
            $table->dropColumn('type_unite_id'); 

        });


        Schema::dropIfExists('rh_specialites');
    }
};
