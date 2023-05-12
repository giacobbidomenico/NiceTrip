"use strict";

let ids;
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


axios.post('api-post-id-list.php', {}).then(response => {
    ids = response;
    fillFeed();
});

window.addEventListener("scroll", event => fillFeed());

// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight + window.scrollY >= document.getElementById("mainArticle").offsetHeight + document.getElementById("mainArticle").scrollTop;
}

// adds a limited number of posts in mainArticle section
function fillFeed() {
    if (isBottomReached()) {
        requestPostDetails(ids.data[0].id);
        requestAuthorDetails(ids.data[0].id);
        requestPostImages(ids.data[0].id);
    }
}

// returns details of a given post
function requestPostDetails(postId) {
    const formData = new FormData();
    formData.append('postId', postId);
    axios.post('api-post-details.php', formData).then(response => {
        console.log(response);
    });
}

// returns images of a given post
function requestPostImages(postId) {
    const formData = new FormData();
    formData.append('postId', postId);
    axios.post('api-post-details.php', formData).then(response => {
        console.log(response);
    });
}

// returns details of an author
function requestAuthorDetails(follow) {
    const formData = new FormData();
    formData.append('followingUserId', follow);
    axios.post('api-user-details-list.php', formData).then(response => {
        console.log(response);
    });
}