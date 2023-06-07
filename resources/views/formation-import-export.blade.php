<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formation Import et Export</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<!-- Fonction JavaScript pour afficher/masquer les formulaires en fonction de la sélection -->
<script type="text/javascript">
    function ShowHideForm() {
        const chkFormation = document.getElementById("chkFormation");
        const chkStage = document.getElementById("chkStage");
        const chkSalaries = document.getElementById("chkSalaries");
        const chkToutes = document.getElementById("chkToutes");
        const formFormation = document.getElementById("formFormation");
        const formStage = document.getElementById("formStage");
        const formSalaries = document.getElementById("formSalaries");
        const formToutes = document.getElementById("formToutes");
        formFormation.style.display = chkFormation.checked ? "block" : "none";
        formStage.style.display = chkStage.checked ? "block" : "none";
        formSalaries.style.display = chkSalaries.checked ? "block" : "none";
        formToutes.style.display = chkToutes.checked ? "block" : "none";
    }
</script>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #1e285d">
    <a class="navbar-brand" href="/">Gestion de formation</a>
    <!-- Formulaire pour la mise à jour des charges patronales -->
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
<!-- Contenu principal de la page -->
<div class="container flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="card bg-light mt-3">
        <a href="/" class="btn btn-primary">Retour à l'accueil</a>
        <!-- Affichage du message de succès ou d'erreur s'il est présent -->
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-3">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-1 mt-3">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-header mt-3">
            Import et Export en .xlsx
        </div>
        <div class="card-body">
            <span>Quel table importer ?</span><br>
            <label for="chkFormation">
                <input type="radio" id="chkFormation" name="chkFormulaire" onclick="ShowHideForm()" checked/>
                Organismes de formation
            </label>
            <label for="chkStage">
                <input type="radio" id="chkStage" name="chkFormulaire" onclick="ShowHideForm()" />
                Stage
            </label>
            <label for="chkSalaries">
                <input type="radio" id="chkSalaries" name="chkFormulaire" onclick="ShowHideForm()" />
                Salariés
            </label>
            <label for="chkToutes">
                <input type="radio" id="chkToutes" name="chkFormulaire" onclick="ShowHideForm()" />
                Plan
            </label>
            <hr />

            <!-- Formulaire d'importation de la table "Organismes de formation" -->
            <form id="formFormation" action="{{ route('formation-import') }}" style="display: none" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" >
                    Import Formation
                </button>
                <hr />
            </form>

            <!-- Formulaire d'importation de la table "Stage" -->
            <form id="formStage" action="{{ route('stage-import') }}" style="display: none" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" >
                    Import Stage
                </button>
                <hr />
            </form>

            <!-- Formulaire d'importation de la table "Salariés" -->
            <form id="formSalaries" action="{{ route('salarie-import') }}" style="display: none" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" >
                    Import Salaries
                </button>
                <hr />
            </form>

            <!-- Formulaire d'importation du "Plan" (avec informations supplémentaires) -->
            <form id="formToutes" action="{{ route('plan-import') }}" style="display: none" method="POST"
                  enctype="multipart/form-data">
                <div class="mb-2">
                    <p class="text-center mb-1">Note : A l'importation du plan, on importe les trois autres tables.</p>
                    <p class="text-center mb-0">L'import du plan peut prendre une trentaine de secondes</p>
                </div>
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" >
                    Import Plan
                </button>
                <hr />
            </form>

            <!-- Liens d'exportation -->
            <a class="btn btn-info" href="{{ route('formation-export') }}">
                Export Formation
            </a>
            <a class="btn btn-info" href="{{ route('stage-export') }}">
                Export Stage
            </a>
            <a class="btn btn-info" href="{{ route('salarie-export') }}">
                Export Salaries
            </a>
            <a class="btn btn-info" href="{{ route('plan-export') }}">
                Tout Exporter
            </a>
        </div>
    </div>
</div>
</body>
</html>
