<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rh_unites', function (Blueprint $table) {
            $table->unsignedBigInteger('lieu_unite_id')->nullable()->after('type_unite_id');
            $table->string('libannudef')->nullable()->after('lieu_unite_id');
            $table->foreign('lieu_unite_id')->references('id')->on('rh_lieu_unites')->onDelete('set null');
            $table->string('libelle_court',50)->change();
            $table->string('libelle_long',150)->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rh_unites', function (Blueprint $table) {
            $table->dropForeign(['lieu_unite_id']);
            $table->dropColumn(['lieu_unite_id', 'libannudef']);
            $table->string('libelle_court',10)->change();
            $table->string('libelle_long',100)->change();
        });

    }
};
