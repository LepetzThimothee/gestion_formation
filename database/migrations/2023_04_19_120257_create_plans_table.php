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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session');
            $table->foreign('session')->references('session')->on('stages');
            $table->unsignedBigInteger('matricule');
            $table->foreign('matricule')->references('matricule')->on('salaries');
            $table->boolean('salaire_impute');
            $table->integer('nombre_heures_realisees');
            $table->integer('nombre_stagiaires');
            $table->double('cout_pedagogique_stagiaire');
            $table->double('transport')->default(0);
            $table->double('hebergement')->default(0);
            $table->double('restauration')->default(0);
            $table->double('total');
            $table->boolean('stage_annule')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
