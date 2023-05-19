"use strict";

const ADDED_PREV_PER_TIME = 3;
let postCounter = 0;
let posts = [];
let maxScroll = window.innerHeight;
let lastViewed = 0;
let ids;


document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"></div>`;

//posts id request
const formData = new FormData();
formData.append('ownPosts', "true");
axios.post('api-post-id-list.php', formData).then(response => {
    ids = response;
    updateFeed();
    window.addEventListener("scroll", event => {
        if (isBottomReached()) {
            updateFeed();
        }
    });
});


// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight + 5 >= document.getElementById("mainArticle").getBoundingClientRect().bottom;
}

/**
 * adds new posts
 */
function updateFeed() {
    if (ids.data.length == 0) {
        addEmptyFeed();
    } else {
        let maxId = postCounter + ADDED_PREV_PER_TIME;
        for (let i = postCounter; i < maxId && i < ids.data.length; i++) {
            console.log("post Loading: " + i);
            posts.push(new Post(ids.data[i].id, true));
            posts[i].requestPostDetails();
            postCounter++;
        }
    }
}

function addEmptyFeed() {
    let scheme = `<article class="card mx-auto" style="width: 18rem;">
        <div class="card-body">
            <h4 class="card-title">Ooopss!</h4>
            <p class="card-text">Your feed is empty.</p>
        </div>
    </article>`;
    document.getElementById("feed").innerHTML = scheme;
}



