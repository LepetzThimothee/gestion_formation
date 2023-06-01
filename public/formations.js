function recherche(cell = []) {
    let input = document.getElementById('searchbar').value; //récupère la valeur de l'élément qui possède l'id : "searchbar"
    input = input.toLowerCase() //permet de mettre toute la chaîne de caractères en minuscule
        .trim() //permet de retirer les espaces au début et à la fin de la chaîne de caractères
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "") //permet de remplacer les lettres avec accent par leur équivalent sans accent
        .replace(/[^\w\s-/+*]/g, ''); //remplace tout sauf les lettres, chiffres, espaces et les caractères - / + * en chaîne de caractères vide

    let formations = document.getElementsByClassName('formations');
    for (let i = 0; i < formations.length; i++) {
        if (!formations[i].innerHTML.toLowerCase().trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^\w\s-/+*]/g, '')
            .includes(input)) {
            formations[i].style.display="none";
        }
        else {
            formations[i].style.display="";
        }
    }

    let stages = document.getElementsByClassName(cell[0]);
    for (let i = 0; i < stages.length; i++) {
        if (!stages[i].cells[cell[1]].innerHTML.toLowerCase().trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^\w\s-/+*]/g, '')
            .includes(input)) {
            stages[i].style.display="none";
        }
        else {
            stages[i].style.display="";
        }
    }
}

function changerValeur(valeur) {
    document.getElementById("validation").value = valeur;
}



// On récupère les éléments HTML que l'on a besoin
const formContainer = document.getElementById('form-container');

// On initialise un compteur de formulaires
let nombre_stagiaires = 1;


function addForm(salaries) {
    // On clone le premier élément de formulaire référencé par la classe row de Bootstrap
    let originalForm = document.querySelector('#form-stagiaire');
    let newForm = originalForm.cloneNode(true);

    // On efface les valeurs des balises input que l'on a cloné
    let inputs = newForm.querySelectorAll('input');
    inputs.forEach((input) => {
        if (input.name === "nombre_heures_realisees[]") input.value = duree;
        else if (input.name === "transport[]" || input.name === "hebergement[]" || input.name === "restauration[]") input.value = 0;
        else input.value = "";
    });

    // Et enfin on ajoute le nouveau formulaire
    let formContainer = document.getElementById('form-container');
    formContainer.appendChild(newForm);

    // On incrémente le compteur de formulaires
    nombre_stagiaires++;
    document.getElementById("compteur").textContent = "Nombre de salariés : " + nombre_stagiaires // On actualise l'affichage
    document.getElementById("nombre_stagiaires").value = getNombreStagiaires();

    // On initialise l'autocomplétion sur le nouveau formulaire
    let matriculeInput = newForm.querySelector('input[name^="matricule"]');
    $(matriculeInput).autocomplete({
        source: salaries,
    });
}

function removeLastForm() {
    // On vérifie s'il existe plus d'un formulaire
    if (nombre_stagiaires > 1) {
        // On récupère tous les formulaires et on supprime le dernier
        const forms = formContainer.getElementsByClassName('row');
        const lastForm = forms[forms.length - 1];
        formContainer.removeChild(lastForm);

        // On décrémente le compteur de formulaires
        nombre_stagiaires--;
        document.getElementById("compteur").textContent = "Nombre de salariés : " + nombre_stagiaires // On actualise l'affichage
        document.getElementById("nombre_stagiaires").value = getNombreStagiaires();
    }
}

function getNombreStagiaires() {
    return nombre_stagiaires;
}

function redirectToPlanCreate(row) {
    const session = row.cells[0].innerText; //On prend le numero de session du stage qui se trouve à l'index 0 de la ligne que l'on a cliquée
    window.location.href = "/plan/create?session=" + session; //Et on redirige vers notre route avec le numero de session
}

function setValidationMessage() {
    const input = document.getElementById("validation");
    const message = "Veuillez choisir un élément dans la liste ci-contre.";

    if (input) {
        if (!input.validity.valid) {
            input.setCustomValidity(message);
            input.title = message;
        }
    }
}

setValidationMessage();

function filtrerPlans(codeEtablissement, annee) {
    const codeEtablissementBouton = document.querySelector('.code-etablissement-selectionne');
    codeEtablissementBouton.textContent = 'Sélection établissement : ' + codeEtablissement;

    const anneeBouton = document.querySelector('.annee-selectionne');
    anneeBouton.textContent = 'Sélection année : ' + annee;

    let recherche = document.getElementById('searchbar').value.toLowerCase().trim();
    const plans = document.querySelectorAll('.formations');
    let totalTotaux = 0;

    plans.forEach(function(plan) {
        const salaries = plan.querySelectorAll('tbody tr');
        let planVisible = false;

        const debutFormation = plan.querySelector('.debut-formation').textContent.trim();
        const anneeDebutFormation = debutFormation.substring(debutFormation.length - 4);

        const finFormation = plan.querySelector('.fin-formation').textContent.trim();
        const anneeFinFormation = finFormation.substring(finFormation.length - 4);

        salaries.forEach(function(salarie) {
            const codeEtablissementCell = salarie.querySelector('td:nth-child(2)');

            if ((codeEtablissement === 'Aucun' || codeEtablissementCell.textContent.trim() === codeEtablissement) &&
                (anneeDebutFormation <= annee && annee <= anneeFinFormation)) {
                planVisible = true;
                salarie.style.display = 'table-row';
                totalTotaux += parseFloat(salarie.querySelector('td:last-child').textContent);
            } else {
                salarie.style.display = 'none';
            }
        });

        if (planVisible) {
            let planContent = plan.textContent.toLowerCase();
            let correspondRecherche = planContent.includes(recherche);

            if (correspondRecherche) {
                plan.style.display = 'block';
            } else {
                plan.style.display = 'none';
            }
        } else {
            plan.style.display = 'none';
        }
    });

    const totalTotauxElement = document.querySelector('.total-totaux');
    totalTotauxElement.textContent = 'Total général : ' + totalTotaux.toFixed(2);
}

function recherchePlan() {
    const codeEtablissementBouton = document.querySelector('.code-etablissement-selectionne');
    const codeEtablissement = codeEtablissementBouton.textContent.trim().split(': ')[1];

    const anneeBouton = document.querySelector('.annee-selectionne');
    const annee = anneeBouton.textContent.trim().split(': ')[1];

    filtrerPlans(codeEtablissement, annee);
}
