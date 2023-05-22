"use strict";

const ADDED_PREV_PER_TIME = 3;
let postCounter = 0;
let posts = [];
let maxScroll = window.innerHeight;
let lastViewed = 0;
let ids;
let author;
let follow = false;


document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"></div>`;

//posts id request
axios.get('api-post-id-list.php?userProfile='+userProfile).then(response => {
    ids = response;
    updateFeed();
    window.addEventListener("scroll", event => {
        if (isBottomReached()) {
            updateFeed();
        }
    });
});


//requests author's profile image and username
const formData = new FormData();
formData.append('userId', userProfile);
formData.append('checkFollow', 'true');
axios.post('api-user-details-list.php', formData).then(response => {
    author = response;
    document.getElementById("author-image").src += response.data[0].photoPath;
    document.getElementById("author-username").innerHTML = response.data[0].userName;
    //if current page is another user's profile page, adds and  
    if (!ids.data["isMyProfile"]) {
        follow = response.data[0].follow == 1;
        changeFollowButton(follow);
        document.getElementById("b-follow").addEventListener("click", changeFollowState);
    } else {
        document.getElementById("b-follow").classList.add("d-none");
    }
});



/**
 * Changes state of the follow button
 * @param {Boolean} follow - true to follow, false to unfollow
 */
function changeFollowButton(follow) {
    if (follow) {
        document.getElementById("b-follow").childNodes[1].innerHTML = "Already followed";
        document.getElementById("b-follow").childNodes[3].classList.remove("d-none");
        document.getElementById("b-follow").classList.remove("btn-primary");
        document.getElementById("b-follow").classList.add("btn-light");

    } else {
        document.getElementById("b-follow").childNodes[3].classList.add("d-none");
        document.getElementById("b-follow").childNodes[1].innerHTML = "Follow";
        document.getElementById("b-follow").classList.remove("btn-light");
        document.getElementById("b-follow").classList.add("btn-primary");
    }
}

/**
 * Changes follow state
 */
function changeFollowState() {
    const formData = new FormData();
    if (follow) {
        follow = false;
        formData.append('register', 'false');
    } else {
        follow = true;
        formData.append('register', 'true');
    }
    formData.append('userId', userProfile);
    axios.post('api-follow.php', formData).then(response => { });
    changeFollowButton(follow);
}


// checks whether the user has reached the bottom of the page
function isBottomReached() {
    return window.innerHeight + 5 >= document.getElementById("mainArticle").getBoundingClientRect().bottom;
}

/**
 * adds new posts
 */
function updateFeed() {
    if (ids.data["posts"].length == 0) {
        addEmptyFeed();
    } else {
        let maxId = postCounter + ADDED_PREV_PER_TIME;
        for (let i = postCounter; i < maxId && i < ids.data["posts"].length; i++) {
            console.log("post Loading: " + i);
            posts.push(new Post(ids.data["posts"][i].id, ids.data["isMyProfile"]));
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



