<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Stages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
    <label for="searchbar"></label>
    <input id="searchbar" onkeyup="recherche(['liste-stages', 1])" type="text"
           class="form-control" placeholder="intitulé de formation">
</nav>
<div class="mx-4 mt-4">
    <em>Note : cliquer sur un stage pour commencer le plan à partir de celui-ci</em>
    <h1>Liste des Stages</h1>
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
    <a href="{{ route('stages.create') }}">Vous ne trouvez pas un stage ? Créez-le !</a>
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
            <th>Edition</th>
            <th>Suppression</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($stages as $stage)
            <tr class="liste-stages" onclick="redirectToPlanCreate(this)">
                <td>{{ $stage->session }}</td>
                <td style="background-color: #c1e0fc">{{ $stage->intitule }}</td>
                <td>{{ $stage->organisme }}</td>
                <td>{{ $stage->formation_obligatoire }}</td>
                <td>{{ $stage->intra_inter }}</td>
                <td>{{ $stage->cout_pedagogique }}</td>
                <td>{{ $stage->debut_formation }}</td>
                <td>{{ $stage->fin_formation }}</td>
                <td>{{ $stage->duree }}</td>
                <td>{{ $stage->opco }}</td>
                <td>{{ $stage->convention }}</td>
                <td>{{ $stage->convocation }}</td>
                <td>{{ $stage->attestation }}</td>
                <td>{{ $stage->facture }}</td>
                <td>
                    <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-edit btn-sm mr-2">
                        Modifier
                    </a>
                </td>
                <td>
                    <a href="{{ route('stages.show', $stage->id) }}" class="btn btn-delete btn-sm">
                        Supprimer
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
