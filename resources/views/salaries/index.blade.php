<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Salariés</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <a class="navbar-brand" href="/">Gestion de formation</a>
    <label for="searchbar"></label>
    <input id="searchbar" onkeyup="recherche(['liste-salaries', 1])" type="text"
           class="form-control" placeholder="nom prénom du salarié">
</nav>
<div class="mx-4 mt-4">
    <h1>Liste des Salariés</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm table-hover clickable-row">
            <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom de famille et prénom de l'agent</th>
                <th>Nom de jeune fille de l'agent</th>
                <th>Code établissement</th>
                <th>Code sexe de l'agent</th>
                <th>Date de naissance</th>
                <th>Age salarié</th>
                <th>Numéro de sécurité sociale</th>
                <th>Domiciliation bancaire</th>
                <th>Code IBAN</th>
                <th>BIC</th>
                <th>Email perso</th>
                <th>Email pro</th>
                <th>Ligne 1 de l'adresse</th>
                <th>Ligne 2 de l'adresse</th>
                <th>Ligne 3 de l'adresse</th>
                <th>Ligne 4 de l'adresse</th>
                <th>Nature du contrat</th>
                <th>Type contrat</th>
                <th>Puissance fiscale du véhicule</th>
                <th>Référent paie</th>
                <th>Unite</th>
                <th>LIB unite</th>
                <th>Section analytique</th>
                <th>Début ancienneté groupe</th>
                <th>Date début contrat</th>
                <th>Date fin contrat</th>
                <th>Filière</th>
                <th>Sous Filière</th>
                <th>Métier</th>
                <th>Emploi</th>
                <th>Statut</th>
                <th>Numéro RPPS</th>
                <th>Numéro ADELI</th>
                <th>Code CPN</th>
                <th>Taux emploi</th>
                <th>Horaire contrat</th>
                <th>Montant AQ004</th>
                <th>Taux horaire</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($salaries as $salarie)
                <tr class="liste-salaries">
                    <td>{{ $salarie->matricule }}</td>
                    <td>{{ $salarie->nom . " " . $salarie->prenom }}</td>
                    <td>{{ $salarie->nom_jeune_fille }}</td>
                    <td>{{ $salarie->code_etablissement }}</td>
                    <td>{{ $salarie->sexe }}</td>
                    <td>{{ $salarie->naissance }}</td>
                    <td>{{ $salarie->age }}</td>
                    <td>{{ $salarie->numero_secu }}</td>
                    <td>{{ $salarie->domiciliation_bancaire }}</td>
                    <td>{{ $salarie->iban }}</td>
                    <td>{{ $salarie->bic }}</td>
                    <td>{{ $salarie->email_perso }}</td>
                    <td>{{ $salarie->email_pro }}</td>
                    <td>{{ $salarie->adresse_ligne1 }}</td>
                    <td>{{ $salarie->adresse_ligne2 }}</td>
                    <td>{{ $salarie->adresse_ligne3 }}</td>
                    <td>{{ $salarie->adresse_ligne4 }}</td>
                    <td>{{ $salarie->nature_contrat }}</td>
                    <td>{{ $salarie->type_contrat }}</td>
                    <td>{{ $salarie->puissance_fiscal }}</td>
                    <td>{{ $salarie->referent_paie }}</td>
                    <td>{{ $salarie->unite }}</td>
                    <td>{{ $salarie->lib_unite }}</td>
                    <td>{{ $salarie->section_analytique }}</td>
                    <td>{{ $salarie->debut_anciennete_groupe }}</td>
                    <td>{{ $salarie->debut_contrat }}</td>
                    <td>{{ $salarie->fin_contrat }}</td>
                    <td>{{ $salarie->filiere }}</td>
                    <td>{{ $salarie->sous_filiere }}</td>
                    <td>{{ $salarie->metier }}</td>
                    <td>{{ $salarie->emploi }}</td>
                    <td>{{ $salarie->statut }}</td>
                    <td>{{ $salarie->rpps }}</td>
                    <td>{{ $salarie->adeli }}</td>
                    <td>{{ $salarie->cpn }}</td>
                    <td>{{ $salarie->taux_emploi }}</td>
                    <td>{{ $salarie->horaire_contrat }}</td>
                    <td>{{ $salarie->montant_aq004 }}</td>
                    <td>{{ $salarie->taux_horaire }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
