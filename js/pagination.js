var pages = document.getElementsByClassName('ligne');
var links = document.getElementsByClassName('page-item');
hideAll();
pagination(1);

function pagination(index) {
    hideAll();
    pages[index - 1].hidden = false;
    activeLink(index);
}

function hideAll() {
    for (i = 0; i < pages.length; i++) {
        pages[i].hidden = true;
    }
}

function activeLink(index) {
    for (i = 0; i < links.length; i++) {
        links[i].setAttribute('class', 'page-item');
    }
    links[index - 1].setAttribute('class', 'page-item active');
}