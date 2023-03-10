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
        Schema::create('inventaires', function (Blueprint $table) {
            $table->id();
            $table->string('etat')->nullable();
            $table->string('nom_agent')->nullable();
            $table->string('observations')->nullable();
            $table->date('date_inventaire')->nullable();
            $table->string('libelle_localisation')->nullable();
            $table->string('code_localisation')->nullable();

            $table->unsignedBigInteger('id_codification')->unsigned();
            $table->foreign('id_codification')->references('id')->on('codifications')->onDelete('cascade');

            $table->unsignedBigInteger('id_periode_inventaire')->unsigned();
            $table->foreign('id_periode_inventaire')->references('id')->on('periode_inventaires')->onDelete('cascade');

            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaires');
    }
};
