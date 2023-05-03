function recherche_formation() {
    let input = document.getElementById('searchbar').value //récupère la valeur de l'élement qui possède l'id : "searchbar"
    input=input.toLowerCase() // permet de mettre toute la chaine de caractère en minuscule
        .trim() //permet de retirer les espaces au début et fin de la chaine de caractère
        .replace(/[^\w\s-/+*]/g, '')  //remplace tout sauf les lettres, chiffres, espaces et les caractères - / + * en chaine de caractère vide
        .replace(/^-+|-+$/g, ''); //remplace les tirets au debut et fin de la chaine de caractères en une vide
    let formations = document.getElementsByClassName('formations');
    let curseurs = document.getElementsByClassName('bi bi-arrow-left');

    for (i = 0; i < formations.length; i++) {
        if (!formations[i].innerHTML.toLowerCase().trim().replace(/[^\w\s-/+*]/g, '').replace(/^-+|-+$/g, '')
            .includes(input)) {
            formations[i].style.display="none";
            curseurs[i].style.display="none";
        }
        else {
            formations[i].style.display="list-item";
            curseurs[i].style.display="";
        }
    }
}

function changerValeur(valeur) {
    document.getElementById("searchbar").value = valeur;
}
