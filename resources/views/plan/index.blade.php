<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Plan de formation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
    <input id="searchbar" onkeyup="recherche()" type="text"
           class="form-control" placeholder="Recherche dans le plan">
</nav>
<div class="container mt-3">
    @foreach ($plans as $plan)
        <div class="card formations border-info mb-3">
            <div class="card-body">
                <h3 class="card-title">Session Stage : {{ $plan->stage->session }}</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Détails du Stage : {{ $plan->stage->intitule }}</h5>
                                <p class="card-text">Organisme de formation : {{ $plan->stage->organisme }}</p>
                                <p class="card-text">Coût Pédagogique : {{ $plan->stage->cout_pedagogique }}</p>
                                <p class="card-text">Durée de la formation : {{ $plan->stage->duree }} heures</p>
                                <p class="card-text">Date de début formation : {{ $plan->stage->debut_formation }}</p>
                                <p class="card-text">Date de fin formation : {{ $plan->stage->fin_formation }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Détails du Plan</h5>
                                <p class="card-text">Coût Pédagogique par Stagiaire : {{ $plan->cout_pedagogique_stagiaire }}</p>
                                <p class="card-text">Nombre de Stagiaires : {{ $plan->nombre_stagiaires }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-info bg-white">
                        <thead>
                        <tr>
                            <th>Nom Prénom</th>
                            <th>Nombre d'heures réalisées</th>
                            <th>Transport</th>
                            <th>Hébergement</th>
                            <th>Restauration</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($plan->salaries as $salarie)
                            <tr>
                                <td>{{ $salarie->nom }} {{ $salarie->prenom }} [{{ $salarie->matricule }}]</td>
                                <td>{{ $salarie->pivot->nombre_heures_realisees }}</td>
                                <td>{{ $salarie->pivot->transport }}</td>
                                <td>{{ $salarie->pivot->hebergement }}</td>
                                <td>{{ $salarie->pivot->restauration }}</td>
                                <td>{{ $salarie->pivot->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
