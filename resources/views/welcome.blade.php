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
        <form class="ml-auto" method="POST" action="{{ url('/update-charges-patronales') }}">
            @csrf
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="color: black">
                        <strong>Charges patronales :</strong>
                    </span>
                </div>
                <input type="number" step="0.01" name="charges_patronales" placeholder="charges patronales" value="{{ Illuminate\Support\Facades\Cache::get('charges_patronales') }}" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
            </div>
        </form>
    </nav>
    <div class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="text-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success mb-5 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="text-center mb-5">Bienvenue dans la gestion des formations</h1>
            <div class="d-flex justify-content-center">
                <div class="col-md-6 justify-content-between">
                    <a href="{{route('formations.create')}}" class="btn btn-info btn-lg mb-4" role="button">Gestion des Organismes de formations</a>
                    <a href="{{route('stages.index')}}" class="btn btn-primary btn-lg mb-4 mr-1" role="button">Gestion du Plan</a>
                    <a href="{{route('stages.create')}}" class="btn btn-info btn-lg mb-4 ml-1" role="button">Gestion des Stages</a>
                    <a href="/file-import-export" class="btn btn-secondary btn-lg" role="button">Gestion de l'exportation et l'importation</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
