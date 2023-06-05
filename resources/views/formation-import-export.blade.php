<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formation Import et Export</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
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
    <div class="card bg-light mt-3">
        <a href="/" class="btn btn-primary">Retour à l'accueil</a>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-3">
                {{ session('status') }}
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

            <form id="formToutes" action="{{ route('plan-import') }}" style="display: none" method="POST"
                  enctype="multipart/form-data">
                <em>Note : l'import du plan peut prendre une trentaine de secondes</em>
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" >
                    Import Plan
                </button>
                <hr />
            </form>

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
