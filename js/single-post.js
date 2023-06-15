"use strict";

// number of comments to be extracted at a time
const COMMENTS_NUM = 20;
// tracks the number of comments showed
let showedCommentsCounter = 0;
// list of id of the comments to be showed
let commentIdList;
// id of the comment to be deleted
let commentToBeDeleted;
document.getElementById("p-likes").addEventListener("click", notifyLike);
const d = new Date();

let commentArea = document.getElementById("c-area");

document.getElementById("c-submit").addEventListener("click", commentSub);

function commentSub() {
	formData.append('option', 'push');
	formData.append('description', commentArea.value);
	axios.post('api-comment.php', formData).then(response => {
		showedCommentsCounter++;
		commentIdList.push(response.data);
		formData.append('option', 'get');
		formData.append('commentIds', JSON.stringify(response.data));
		axios.post('api-comment.php', formData).then(response => {
			const comment = response.data[0];
			if (commentIdList.length == 1) {
				document.getElementById("commentSection").innerHTML = '';
			}
			displayComment(comment, true);
			setAuthorDetails(comment);
		});
	});
    axios.post('api-email-notifications.php');
}

// modal to manage comment deletion
const confirmModal = `
				<div id="c-m-deletion" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Are you sure?</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<p>You cannot restore posts that have been deleted.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button id="c-deleteConfirm" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
							</div>
						</div>
					</div>
				</div>`;
//document.getElementById("commentSection").insertAdjacentHTML("beforeend", confirmModal);
//detect whether it has been confirmed a comment deletion
document.getElementById("c-deleteConfirm").addEventListener("click", event => {
	formData.append('commentId', commentToBeDeleted);
	formData.append('option', 'remove');
	showedCommentsCounter += COMMENTS_NUM;
	axios.post('api-comment.php', formData).then(response => {
		//remove comment from DOM
		document.getElementById("c-" + commentToBeDeleted).remove();
		//reduce counter of showed comments
		showedCommentsCounter--;
		//removes id of the comment from comment id list
		commentIdList.pop(commentIdList.indexOf(commentToBeDeleted));
		if (commentIdList.length == 0) {
			noCommentsDisplay();
		}
	});
});

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
			axios.post('api-email-notifications.php');
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
	if (commentIdList.length == 0) {
		noCommentsDisplay();
    }

	if (showedCommentsCounter < commentIdList.length){
		const formData = new FormData();
		formData.append('postId', postId);
		formData.append('option', 'get');
		formData.append('commentIds', JSON.stringify(commentIdList.slice(showedCommentsCounter, showedCommentsCounter + COMMENTS_NUM)));
		showedCommentsCounter += COMMENTS_NUM;
		axios.post('api-comment.php', formData).then(response => {
			for (const comment of response.data) {
				console.log(comment);
				displayComment(comment,false);
				setAuthorDetails(comment);
			}
			if (showedCommentsCounter < commentIdList.length) {
				let button = `<div id="c-add" class="d-grid gap-2">
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
}
/**
 * Extract an author's details of a post from database and displays them into the proper comment.
 * @param {any} comment - comment details
 */
function setAuthorDetails(comment) {
	formData.append('checkFollow', "false");
	formData.append('userId', JSON.stringify(comment["userId"]));
	axios.post('api-user-details-list.php', formData).then(response => {
		document.getElementById("c-" + comment.id + "-image").src += response.data[0].photoPath;
		document.getElementById("c-" + comment.id + "-author").innerHTML = response.data[0].userName;
	});
}

/**
 * Creates the html elements to show a single comment
 * @param {any} response - comment data
 * @param {Boolean} top - true if comment has to be showed at the top of the list, false at the bottom
 */
function displayComment(details, top) {
	let scheme = `<article id="c-` + details.id + `" class="">
					<div class="card border-0 mb-3" >
						<div class="row g-0">
							<div class="col-2 ">
								<div class="m-2">
									<div class="ratio ratio-1x1">
										<div class="border d-flex align-items-center">
											<img id="c-` + details.id + `-image" src="profilePhotos/" class="img-fluid mx-auto align-middle profile-image-introduction" alt="...">
										</div>
									</div>
								</div>
							</div>
							<div class="col-10">
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
								<button id="c-` + details.id + `-delete" type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#c-m-deletion">
									Delete post
								</button>
							</li>
						</ul>
					</div>
				</div>`;
	}
	scheme += `</div>
						<div class="row" >
							<p class="card-text">` + details.description + `</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>`;

	document.getElementById("commentSection").insertAdjacentHTML(top ? "afterbegin" : "beforeend", scheme);
	if (userId == details.userId) {
		document.getElementById("c-" + details.id + "-delete").addEventListener("click", event => { commentToBeDeleted = details.id });
	}
}

function noCommentsDisplay() {
	let displayEmpty = `<div class="p-5 mx-auto bg-light text-center"> No comments yet.</div>`;
	document.getElementById("commentSection").insertAdjacentHTML("beforeend", displayEmpty);
}

initializeItinerary();
window.addEventListener("resize", initializeItinerary);
let itineraries = document.getElementsByClassName("itinerary");
let r = document.querySelector(':root');
for (let singleIt of itineraries) {

	let outerDiv = singleIt.getElementsByClassName("outerDiv")[0];
	let innerDiv = singleIt.getElementsByClassName("innerDiv")[0];
    singleIt.getElementsByClassName("middleDiv")[0].addEventListener(
        "scroll",
        () => {
            const oneThird = (outerDiv.offsetHeight - 20) / innerDiv.offsetHeight;
            const unit = oneThird * 100 / 33;
            console.log("unit: " + unit);
            const scroll = (innerDiv.getBoundingClientRect().top - outerDiv.getBoundingClientRect().top - 20) / (innerDiv.offsetHeight);
            console.log(scroll);
            const scrollPerc = scroll / unit;
            //console.log("scrollPerc: " + (scrollPerc - noScrollPerc));
            r.style.setProperty(
                "--scroll",
                -(scrollPerc)
            );
        },
        false
    );
}

function initializeItinerary() {
	let itineraries = document.getElementsByClassName("itinerary");

	for (let singleIt of itineraries) {
		let outerDiv = singleIt.getElementsByClassName("outerDiv")[0];
		let innerDiv = singleIt.getElementsByClassName("innerDiv")[0];
		let r = document.querySelector(':root');

		let lis = singleIt.getElementsByClassName("dot");
		let oneThird = (outerDiv.offsetHeight - 20) / innerDiv.offsetHeight;
		let unit = oneThird * 100 / 33;
		console.log("scroll (Errore): " + scroll);
		for (let li of lis) {
            const scroll = (innerDiv.getBoundingClientRect().top - outerDiv.getBoundingClientRect().top - 20) / (innerDiv.offsetHeight);
            const scrollPerc = scroll / unit;
			const itemScroll = (li.getBoundingClientRect().top - outerDiv.getBoundingClientRect().top) / (innerDiv.offsetHeight);
			const itemScrollPerc = itemScroll / unit;
			console.log("li: " + (0.66 - scroll));
			li.style.setProperty("--offset", 0.66 + scrollPerc - itemScrollPerc);
		}
		//const firstPos = lis[0].getBoundingClientRect().top - outerDiv.getBoundingClientRect().top;
		//console.log("firstPos: " + firstPos);
		//r.style.setProperty("--first-Pos", firstPos);
	}
}

