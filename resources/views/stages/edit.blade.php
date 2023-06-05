<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification d'un stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
</nav>

<div class="d-flex justify-content-center align-items-start">
    <div class="text-center mr-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <h2>Modification d'un stage</h2>
                <a class="btn btn-primary" onclick="history.back()">Retour</a>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('stages.update', $stage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="text-center">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Numéro de session du stage :</strong>
                        <input type="text" name="session" class="form-control" placeholder="numéro de session du stage" value="{{ $stage->session }}">
                        @error('session')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Intitulé du stage :</strong>
                        <input type="text" name="intitule" class="form-control" placeholder="intitulé du stage" value="{{ $stage->intitule }}">
                        @error('intitule')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Organisme de formation :</strong>
                        <input type="text" name="organisme" id="validation" class="form-control" placeholder="organisme de formation" onkeydown="return false;" value="{{ $stage->organisme }}">
                        @error('organisme')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        <a href="{{route("formations.create")}}">elle n'existe pas ?</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Formation obligatoire ? :</strong>
                        <input type="radio" id="oui" name="formation_obligatoire" value="O" {{ $stage->formation_obligatoire == 'O' ? 'checked' : '' }}>
                        <label for="oui">Oui</label>
                        <input type="radio" id="non" name="formation_obligatoire" value="N" {{ $stage->formation_obligatoire == 'N' ? 'checked' : '' }}>
                        <label for="non">Non</label>
                        @error('formation_obligatoire')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Intra ou Inter ? :</strong>
                        <input type="radio" id="intra" name="intra_inter" value="A" {{ $stage->intra_inter == 'A' ? 'checked' : '' }}>
                        <label for="intra">Intra</label>
                        <input type="radio" id="inter" name="intra_inter" value="R" {{ $stage->intra_inter == 'R' ? 'checked' : '' }}>
                        <label for="inter">Inter</label>
                        @error('intra_inter')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Coût pédagogique :</strong>
                        <input type="text" name="cout_pedagogique" class="form-control" placeholder="coût pedagogique" value="{{ $stage->cout_pedagogique }}">
                        @error('cout_pedagogique')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date de début de formation :</strong>
                        <input type="date" name="debut_formation" class="form-control" placeholder="date de début de formation" value="{{ date('Y-m-d', strtotime($stage->debut_formation)) }}">
                        @error('debut_formation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date de fin de formation :</strong>
                        <input type="date" name="fin_formation" class="form-control" placeholder="date de fin de formation" value="{{ $stage->fin_formation ? date('Y-m-d', strtotime($stage->fin_formation)) : '' }}">                        @error('fin_formation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Durée de formation :</strong>
                        <input type="text" name="duree" class="form-control" placeholder="durée de formation" value="{{ $stage->duree }}">
                        @error('duree')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Prise en charge OPCO Santé ? :</strong>
                        <input type="radio" id="opcoOui" name="opco" value="O" {{ $stage->opco == 'O' ? 'checked' : '' }}>
                        <label for="opcoOui">Oui</label>
                        <input type="radio" id="opcoNon" name="opco" value="N" {{ $stage->opco == 'N' ? 'checked' : '' }}>
                        <label for="opcoNon">Non</label>
                        @error('opco')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Convention de formation ? :</strong>
                        <input type="radio" id="conventionOui" name="convention" value="O" {{ $stage->convention == 'O' ? 'checked' : '' }}>
                        <label for="conventionOui">Oui</label>
                        <input type="radio" id="conventionNon" name="convention" value="N" {{ $stage->convention == 'N' ? 'checked' : '' }}>
                        <label for="conventionNon">Non</label>
                        @error('convention')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Convocation ? :</strong>
                        <input type="radio" id="convocationOui" name="convocation" value="O" {{ $stage->convocation == 'O' ? 'checked' : '' }}>
                        <label for="convocationOui">Oui</label>
                        <input type="radio" id="convocationNon" name="convocation" value="N" {{ $stage->convocation == 'N' ? 'checked' : '' }}>
                        <label for="convocationNon">Non</label>
                        @error('convocation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Attestation ? :</strong>
                        <input type="radio" id="attestationOui" name="attestation" value="O" {{ $stage->attestation == 'O' ? 'checked' : '' }}>
                        <label for="attestationOui">Oui</label>
                        <input type="radio" id="attestationNon" name="attestation" value="N" {{ $stage->attestation == 'N' ? 'checked' : '' }}>
                        <label for="attestationNon">Non</label>
                        @error('attestation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facture ? :</strong>
                        <input type="radio" id="factureOui" name="facture" value="O" {{ $stage->facture == 'O' ? 'checked' : '' }}>
                        <label for="factureOui">Oui</label>
                        <input type="radio" id="factureNon" name="facture" value="N" {{ $stage->facture == 'N' ? 'checked' : '' }}>
                        <label for="factureNon">Non</label>
                        @error('facture')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </form>
    </div>

    <div>
        <h3>Liste des formations</h3>
        <div class="mb-2">
            <p class="text-center mb-1">Note: chercher l'organisme de formation que vous souhaitez</p>
            <p class="text-center mb-0">Cliquez sur celui-ci pour le référencer dans le formulaire</p>
        </div>
        <input id="searchbar" onkeyup="recherche()" type="text" class="form-control mb-3" placeholder="Rechercher une formation">
        <div class="scrollable-list" style="max-height: 900px; overflow-y: auto;">
            <ul class="list-group" style="width: 450px;">
                @foreach($formations as $formation)
                    <li class="list-group-item formations" onclick='changerValeur("{{ $formation->organisme }}")'>{{ $formation->organisme }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
