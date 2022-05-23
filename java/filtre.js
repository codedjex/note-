var filtres = {}

function definir(filtre, valeur) {
    // filtre et valeur = famille, corde frappées par exemple
    filtres[filtre] = valeur;
    // la var filtres va incrementer corde frappées dans famille
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
        // switch=on met la valeur qu'on veux tester (recherche.value) et ca nous sors tous les résultats
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
    // permet de vider la barre après la recherche
}

async function actualiser() {
    // async= permet un fonctionnement hors timelapse
    let reponse = await fetch('PHP/filtres.php', {
        // reponse = au resultat de la recheche de fetch dans filtres.php
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
            // a mettre quand tu envoie en JSON, plus rapide il parait.
        },
        body: JSON.stringify(filtres)
        // on envoit a la page filtre.php la var filtres transformés en JSON
    });

    if (reponse.ok) {
        let resultat = await reponse.json();
        afficher(resultat)
    } else {
        alert("HTTP-Error : " + reponse.status);
    }
}

function afficher(donnees) {
    if (document.documentElement.clientWidth < 1024) {
        window.scrollTo(0, document.documentElement.clientHeight - 157);
    } else {
        window.scrollTo(0, document.documentElement.clientHeight - 100);
    }
    // Construction de la grille de produits :
    document.getElementById('bloc-grille').innerHTML = '';
    for (let instrument of donnees) {
        let duree = Math.floor(Math.random() * 1000);
        document.getElementById('bloc-grille').innerHTML += `<a href="page-produit.php?ID=${instrument.ID}">
                                                                 <figure style="background-image: url(picture/${instrument.Image}); animation: attente ${duree}ms, fondue 3000ms ${duree}ms;">
                                                                     <figcaption><p>${instrument.Nom}</p></figcaption>
                                                                 </figure>
                                                             </a>`
    }

    // Remplacement des catégories par les produits :
    document.getElementById('grille').style.transform = 'translateX(0)';
    document.getElementById('grille').style.position = 'static';
    document.getElementById('tableau-categories').style.transform = 'translateX(-100%)';
    document.getElementById('tableau-categories').style.position = 'absolute';
}