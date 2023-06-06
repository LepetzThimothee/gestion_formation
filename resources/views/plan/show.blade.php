<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Plan de formation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
</nav>
<div class="container mt-3">
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-1 mt-1">
            {{ session('error') }}
        </div>
    @endif
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
                            <p class="card-text debut-formation">Date de début formation : {{ $plan->stage->debut_formation }}</p>
                            <p class="card-text fin-formation">Date de fin formation : {{ $plan->stage->fin_formation }}</p>
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
                        <th>Nom Prénom [Matricule]</th>
                        <th>Code établissement</th>
                        <th>Nombre d'heures réalisées</th>
                        <th>Transport</th>
                        <th>Hébergement</th>
                        <th>Restauration</th>
                        <th>Total</th>
                        <th>Détacher</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plan->salaries as $salarie)
                        <tr>
                            <td>{{ $salarie->nom }} {{ $salarie->prenom }} [{{ $salarie->matricule }}]</td>
                            <td>{{ $salarie->code_etablissement }}</td>
                            <td>{{ $salarie->pivot->nombre_heures_realisees }}</td>
                            <td>{{ $salarie->pivot->transport }}</td>
                            <td>{{ $salarie->pivot->hebergement }}</td>
                            <td>{{ $salarie->pivot->restauration }}</td>
                            <td>{{ $salarie->pivot->total }}</td>
                            <td>
                                <form action="{{ route('plan.detach', ['plan' => $plan->id, 'salarie' => $salarie->matricule]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Détacher</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="{{ route('plan.edit', $plan->id) }}" class="btn btn-primary">Modifier</a>
                <a href="{{ route('plan.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
