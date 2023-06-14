"use strict";

const ADDED_PREV_PER_TIME = 3;
let postCounter = 0;
let posts = [];
let maxScroll = window.innerHeight;
let lastViewed = 0;
let ids;
let author;
let follow = false;

window.addEventListener("load", () => {
    document.getElementsByTagName("body")[0].innerHTML += `
        <div id="modal1" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Follower</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            ${document.getElementById("list-follower").innerHTML}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.getElementsByTagName("body")[0].innerHTML += `
        <div id="modal2" class="modal wh-100">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Follower</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            ${document.getElementById("list-follow").innerHTML}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
});

document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid5"></div>`;

document.getElementById("follower").addEventListener("click", () => {
    alert("hello");
    let myModal1 = new bootstrap.Modal(document.getElementById('modal1'), {});
    myModal1.show();
});

document.getElementById("follow").addEventListener("click", () => {
    alert("hello");
    let myModal2 = new bootstrap.Modal(document.getElementById('modal2'), {});
    myModal2.show();
});

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
formData.append('userId', JSON.stringify(userProfile));
formData.append('checkFollow', 'false');
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
    axios.post('api-follow.php', formData);
    axios.post('api-email-notifications.php');
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
    let scheme = `<article class="card my-3">
        <div class="card-body">
            <p class="card-text text-center">No posts yet.</p>
        </div>
    </article>`;
    document.getElementById("feed").innerHTML = scheme;
}



