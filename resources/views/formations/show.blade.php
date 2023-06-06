<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Informations de l'organisme de formation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <a class="navbar-brand" href="/">Gestion de formation</a>
</nav>
<div class="container mt-4">
    <h1>Informations de l'organisme de formation</h1>
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
            <h5 class="card-title">Organisme de formation</h5>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">Organisme</th>
                    <td>{{ $formation->organisme }}</td>
                </tr>
                <tr>
                    <th scope="row">Coordonnées téléphoniques</th>
                    <td>{{ $formation->telephone }}</td>
                </tr>
                <tr>
                    <th scope="row">Adresse email</th>
                    <td>{{ $formation->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Numéro déclaration existence</th>
                    <td>{{ $formation->numero_declaration_existence }}</td>
                </tr>
                <tr>
                    <th scope="row">Numéro de SIRET</th>
                    <td>{{ $formation->siret }}</td>
                </tr>
                <tr>
                    <th scope="row">Adresse</th>
                    <td>{{ $formation->adresse }}</td>
                </tr>
                <tr>
                    <th scope="row">Interlocuteur</th>
                    <td>{{ $formation->interlocuteur }}</td>
                </tr>
                </tbody>
            </table>
            <div class="text-right">
                <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-primary">Modifier</a>
                <form id="deleteForm" action="{{ route('formations.destroy', $formation->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                <a href="{{ route('formations.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
