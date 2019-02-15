
//Initialisation des variables qui contiennent les div contenant les recettes
var pages = document.getElementsByClassName('ligne');
var links = document.getElementsByClassName('page-item');

/**
 * Cette fonction permet de gérer l'affichage des pages, en cachant les div qui ne doivent pas être affichées
 * @param index Numéro de la page actuelle
 */
function pagination(index) {
    hideAll();
    pages[index - 1].hidden = false;
    activeLink(index);
}

/**
 * Cache TOUTES les div contenant des recettes
 */
function hideAll() {
    for (i = 0; i < pages.length; i++) {
        pages[i].hidden = true;
    }
}

/**
 * Gestion des boutons de pagination. Ajoute la classe active sur le bouton correspondant à la page actuelle
 * @param index Numéro de la page actuelle
 */
function activeLink(index) {
    for (i = 0; i < links.length; i++) {
        links[i].setAttribute('class', 'page-item');
    }
    links[index - 1].setAttribute('class', 'page-item active');
}

//appel des fonctions
hideAll();
pagination(1);