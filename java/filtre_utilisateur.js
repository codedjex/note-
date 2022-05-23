var filtres = {}

function definir(filtre, valeur) {
    filtres[filtre] = valeur;
    document.getElementById('bouton-menu-filtre').checked = false;
    document.querySelector(`#${filtre}-${valeur}`).checked = true;
    actualiser();
}

function retirer(filtre) {
    delete filtres[filtre];
    document.getElementById('bouton-menu-filtre').checked = false;
    actualiser();
}

function filtrer_recherche() {
    recherche = document.getElementById('recherche');
    switch (recherche.value) {
        case 'Cordes frottées':
            definir('famille', 'cordes-frottees');
            break;
        case 'Cordes pincées':
            definir('famille', 'cordes-pincees');
            break;
        case 'Cordes frappées':
            definir('famille', 'cordes-frappees');
            break;
        case 'Bois':
            definir('famille', 'vents-bois');
            break;
        case 'Cuivres':
            definir('famille', 'vents-cuivres');
            break;
        case 'Percussions à claviers':
            definir('famille', 'percussions-claviers');
            break;
        case 'Percussions à peaux':
            definir('famille', 'percussions-peaux');
            break;
        case 'Accessoires':
            definir('famille', 'percussions-accessoires');
            break;
        case 'Fanfare':
            definir('formation', 'fanfare');
            break;
        case 'Big band':
            definir('formation', 'big-band');
            break;
        case 'Harmonie':
            definir('formation', 'harmonie');
            break;
        case 'Groupe de rock':
            definir('formation', 'groupe-de-rock');
            break;
        case 'Orchestre de chambre':
            definir('formation', 'orchestre-de-chambre');
            break;
        case 'Orchestre symphonique':
            definir('formation', 'orchestre-symphonique');
            break;
    }
    recherche.value = "";
}

async function actualiser() {
    let reponse = await fetch('PHP/filtres_utilisateur.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(filtres)
    });

    if (reponse.ok) {
        let resultat = await reponse.json();
        afficher(resultat)
    } else {
        alert("HTTP-Error : " + reponse.status);
    }
}

function afficher(donnees) {
    window.scrollTo(0, 0 + document.getElementById('form-ajouter').offsetHeight);
    // Construction de la grille de produits :
    document.getElementById('bloc-grille').innerHTML = donnees;
}