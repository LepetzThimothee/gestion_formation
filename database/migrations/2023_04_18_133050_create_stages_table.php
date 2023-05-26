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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('session')->nullable();
            $table->string('intitule')->nullable();
            $table->unsignedBigInteger('formation_id')->nullable();
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('set null');
            $table->string('organisme')->nullable();
            $table->string('formation_obligatoire')->nullable();
            $table->string('intra_inter',1)->nullable();
            $table->string('cout_pedagogique')->nullable();
            $table->string('debut_formation')->nullable();
            $table->string('fin_formation')->nullable();
            $table->string('duree')->nullable();
            $table->string('opco')->nullable();
            $table->string('convention')->nullable();
            $table->string('convocation')->nullable();
            $table->string('attestation')->nullable();
            $table->string('facture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
