<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout d'un stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <!-- Logo et lien vers l'accueil -->
    <a class="navbar-brand" href="/">Gestion de formation</a>
</nav>

<div class="container flex-grow-1 d-flex justify-content-center">
    <div class="text-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <h2>Création d'un stage</h2>
                <a class="btn btn-primary" href="/"> Retour</a>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('stages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <em>Dernier numéro de session référencé : {{$session}}</em><br>
                        <strong>Numéro de session du stage :</strong>
                        <input type="text" name="session" class="form-control" placeholder="numéro de session du stage" value="{{$session+1}}">
                        @error('session')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Intitulé du stage :</strong>
                        <input type="text" name="intitule" class="form-control" placeholder="intitulé du stage">
                        @error('intitule')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Numéro de stage :</strong>
                        <input type="text" name="numero" class="form-control" placeholder="numéro de stage">
                        @error('numero')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Organisme de formation :</strong>
                        <label for="searchbar"></label>
                        <input id="searchbar" onkeyup="recherche_formation()" type="text"
                               name="organisme" class="form-control" placeholder="organisme de formation">
                        @error('organisme')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        <a href="{{route("formations.create")}}">elle n'existe pas ?</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Formation obligatoire ? :</strong>
                        <input type="radio" id="oui" name="formation_obligatoire" value="O" checked>
                        <label for="oui">Oui</label>
                        <input type="radio" id="non" name="formation_obligatoire" value="N">
                        <label for="non">Non</label>
                        @error('formation_obligatoire')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Intra ou Inter ? :</strong>
                        <input type="radio" id="intra" name="intra_inter" value="A" checked>
                        <label for="intra">Intra</label>
                        <input type="radio" id="inter" name="intra_inter" value="R">
                        <label for="inter">Inter</label>
                        @error('intra_inter')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Coût pédagogique :</strong>
                        <input type="text" name="cout_pedagogique" class="form-control" placeholder="coût pedagogique">
                        @error('cout_pedagogique')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date de début de formation :</strong>
                        <input type="date" name="debut_formation" class="form-control" placeholder="date de début de formation">
                        @error('debut_formation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date de fin de formation :</strong>
                        <input type="date" name="fin_formation" class="form-control" placeholder="date de fin de formation">
                        @error('fin_formation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Durée de formation :</strong>
                        <input type="text" name="duree" class="form-control" placeholder="durée de formation">
                        @error('duree')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Prise en charge OPCO Santé ? :</strong>
                        <input type="radio" id="opcoOui" name="opco" value="O" checked>
                        <label for="opcoOui">Oui</label>
                        <input type="radio" id="opcoNon" name="opco" value="N">
                        <label for="opcoNon">Non</label>
                        @error('opco')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Convention de formation ? :</strong>
                        <input type="radio" id="conventionOui" name="convention" value="O" checked>
                        <label for="conventionOui">Oui</label>
                        <input type="radio" id="conventionNon" name="convention" value="N">
                        <label for="conventionNon">Non</label>
                        @error('convention')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Convocation ? :</strong>
                        <input type="radio" id="convocationOui" name="convocation" value="O" checked>
                        <label for="convocationOui">Oui</label>
                        <input type="radio" id="convocationNon" name="convocation" value="N">
                        <label for="convocationNon">Non</label>
                        @error('convocation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Attestation ? :</strong>
                        <input type="radio" id="attestationOui" name="attestation" value="O" checked>
                        <label for="attestationOui">Oui</label>
                        <input type="radio" id="attestationNon" name="attestation" value="N">
                        <label for="attestationNon">Non</label>
                        @error('attestation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facture ? :</strong>
                        <input type="radio" id="factureOui" name="facture" value="O" checked>
                        <label for="factureOui">Oui</label>
                        <input type="radio" id="factureNon" name="facture" value="N">
                        <label for="factureNon">Non</label>
                        @error('facture')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Valider</button>
            </div>
        </form>
    </div>
    <!-- liste des formations -->
    <ol>
        @foreach($formations as $formation)
            <div class="d-flex align-items-center">
                <li class="formations">{{$formation->organisme}}</li>
                <button id="finger-icon" onclick="changerValeur(`{{$formation->organisme}}`)"><i class="bi bi-arrow-left"></i></button>
            </div>
        @endforeach
    </ol>
</div>
<!-- liaison javascript -->
<script src="{{asset('formations.js')}}"></script>
</body>
</html>
