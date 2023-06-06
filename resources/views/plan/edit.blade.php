<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- Inclure jQuery et jQuery UI Autocomplete -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<script>
    const duree = {!! $plan->stage->duree ?? 0 !!};
    let nombre_stagiaires = {!! $plan->nombre_stagiaires !!};

    $(document).ready(function() {
        // Récupérer la liste des salariés pour la suggestion
        const salaries = {!! $salaries !!};

        // Initialiser l'autocomplétion sur le champ d'entrée des matricules
        $('input[name^="matricule"]').autocomplete({
            source: salaries,
        });
    });
</script>
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
<div class="container flex-grow-1 d-flex justify-content-center">
    <div class="text-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <h2>La gestion du plan</h2>
                <a class="btn btn-primary" href="/">Accueil</a>
                <a class="btn btn-primary" onclick="history.back()">Retour</a>
            </div>
        </div>
        <button class="btn btn-primary mb-1 mt-1" onclick='addMultipleForms(10, {!! $salaries !!})'>+10</button>
        <button class="btn btn-primary mb-1 mt-1" onclick='addForm({!! $salaries !!})'>Ajouter un salarié</button>
        <button class="btn btn-primary mb-1 mt-1" onclick='removeLastForm()'>Supprimer le dernier salarié ajouté</button>
        <button class="btn btn-primary mb-1 mt-1" onclick='removeMultipleForms(10)'>-10</button><br>
        <em id="compteur">Nombre de salarié : {{ $plan->nombre_stagiaires }}</em>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        @if($fromCreation)
            <div class="alert alert-info">Stage déjà existant dans le plan, passage de la création à l'édition</div>
        @endif
        <form action="{{ route('plan.update', $plan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="form-container" class="text-center">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <input type="hidden" name="nombre_stagiaires" value="{{ intval($plan->nombre_stagiaires) }}" id="nombre_stagiaires">
                    <input type="hidden" name="session" value="{{ $plan->stage->session }}">
                    <div class="form-group">
                        <strong>Intitulé du stage :</strong>
                        <input type="text" name="intitule" id="validation" class="form-control" placeholder="intitulé du stage" value="{{ $plan->stage->intitule }}" onkeydown="return false;" required>
                        <a href="{{ route('stages.index') }}">Liste des stages</a>
                    </div>
                    @if($plan->stage->duree)
                        <em>Durée du stage : {{ $plan->stage->duree }} heures</em>
                    @endif
                </div>
                @foreach($plan->salaries as $salarie)
                    <div class="row" id="form-stagiaire">
                        <div class="form-group">
                            <strong>Nom prénom Salarié :</strong>
                            <input type="text" name="matricule[]" class="form-control @error('matricule.*') is-invalid @enderror" placeholder="nom prénom salarié" value="{{ $salarie->nom . ' ' . $salarie->prenom . ' [' . $salarie->matricule . ']' }}" required>
                            @error('matricule.*')
                            <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Nombre d'heures réalisées :</strong>
                            <input type="number" name="nombre_heures_realisees[]" class="form-control @error('nombre_heures_realisees.*') is-invalid @enderror" placeholder="nombre d'heures réalisées" value="{{ $salarie->pivot->nombre_heures_realisees }}" required>
                            @error('nombre_heures_realisees.*')
                            <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Transport :</strong>
                            <input type="number" step="0.01" name="transport[]" class="form-control @error('transport.*') is-invalid @enderror" placeholder="transport" value="{{ $salarie->pivot->transport }}" required>
                            @error('transport.*')
                            <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Hébergement :</strong>
                            <input type="number" step="0.01" name="hebergement[]" class="form-control @error('hebergement.*') is-invalid @enderror" placeholder="hébergement" value="{{ $salarie->pivot->hebergement }}" required>
                            @error('hebergement.*')
                            <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Restauration :</strong>
                            <input type="number" step="0.01" name="restauration[]" class="form-control @error('restauration.*') is-invalid @enderror" placeholder="restauration" value="{{ $salarie->pivot->restauration }}" required>
                            @error('restauration.*')
                            <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success ml-3">Valider</button>
        </form>
    </div>
</div>
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
