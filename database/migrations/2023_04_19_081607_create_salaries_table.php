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
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('matricule');
            $table->string('nom');
            $table->string('nom_jeune_fille')->nullable();
            $table->string('prenom');
            $table->string('code_etablissement',2);
            $table->string('sexe',1);
            $table->date('naissance');
            $table->integer('age');
            $table->bigInteger('numero_secu');
            $table->string('domiciliation_bancaire');
            $table->string('iban');
            $table->string('bic');
            $table->string('email_perso');
            $table->string('email_pro');
            $table->string('adresse_ligne1');
            $table->string('adresse_ligne2');
            $table->string('adresse_ligne3');
            $table->string('adresse_ligne4');
            $table->integer('nature_contrat');
            $table->integer('type_contrat');
            $table->string('puissance_fiscal')->nullable();
            $table->string('referent_paie');
            $table->string('unite');
            $table->string('lib_unite');
            $table->string('section_analytique');
            $table->date('debut_anciennete_groupe');
            $table->date('debut_contrat');
            $table->date('fin_contrat')->nullable();
            $table->string('filiere');
            $table->string('sous_filiere');
            $table->string('metier');
            $table->string('emploi');
            $table->string('statut');
            $table->string('rpps')->nullable();
            $table->string('adeli')->nullable();
            $table->string('cpn');
            $table->double('taux_emploi');
            $table->double('horaire_contrat');
            $table->double('montant_aq004');
            $table->double('taux_horaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
