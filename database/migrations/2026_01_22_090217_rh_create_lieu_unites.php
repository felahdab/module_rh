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
        
        
        Schema::create('rh_lieu_unites', function (Blueprint $table) use ($default_value) {
            $table->id();
            $table->uuid('uuid')->default($default_value);
            $table->string('libelle_court')->default('TLN'); // Nom de l'unité
            $table->string('libelle_long')->default('Toulon'); // Ville, par défaut Toulon
            $table->integer('ordre')->nullable(false)->default(0);
            $table->json('data')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rh_lieu_unites');
    }
};
