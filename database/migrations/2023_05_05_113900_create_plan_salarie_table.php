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
        Schema::create('plan_salarie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->unsignedBigInteger('salarie_matricule');
            $table->foreign('salarie_matricule')->references('matricule')->on('salaries');
            $table->decimal('nombre_heures_realisees', 10, 2)->nullable();
            $table->decimal('transport', 10, 2)->nullable();
            $table->decimal('hebergement', 10, 2)->nullable();
            $table->decimal('restauration', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_salarie');
    }
};
