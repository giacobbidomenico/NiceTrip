"use strict";

/**
 * Represents a post
 * @param {Number} id - post unique id
 * @param {Boolean} editable - true if post is editable, false otherwise
 */
function Post(id, editable) {
	this.id = id;
	this.editable = editable;
	this.isSchemeAdded = false;
	this.isAuthorAdded = false;
	this.isCarouselAdded = false;
	this.like = false;
	this.likesNumber = 0;
	this.authorId;
	this.deleted = false;

	/**
	 * @returns true if the entire post has been added
	 * */
	this.isPostCreated = function () {
		if (this.isAuthorAdded && this.isCarouselAdded && this.isPostCreated) {
			return true;
		}
		return false;
    }

	/**
	 * adds html of the post as innerHTML of an element with id "feed"
	 * @param {any} postDetails - object containing details about the post
	 */
	this.createPostPreview = function (postDetails) {
		this.likesNumber = postDetails.data[0].likeNumber;
		this.like = postDetails.data[0].liked === 1 ? true : false;
		let scheme = `
						<div id="p-` + postDetails.data[0].id + `" class="row gy-4 m-3">
							<article class="card mx-auto p-0">
								<div class="card-header">
									<h2 id="p-` + postDetails.data[0].id + `-title" class="card-title">
										<a id="p-` + postDetails.data[0].id + `-title-text" class="link-dark link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="single-post.php?postId=` + this.id + `">` + postDetails.data[0].title + `</a>
									</h2>
									<div id="p-` + postDetails.data[0].id + `-author-details" class="">
									</div>
								</div>
								<div id="p-` + postDetails.data[0].id + `-carousel" class="carousel slide">
								</div>
								<div class="container-fluid card-body gy-2">
									<div class="row">
										<div class="col">
											<a id="p-` + postDetails.data[0].id + `-comments" class="btn btn-light my-2" href="single-post.php?postId=` + this.id + `#comments">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-card-text desktop-icon" viewBox="0 0 16 16">
													<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
													<path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
												</svg>
												<span>
													comments: ` + (postDetails.data[0].commentNumber !== 0 ? postDetails.data[0].commentNumber : 0) + `
												</span>
											</a>
											<button id="p-` + postDetails.data[0].id + `-likes" class="btn btn-light my-2">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-balloon-heart desktop-icon ` + (this.like ? "d-none" : "") + `" viewBox="0 0 16 16">
													<path fill-rule="evenodd" d="m8 2.42-.717-.737c-1.13-1.161-3.243-.777-4.01.72-.35.685-.451 1.707.236 3.062C4.16 6.753 5.52 8.32 8 10.042c2.479-1.723 3.839-3.29 4.491-4.577.687-1.355.587-2.377.236-3.061-.767-1.498-2.88-1.882-4.01-.721L8 2.42Zm-.49 8.5c-10.78-7.44-3-13.155.359-10.063.045.041.089.084.132.129.043-.045.087-.088.132-.129 3.36-3.092 11.137 2.624.357 10.063l.235.468a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3.177 3.177 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.235-.468ZM6.013 2.06c-.649-.18-1.483.083-1.85.798-.131.258-.245.689-.08 1.335.063.244.414.198.487-.043.21-.697.627-1.447 1.359-1.692.217-.073.304-.337.084-.398Z" />
												</svg>
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-balloon-heart-fill desktop-icon ` + (this.like ? "" : "d-none") + `" viewBox="0 0 16 16">
													<path fill-rule="evenodd" d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z" />
												</svg>
												<span>
													likes: ` + (postDetails.data[0].likeNumber !== 0 ? postDetails.data[0].likeNumber : 0) + `
												</span>
											</button>`;
		if (this.editable) {
			scheme = `
				<div id="p-` + postDetails.data[0].id + `-modal" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title">Are you sure?</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<p>You cannot restore posts that have been deleted.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button id="p-` + postDetails.data[0].id + `-deleteConfirm" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
							</div>
						</div>
					</div>
				</div>` +
				scheme +
				`
				<button id="p-` + this.id + `-delete" type="button" class="btn btn-light my-2" data-bs-toggle="modal" data-bs-target="#p-` + postDetails.data[0].id + `-modal">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-trash3" viewBox="0 0 16 16">
						<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
					</svg>
					<span>
						Delete post
					</span>
				</button>
				`;
        }
		scheme += `</div></div></div></article></div>`;
		document.getElementById("feed").insertAdjacentHTML("beforeend", scheme);
		if (this.editable) {
			document.getElementById("p-" + this.id + "-deleteConfirm").addEventListener("click", event => { this.deletePost(); });
		}
		if (!postDetails.data.ownPost) {
			document.getElementById("p-" + postDetails.data[0].id + "-likes").addEventListener("click", event => { this.notifyLike(); });
        }
		console.log(document.getElementById("p-" + this.id + "-likes"));


		this.isSchemeAdded = true;
	}

	/**
	 * adds author details 
	 * @param {any} author - author details
	 */
	this.setAuthorDetails = function (author) {
		let scheme = `<div id="p-` + this.id + `-author" class="d-flex flex-row" >
			<div class="ratio ratio-1x1 square-desktop-icon">
				<div class="border d-flex align-items-center">
					<img id="p-` + this.id + `-author-image" src="profilePhotos/` + author[0].photoPath + `" class="img-fluid mx-auto align-middle profile-image-introduction" alt="Profile image of the user ` + author[0].userName + `"/>
				</div>
			</div>
			<div class="ms-3">
				<a id="p-` + this.id + `-author-username" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile=` + author[0].id + `">` + author[0].userName + `</a>
			</div >
		</div>`;
		document.getElementById("p-" + this.id + "-author-details").innerHTML = scheme;
		this.isAuthorAdded = true;
	}

	/**
	 * adds images
	 * @param {any} images - images to be added
	 */
	this.setPostImages = function(images) {
		let scheme = `<div class="carousel-inner">`;
		for (let i = 0; i < images.length; i++) {
			scheme += `
				<div class="carousel-item ` + (i === 0 ? "active" : "") + `">
					<img id="p-` + this.id + `-image-` + i + `" src="img/` + images[i].name + `" class="d-block w-100" alt="Post image number ` + i + `" />
				</div>`;
		}

		if(images.length <= 1) {
			scheme += '</div>';
		} else {
			scheme += `
				</div>
				<button class="carousel-control-prev bg-" type="button" data-bs-target="#p-` + this.id + `-carousel" data-bs-slide="prev">
					<span aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#0d6efd" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
							<path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
						</svg>
					</span>
					<span class="visually-hidden">Previous</span>
				</button> 
				<button class="carousel-control-next" type="button" data-bs-target="#p-` + this.id + `-carousel" data-bs-slide="next">
					<span aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#0d6efd" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
							<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
						</svg>
					</span>
					<span class="visually-hidden">Next</span>
				</button>`;
		}
		
		document.getElementById("p-" + this.id + "-carousel").innerHTML = scheme;

		this.isCarouselAdded = true;
	}

	/**
	 * sends a request to get details about a given post, then adds html
	 */
	this.requestPostDetails = function() {
		const formData = new FormData();
		formData.append('postId', this.id);
		axios.post('api-post-details.php', formData).then(response => {
			this.createPostPreview(response);
			this.authorId = response.data[0].userId;
			let authorData = this.requestAuthorDetails(this.authorId);
			let images = this.requestPostImages(this.id);
		});
	}

	/**
	 * sends a request to get the images of a given post
	 */
	this.requestPostImages = function () {
		const formData = new FormData();
		formData.append('postId', this.id);
		axios.post('api-post-images.php', formData).then(response => {
			this.setPostImages(response.data);
		});
	}

	/**
	 * requests details of an author, then adds them into its corrisponding html element
	 * @param {any} follow - author id
	 */
	this.requestAuthorDetails = function(follow) {
		const formData = new FormData();
		formData.append('userId', JSON.stringify(follow));
		formData.append('checkFollow', 'false');
		axios.post('api-user-details-list.php', formData).then(response => {
			this.setAuthorDetails(response.data);
		});
	}

	/**
	 * updates database, registers that the user has visualized the post
	 */
	this.notifyVisual = function () {
		const formData = new FormData();
		formData.append('postId', this.id);
		axios.post('api-post-visual.php', formData).then(response => {});
	}

	/**
	 * updates database, registers that the user has liked the post
	 */
	this.notifyLike = function () {
		const formData = new FormData();
		formData.append('postId', this.id);
		axios.post('api-post-like.php', formData);
		if (document.getElementById("p-" + this.id + "-likes").childNodes[3].classList.contains("d-none")) {
			this.likesNumber++;
			document.getElementById("p-" + this.id + "-likes").childNodes[1].classList.add("d-none");
			document.getElementById("p-" + this.id + "-likes").childNodes[3].classList.remove("d-none");
			document.getElementById("p-" + this.id + "-likes").childNodes[5].innerHTML = "likes: " + this.likesNumber;
		} else {
			this.likesNumber--;
			document.getElementById("p-" + this.id + "-likes").childNodes[1].classList.remove("d-none");
			document.getElementById("p-" + this.id + "-likes").childNodes[3].classList.add("d-none");
			document.getElementById("p-" + this.id + "-likes").childNodes[5].innerHTML = "likes: " + this.likesNumber;
		}
		axios.post('api-email-notifications.php');
	}

	/**
	 * deletes this post from database
	 * */
	this.deletePost = function () {
		const formData = new FormData();
		formData.append('postId', this.id);
		axios.post('api-post-delete.php', formData).then(response => {
			this.deleted = true;
			document.getElementById("p-" + this.id).remove();
		});
	}
}


function retrieveAndShowUsers(userIds, elementId) {
	const formData = new FormData();
	formData.append('userId', JSON.stringify(userIds));
	formData.append('checkFollow', false);
	axios.post('api-user-details-list.php', formData).then(response => {
		showUsers(response.data, elementId);
	});
}

function showUsers(usersData, elementId) {
	let scheme = ``;
	for (let user of usersData) {
		scheme += `<li class="list-group-item">
			<div id="r-` + user.id + `" class="d-flex flex-row">
				<div class="ratio ratio-1x1 square-desktop-icon">
					<div class="border d-flex align-items-center">
						<img id="r-` + user.id + `-image" src="profilePhotos/` + user.photoPath + `" class="img-fluid mx-auto align-middle profile-image-introduction" alt="Profile image of the user ` + user.userName + `">
					</div>
				</div>
				<div class="ms-3">
						<a id="r-` + user.id + `-name" class="link-secondary link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="profile.php?userProfile=` + user.id + `">` + user.userName + `</a>
				</div>
			</div>
		</li>`;
	}
	document.getElementById(elementId).insertAdjacentHTML("beforeend", scheme);

}