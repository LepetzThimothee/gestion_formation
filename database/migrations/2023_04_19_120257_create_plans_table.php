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
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->boolean('salaire_impute')->default(false);
            $table->integer('nombre_stagiaires');
            $table->double('cout_pedagogique_stagiaire');
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
