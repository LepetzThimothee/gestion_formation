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
            $table->bigIncrements('session');
            $table->unsignedBigInteger('formation_id');
            $table->foreign('formation_id')->references('id')->on('formations');
            $table->string('intitule');
            $table->string('numero')->nullable();
            $table->string('organisme');
            $table->boolean('formation_obligatoire');
            $table->string('intra_inter',1);
            $table->double('cout_pedagogique');
            $table->date('debut_formation');
            $table->date('fin_formation');
            $table->integer('duree');
            $table->boolean('opco');
            $table->boolean('convention');
            $table->boolean('convocation');
            $table->boolean('attestation');
            $table->boolean('facture');
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
