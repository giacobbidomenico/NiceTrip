"use strict";

let index = 0;
/*
 sequenza ordine: 
    - richiesta id post da visualizzare
    - riempimento feed con numero limitato di post
    - alla rilevazione della fine dello scrolling aggiungere contenuto al feed
        > evento:
            window.innerHeight + window.scrollY >= document.getElementById("mainArticle").offsetHeight + document.getElementById("mainArticle").scrollTop
    ? scroll verso l'alto ricarica la pagina
    - alla visualizzazione di un post bisogna aggiornare il databse (entry che indichi che l'utente ha visualizzato il post)
 */

document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"><div>`;

//posts id request
axios.post('api-post-id-list.php', {}).then(response => {
    let ids = response;
    fillFeed(ids);
    window.addEventListener("scroll", event => fillFeed(ids));
});



// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight + window.scrollY >= document.getElementById("mainArticle").offsetHeight + document.getElementById("mainArticle").scrollTop;
}

// adds a limited number of posts in mainArticle section
function fillFeed(ids) {
    if (isBottomReached() && index < ids.data.length) {
        for (let i = 0; i < 10 && i < ids.data.length; i++) {
            let post = requestPostDetails(ids.data[index].id);
            index++;
        }
    }
}