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