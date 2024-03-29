"use strict";
/**
 * number of previews added ad a time
 * */
const ADDED_PREV_PER_TIME = 2;
/**
 * number of user results added ad a time
 * */
const ADDED_USER_PER_TIME = 2;
/**
 * input element
 * */
let input = document.getElementById("s-input");
/**
 * id of the posts resulting from the search
 * */
let postIds;
/**
 * id of the users resulting from the search
 * */
let userIds;
/**
 * counters how many posts have been added
 * */
let postCounter = 0;
/**
 * counters how many users have been added
 * */
let usersCounter = 0;
/**
 * array of post objects
 * */
let posts = [];
/**
 * array of user objects
 * */
let users = [];

document.getElementById("s-button").addEventListener("click", search);
input.addEventListener("keypress", event => {
    if (event.key === "Enter") {
        event.preventDefault();
        event.stopPropagation();
    }
});

/**
 * Requests the id of the posts and users that matches the input value, then sets its html.
 * */
function search() {
    let string = input.value;
    let tokens = string.split(" ");

    const postsParam = new FormData();
	postsParam.append('tokens', JSON.stringify(tokens));
    axios.post('api-posts-by-title.php', postsParam).then(response => {
        document.getElementById("feed").innerHTML = "";
        postCounter = 0;
        postIds = response;
        posts.length = 0;
        updateFeed();
	});

    const usersParam = new FormData();
    usersParam.append('name', string);
    axios.post('api-users-match.php', usersParam).then(response => {
        usersCounter = 0;
        users.length = 0;
        userIds = response;
        showUsersResult();
    });
}



// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight + 5 >= document.getElementById("mainArticle").getBoundingClientRect().bottom;
}

/**
 * adds new posts
 */
function updateFeed() {
    if (postIds.data.length == 0) {
        showEmptyPostSearch();
    } else {
        let maxId = postCounter + ADDED_PREV_PER_TIME;
        for (let i = postCounter; i < maxId && i < postIds.data.length; i++) {
            posts.push(new Post(postIds.data[i].id, false));
            posts[i].requestPostDetails();
            postCounter++;
        }
    }
}

function showEmptyPostSearch() {
    let scheme = `<article class="card mx-auto my-3" >
        <div class="card-body">
            <h3 class="card-title">Sorry!</h3>
            <p class="card-text">No reults found.</p>
        </div>
    </article>`;
    document.getElementById("feed").innerHTML = scheme;
}

function showEmptyUserSearch() {
    let scheme = `<article class="card mx-auto my-3" >
        <div class="card-body">
            <h3 class="card-title">Sorry!</h3>
            <p class="card-text">No reults found.</p>
        </div>
    </article>`;
    document.getElementById("users").innerHTML = scheme;
}

function showUsersResult() {
    if (userIds.data.length == 0) {
        showEmptyUserSearch();
    } else {
        let scheme = `<ul id="r-user" class="list-group list-group-flush overflow-y-scroll"></ul >`;
        document.getElementById("users").innerHTML = scheme;
        retrieveAndShowUsers(userIds.data.map((x) => x.id), "r-user");
    }
}
