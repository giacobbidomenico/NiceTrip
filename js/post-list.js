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

document.getElementById("mainArticle").innerHTML = `<div id="feed" class="container-fluid"><div>`;

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
		let post = requestPostDetails(ids.data[0].id);
    }
}

// adds the html for a new post and its details
function createPostPreview(postDetails) {
	let scheme =  `<div class="row gy-4">
		<article class="card w-75 mx-auto p-0">
			<div class="card-header">
				<h4 id="post-title" class="card-title">
					<a id="post-title" class="link-dark link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="">` + postDetails.data[0].title + `</a>
				</h4>
				<div id="author-details" class="">
				</div>
			</div>
			<div id="carousel" class="carousel slide">
			</div>
			<div class="container-fluid card-body gy-2">
				<div class="row">
					<div class="col">
						<a id="comments" class="btn btn-light my-2" href="">
							<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-card-text desktop-icon" viewBox="0 0 16 16">
								<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
								<path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
							</svg>
							<span>
								comments: ` + (postDetails.data[0].commentNumber !== 0 ? postDetails.data[0].commentNumber : 0) + `
							</span>
						</a>
						<a id="likes" class="btn btn-light my-2" href="">
							<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-balloon-heart desktop-icon" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="m8 2.42-.717-.737c-1.13-1.161-3.243-.777-4.01.72-.35.685-.451 1.707.236 3.062C4.16 6.753 5.52 8.32 8 10.042c2.479-1.723 3.839-3.29 4.491-4.577.687-1.355.587-2.377.236-3.061-.767-1.498-2.88-1.882-4.01-.721L8 2.42Zm-.49 8.5c-10.78-7.44-3-13.155.359-10.063.045.041.089.084.132.129.043-.045.087-.088.132-.129 3.36-3.092 11.137 2.624.357 10.063l.235.468a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3.177 3.177 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.235-.468ZM6.013 2.06c-.649-.18-1.483.083-1.85.798-.131.258-.245.689-.08 1.335.063.244.414.198.487-.043.21-.697.627-1.447 1.359-1.692.217-.073.304-.337.084-.398Z" />
							</svg>
							<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-balloon-heart-fill desktop-icon" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z" />
							</svg>
							<span>
								likes: ` + (postDetails.data[0].likeNumber !== 0 ? postDetails.data[0].likeNumber : 0) + `
							</span>
						</a>
					</div>
				</div>
			</div>
		</article>
	</div>`;
	document.getElementById("feed").innerHTML = scheme;
}

//adds author details to a given post
function setAuthorDetails() {
	let scheme = `<img id="author-image" class="desktop-icon" src="` + + `" />
	<a id="author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="#">` + + `</a>`;
}

// adds the corrisponding images at a given post
function setPostImages() {
	let scheme = `<div id="carouselExample" class="carousel slide">
		<div class="carousel-inner">`;
	scheme += `<div class="carousel-item active">
				<img id="image" src="img/genericImage.jpg" class="d-block w-100" alt="" />
			</div>`;
			`<div class="carousel-item">
				<img id="image" src="img/genericImage.jpg" class="d-block w-100" alt="" />
			</div>
			<div class="carousel-item">
				<img id="image" src="img/genericImage.jpg" class="d-block w-100" alt="" />
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button> 
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>`;
}

// returns details of a given post
function requestPostDetails(postId) {
    const formData = new FormData();
    formData.append('postId', postId);
    axios.post('api-post-details.php', formData).then(response => {
		console.log(response);
		createPostPreview(response);
		let authorData = requestAuthorDetails(response.data[0].userId);
		let images = requestPostImages(postId);
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