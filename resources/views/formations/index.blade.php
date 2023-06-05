<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Formations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
    <label for="searchbar"></label>
    <input id="searchbar" onkeyup="recherche(['liste-formations',0])" type="text"
           class="form-control" placeholder="organisme de formation">
</nav>
<div class="mx-4 mt-4">
    <h1>Liste des Formations</h1>
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
    <a href="{{ route('formations.create') }}">Vous ne trouvez pas une formation ? Créez-la !</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm table-hover clickable-row">
            <thead>
            <tr>
                <th>Organismes de formation</th>
                <th>Coordonnées téléphoniques</th>
                <th>Adresses mail</th>
                <th>Numéro déclaration existence</th>
                <th>Numéro de SIRET</th>
                <th>Adresse</th>
                <th>Interlocuteur</th>
                <th>Edition</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($formations as $formation)
                <tr class="liste-formations">
                    <td>{{ $formation->organisme }}</td>
                    <td>{{ $formation->telephone }}</td>
                    <td>{{ $formation->email }}</td>
                    <td>{{ $formation->numero_declaration_existence }}</td>
                    <td>{{ $formation->siret }}</td>
                    <td>{{ $formation->adresse }}</td>
                    <td>{{ $formation->interlocuteur }}</td>
                    <td>
                        <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-edit btn-sm mr-2">
                            Modifier
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('formations.show', $formation->id) }}" class="btn btn-delete btn-sm">
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
