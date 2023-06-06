<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout d'une nouvelle formation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <a class="navbar-brand" href="/">Gestion de formation</a>
</nav>
<div class="container flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="text-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <h2>L'Organisme de formation</h2>
                <a class="btn btn-primary" onclick="history.back()">Retour</a>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('formations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="organisme"><strong>Nom de l'organisme de formation :</strong></label>
                        <input id="organisme" type="text" name="organisme" class="form-control" placeholder="organisme de formation">
                        @error('organisme')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="telephone"><strong>Coordonnée téléphonique :</strong></label>
                        <input id="telephone" type="text" name="telephone" class="form-control" placeholder="coordonnée téléphonique">
                        @error('telephone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="email"><strong>Adresse email :</strong></label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="adresse email">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="numero_declaration_existence"><strong>Numéro déclaration existence :</strong></label>
                        <input id="numero_declaration_existence" type="text" name="numero_declaration_existence" class="form-control" placeholder="numéro déclaration existence">
                        @error('numero_declaration_existence')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="siret"><strong>Numéro de SIRET :</strong></label>
                        <input id="siret" type="number" name="siret" class="form-control" placeholder="numéro de siret">
                        @error('siret')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="adresse"><strong>Adresse :</strong></label>
                        <input id="adresse" type="text" name="adresse" class="form-control" placeholder="adresse">
                        @error('adresse')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="interlocuteur"><strong>Interlocuteur :</strong></label>
                        <input id="interlocuteur" type="text" name="interlocuteur" class="form-control" placeholder="interlocuteur">
                        @error('interlocuteur')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success ml-3">Valider</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
