// number of comments to be extracted at a time
const COMMENTS_NUM = 2;
// tracks the number of comments showed
let showedCommentsCounter = 0;
// list of id of the comments to be showed
let commentIdList;

document.getElementById("p-likes").addEventListener("click", notifyLike);
const d = new Date();
let date = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay();
let time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

/**
* updates database, registers that the user has liked the post
*/
function notifyLike() {
	const formData = new FormData();
	formData.append('postId', postId);
	axios.post('api-post-like.php', formData).then(response => {
		if (response.data["insert"]) {
			document.getElementById("p-likes").childNodes[1].classList.add("d-none");
			document.getElementById("p-likes").childNodes[3].classList.remove("d-none");
			document.getElementById("p-likes").childNodes[5].innerHTML = "likes: " + response.data["likes"][0]["number"];
		} else {
			document.getElementById("p-likes").childNodes[1].classList.remove("d-none");
			document.getElementById("p-likes").childNodes[3].classList.add("d-none");
			document.getElementById("p-likes").childNodes[5].innerHTML = "likes: " + response.data["likes"][0]["number"];
		}
	});
}

const formData = new FormData();
formData.append('postId', postId);
formData.append('option', 'list');
axios.post('api-comment.php', formData).then(response => {
	commentIdList = response.data.flatMap((x) => x["id"]);
		console.log(response);
	getComments();
});

function commentsButton() {
	document.getElementById("c-add").remove();
	getComments();
}

/**
 * Sends a post request to database to get details of some posts, then displays them.
 * */
function getComments() {
	const formData = new FormData();
	formData.append('postId', postId);
	formData.append('option', 'get');
	formData.append('commentIds', JSON.stringify(commentIdList.slice(showedCommentsCounter, showedCommentsCounter + COMMENTS_NUM)));
	showedCommentsCounter += COMMENTS_NUM;
	axios.post('api-comment.php', formData).then(response => {
		for (comment of response.data) {
			console.log(comment);
			displayPost(comment);
			setAuthorDetails(comment);
		}
		if (showedCommentsCounter < commentIdList.length) {
			button = `<div id="c-add" class="d-grid gap-2">
					<button id="c-add-button" class="btn btn-light" type="button">
						<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-plus-circle" viewBox="0 0 16 16">
						  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
						</svg>
					</button>
				</div>`;
			document.getElementById("commentSection").insertAdjacentHTML("beforeend", button);
			document.getElementById("c-add").addEventListener("click", commentsButton);
		}
	});
}
/**
 * Extract an author's details of a post from database and displays them into the proper comment.
 * @param {any} comment - comment details
 */
function setAuthorDetails(comment) {
	formData.append('checkFollow', "false");
	formData.append('userId', comment["userId"]);
	axios.post('api-user-details-list.php', formData).then(response => {
		document.getElementById("c-" + comment.id + "-image").src += response.data[0].photoPath;
		document.getElementById("c-" + comment.id + "-author").innerHTML = response.data[0].userName;
	});
}

/**
 * Creates the html elements to show a single post
 * @param {any} response - comment data
 */
function displayPost(details) {
	let scheme = `<article class="">
					<div class="card border-0 mb-3" >
						<div class="row g-0">
							<div class="col-2 ">
								<div class="m-2">
									<div class="ratio ratio-1x1">
										<div class="border d-flex align-items-center">
											<img id="c-` + details.id + `-image" src="profilePhotos/" class="img-fluid" alt="...">
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card-body container-fluid">
									<div class="row" >
										<div class="col">
											<h5 id="c-` + details.id + `-author" class="card-title"></h5>
											<p class="card-text"><small class="text-body-secondary">` + details.date + " - " + details.time + `</small></p>
										</div>`;
	if (userId == details.userId) {
		scheme += `<div class="col-4">
					<div class="dropdown d-inline">
						<button id="c-` + details.id + `-drop" class="float-end btn btn btn-light my-2" type="button" data-bs-toggle="dropdown">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
								<path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
							</svg>
						</button>
						<ul class="dropdown-menu">
							<li>
								<button id="c-` + details.id + `-delete" type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Delete post
								</button>
							</li>
						</ul>
					</div>
				</div>`;
	}
	scheme += `</div>
						<div class="row" >
							<p class="card-text">-` + details.description + `-</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>`;

	
	document.getElementById("commentSection").insertAdjacentHTML("beforeend", scheme);
	//document.getElementById("c-" + details.id + "-delete").addEventListener("click", deleteComment);
}
