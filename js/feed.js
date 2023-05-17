"use strict";

const ADDED_PREV_PER_TIME = 10;
let postCounter = 0;
let posts = [];

let remove;


let maxScroll = window.innerHeight;
let lastViewed = 0;
let ids;
let addedElements = 0;

document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"></div>`;

//waits for the first posts to finish loading, then checks whether they have been visualized
const observer = new MutationObserver(function (el) {
    console.log("MutationObserved: " + el[0].target.classList);
    ////checks if the added element is a post preview
    //if (el[0].target.id == "feed") {
    //    addedElements++;
    //}
    //console.log(el);
    ////checks if the added element is the carousel of a post preview
    //if (el[0].target.classList.contains("carousel")) {
    //    //console.log("Prova");
    //}
    ///*if (addedElements === ADDED_PREV_PER_TIME || addedElements === ids.data.length) {
    //    remove = el;
    //    //console.log("el: " + el);
    //    //this.disconnect();
    //    //console.log(index);
    //    checkVisualizedPosts();
    //}*/
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
    return window.innerHeight >= document.getElementById("mainArticle").getBoundingClientRect().bottom;
}

/**
 * adds new posts
 */
function updateFeed() {
    let maxId = postCounter + ADDED_PREV_PER_TIME;
    for (let i = postCounter; i < maxId && i < ids.data.length; i++) {
        posts.push(new Post(ids.data[i].id));
        posts[i].requestPostDetails();
        postCounter++;
        ////console.log(ids.data[i]);
        //requestPostDetails(ids.data[i].id);
    }
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
        }
    }

}