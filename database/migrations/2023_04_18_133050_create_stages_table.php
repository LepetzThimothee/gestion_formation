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
            $table->string('session')->unique()->nullable();
            $table->string('intitule')->nullable();
            $table->unsignedBigInteger('formation_id')->nullable();
            $table->foreign('formation_id')->references('id')->on('formations');
            $table->string('organisme')->nullable();
            $table->string('formation_obligatoire')->nullable();
            $table->string('intra_inter',1)->nullable();
            $table->double('cout_pedagogique')->nullable();
            $table->date('debut_formation')->nullable();
            $table->date('fin_formation')->nullable();
            $table->integer('duree')->nullable();
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
