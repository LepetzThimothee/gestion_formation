<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Formation Import et Export</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
</head>

<script type="text/javascript">
    function ShowHideForm() {
        var chkFormation = document.getElementById("chkFormation");
        var chkStage = document.getElementById("chkStage");
        var chkSalaries = document.getElementById("chkSalaries");
        var chkToutes = document.getElementById("chkToutes");
        var formFormation = document.getElementById("formFormation");
        var formStage = document.getElementById("formStage");
        var formSalaries = document.getElementById("formSalaries");
        var formToutes = document.getElementById("formToutes");
        formFormation.style.display = chkFormation.checked ? "block" : "none";
        formStage.style.display = chkStage.checked ? "block" : "none";
        formSalaries.style.display = chkSalaries.checked ? "block" : "none";
        formToutes.style.display = chkToutes.checked ? "block" : "none";
    }
</script>
<body>
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
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
                Toutes
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

            <form id="formToutes" action="{{ route('bergerie-import') }}" style="display: none" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" >
                    Import Bergerie
                </button>
                <hr />
            </form>

            <a class="btn btn-warning" href="{{ route('formation-export') }}">
                Export Formation
            </a>
            <a class="btn btn-warning" href="{{ route('stage-export') }}">
                Export Stage
            </a>
            <a class="btn btn-warning" href="{{ route('salarie-export') }}">
                Export Salaries
            </a>
            <a class="btn btn-warning" href="{{ route('bergerie-export') }}">
                Export Bergerie
            </a>
        </div>
    </div>
</div>

</body>

</html>
