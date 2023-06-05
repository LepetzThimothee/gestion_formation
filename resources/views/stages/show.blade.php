<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Informations du stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
</nav>
<div class="container mt-4">
    <h1>Informations du stage</h1>
    @if(session('status'))
        <div class="alert alert-success mt-4">
            {{ session('status') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Stage</h5>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">Session</th>
                    <td>{{ $stage->session }}</td>
                </tr>
                <tr>
                    <th scope="row">Intitule de formation</th>
                    <td>{{ $stage->intitule }}</td>
                </tr>
                <tr>
                    <th scope="row">Organisme de formation</th>
                    <td>{{ $stage->organisme }}</td>
                </tr>
                <tr>
                    <th scope="row">Formation obligatoire</th>
                    <td>{{ $stage->formation_obligatoire }}</td>
                </tr>
                <tr>
                    <th scope="row">Intra Inter</th>
                    <td>{{ $stage->intra_inter }}</td>
                </tr>
                <tr>
                    <th scope="row">Cout pedagogique</th>
                    <td>{{ $stage->cout_pedagogique }}</td>
                </tr>
                <tr>
                    <th scope="row">Debut formation</th>
                    <td>{{ $stage->debut_formation }}</td>
                </tr>
                <tr>
                    <th scope="row">Fin formation</th>
                    <td>{{ $stage->fin_formation }}</td>
                </tr>
                <tr>
                    <th scope="row">Duree réelle de la formation</th>
                    <td>{{ $stage->duree }}</td>
                </tr>
                <tr>
                    <th scope="row">Opco SANTE</th>
                    <td>{{ $stage->opco }}</td>
                </tr>
                <tr>
                    <th scope="row">Convention de formation</th>
                    <td>{{ $stage->convention }}</td>
                </tr>
                <tr>
                    <th scope="row">Convocation</th>
                    <td>{{ $stage->convocation }}</td>
                </tr>
                <tr>
                    <th scope="row">Attestation</th>
                    <td>{{ $stage->attestation }}</td>
                </tr>
                <tr>
                    <th scope="row">Facture</th>
                    <td>{{ $stage->facture }}</td>
                </tr>
                </tbody>
            </table>
            <div class="text-right">
                <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-primary">Modifier</a>
                <form id="deleteForm" action="{{ route('stages.destroy', $stage->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                <a href="{{ route('stages.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
