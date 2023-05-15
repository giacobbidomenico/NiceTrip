"use strict";

let index = 0;

document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"><div>`;

//posts id request
axios.post('api-post-id-list.php', {}).then(response => {
    let ids = response;
    fillFeed(ids);
    window.addEventListener("scroll", event => fillFeed(ids));
});

// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight >= document.getElementById("mainArticle").getBoundingClientRect().bottom;
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