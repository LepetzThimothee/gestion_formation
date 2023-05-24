<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Stages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
    <label for="searchbar"></label>
    <input id="searchbar" onkeyup="recherche()" type="text"
           class="form-control" placeholder="intitulé de formation">
</nav>
<div class="mx-4 mt-4">
    <em>Note : cliquer sur un stage pour commencer le plan à partir de celui-ci</em>
    <h1>Liste des Stages</h1>
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-sm table-hover clickable-row">
        <thead>
        <tr>
            <th>Session</th>
            <th>Intitule de formation</th>
            <th>Organisme de formation</th>
            <th>Formation obligatoire</th>
            <th>Intra Inter</th>
            <th>Cout pedagogique</th>
            <th>Debut formation</th>
            <th>Fin formation</th>
            <th>Duree réelle de la formation</th>
            <th>Opco SANTE</th>
            <th>Convention de formation</th>
            <th>Convocation</th>
            <th>Attestation</th>
            <th>Facture</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($stages as $stage)
            <tr class="stages" onclick="redirectToPlanCreate(this)">
                <td>{{ $stage->session }}</td>
                <td style="background-color: #c1e0fc">{{ $stage->intitule }}</td>
                <td>{{ $stage->organisme }}</td>
                <td>{{ $stage->formation_obligatoire }}</td>
                <td>{{ $stage->intra_inter }}</td>
                <td>{{ $stage->cout_pedagogique }}</td>
                @if(is_numeric($stage->debut_formation))
                    <td>{{ Illuminate\Support\Facades\Date::create(1900,1,0)->addDays($stage->debut_formation-1)->format('d/m/Y') }}</td>
                @else
                    <td>{{ $stage->debut_formation }}</td>
                @endif
                @if(is_numeric($stage->fin_formation))
                    <td>{{ Illuminate\Support\Facades\Date::create(1900,1,0)->addDays($stage->fin_formation-1)->format('d/m/Y') }}</td>
                @else
                    <td>{{ $stage->fin_formation }}</td>
                @endif
                <td>{{ $stage->duree }}</td>
                <td>{{ $stage->opco }}</td>
                <td>{{ $stage->convention }}</td>
                <td>{{ $stage->convocation }}</td>
                <td>{{ $stage->attestation }}</td>
                <td>{{ $stage->facture }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
