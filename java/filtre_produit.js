function definir(filtre, valeur) {
    window.location.href = `index.php?action=definir;filtre=${filtre};valeur=${valeur}`;
}

function retirer(filtre) {
    window.location.href = `index.php`;
}

function filtrer_recherche() {
    valeur = document.getElementById('recherche').innerText;
    window.location.href = `index.php?action=filtrer_recherche;valeur=${valeur}`;
}