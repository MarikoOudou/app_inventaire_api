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
        Schema::create('codifications', function (Blueprint $table) {
            $table->id();
            $table->string('n_inventaire')->unique()->nullable();
            $table->string('libelle_immo')->nullable();
            $table->string('code_localisation')->nullable();
            $table->string('libelle_localisation')->nullable();
            $table->text('libelle_complementaire')->nullable();

            $table->string('code_guichet')->nullable();
            $table->string('departement')->nullable();
            $table->string('n_serie')->nullable();
            $table->string('direction')->nullable();
            $table->string('famille')->nullable();
            $table->string('libelle_famille')->nullable();
            $table->string('sous_libelle_famille')->nullable();
            $table->string('niveau')->nullable();
            $table->string('service')->nullable();
            $table->string('sous_famille')->nullable();
            $table->string('libelle_agence')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codifications');
    }
};
