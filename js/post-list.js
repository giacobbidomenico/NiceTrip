"use strict";

let ids;
let index = 0;
/*
 sequenza ordine: 
    - richiesta id post da visualizzare
    - riempimento feed con numero limitato di post
    - alla rilevazione della fine dello scrolling aggiungere contenuto al feed
    ? scroll verso l'alto ricarica la pagina
 */


axios.post('api-post-id-list.php', {}).then(response => {
    ids = response;
    fillFeed();
});

// adds a limited number of posts in mainArticle section
function fillFeed() {
}

// returns details of a given post
function requestPostDetails() {

}

// returns images of a given post
function requestPostImages() {

}

// returns details of an author
function requestAuthorDetails() {

}