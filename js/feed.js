"use strict";

const ADDED_PREV_PER_TIME = 3;
let postCounter = 0;
let posts = [];
let maxScroll = window.innerHeight;
let lastViewed = 0;
let ids;


document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"></div>`;

//waits for the first posts to finish loading, then checks whether they have been visualized
const observer = new MutationObserver(function (el) {
    //console.log("MutationObserved: " + el[0].target.classList);
    checkVisualizedPosts();
});

observer.observe(document.getElementById("feed"), { subtree: true, childList: true });

//posts id request
axios.post('api-post-id-list.php', {}).then(response => {
    ids = response;
    updateFeed();
    window.addEventListener("scroll", event => {
        if (isBottomReached()) {
            updateFeed();
        }
        if (maxScroll < window.scrollY + window.innerHeight) {
            maxScroll = window.scrollY + window.innerHeight;
            checkVisualizedPosts();
        }
    });
});


// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight+5 >= document.getElementById("mainArticle").getBoundingClientRect().bottom;
}

/**
 * adds new posts
 */
function updateFeed() {
    if (ids.data.length == 0) {
        addEmptyFeed();
    } else{
        let maxId = postCounter + ADDED_PREV_PER_TIME;
        for (let i = postCounter; i < maxId && i < ids.data.length; i++) {
            console.log("post Loading: " + i);
            posts.push(new Post(ids.data[i].id, false));
            posts[i].requestPostDetails();
            postCounter++;
        ////console.log(ids.data[i]);
        //requestPostDetails(ids.data[i].id);
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

/**
 * Checks whether posts have been visualized, notifies database
 */
function checkVisualizedPosts(){
    //console.log("lastViewed:" + lastViewed);
    for (let i = lastViewed; i < postCounter && posts[i].isPostCreated(); i++) {
        //console.log(i + ": post: " + posts[i].id + " : " + posts[i].isPostCreated());
        if (document.getElementById("p-" + ids.data[i].id).getBoundingClientRect().bottom <= window.innerHeight) {
            //console.log(ids.data[i].id + "viewed");
            lastViewed++;
            posts[i].notifyVisual();
        }
    }

}