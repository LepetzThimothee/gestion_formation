<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de formation</title>
    <!-- fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
        <!-- Logo et lien vers l'accueil -->
        <a class="navbar-brand" href="/">Gestion de formation</a>
    </nav>
    <div class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="text-center">
            @if(session('status'))
                <div class="alert alert-success mb-5 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="text-center mb-5">Bienvenue dans la gestion des formations</h1>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="{{route('formations.create')}}" class="btn btn-primary btn-lg" role="button">Gestion des Organismes de formations</a>
                </div>
                <div class="col-md-4">
                    <a href="{{route('stages.create')}}" class="btn btn-secondary btn-lg" role="button">Gestion des Stages</a>
                </div>
                <div class="col-md-4">
                    <a href="/file-import-export" class="btn btn-info btn-lg" role="button">Gestion de l'exportation et l'importation</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
