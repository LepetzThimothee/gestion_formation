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
        Schema::create('formations', function (Blueprint $table) {
            $table->id(); // id
            $table->string('organisme')->nullable(); // l'organise de formation
            $table->string('telephone')->nullable(); // le numero de telephone
            $table->string('email')->nullable(); // l'adresse mail
            $table->string('numero_declaration_existence',11)->nullable(); // le numero de declaration d'existence
            $table->bigInteger('siret')->unique()->nullable(); // le numero de SIRET
            $table->string('adresse')->nullable(); // l'adresse physique
            $table->string('interlocuteur')->nullable(); // l'interlocuter
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
