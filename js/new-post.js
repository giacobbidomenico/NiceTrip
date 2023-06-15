window.addEventListener("load", event => {
    noDestinations();
    noImages();
    Array.from(document.getElementsByTagName("script")).forEach(element => element.removeAttribute("type"));
});

const title_field = document.getElementById("title");
const description_field = document.getElementById("description");

const add_destination_button = document.getElementById("add-destination-button");
const add_image_button = document.getElementById("add-image-button");

const search_field = document.querySelectorAll("[list]")[0];
const images_field = document.getElementById("images-field");

const destinations_container = document.getElementById("destinations-container");
const destination_suggests = document.getElementById("destinations-suggests");

const images_container = document.getElementById("images-container");

const post_submit = document.getElementById("post-submit");
const loading_icon = document.getElementById("loading-icon");
const form =  document.getElementById("new-post-form");

let suggestions = [];
let suggestionsManager;
let lastIndex = 0;
let lastImage = -1;
let dataImages = new Array();


add_destination_button.addEventListener("click", event => addDestination());
add_image_button.addEventListener("click", event => addImage());

search_field.addEventListener("input", event => showAutoSuggest());

post_submit.addEventListener("click", event => {
    event.preventDefault();
    publish_post();
    scrollToTop();
});

/**
 * Function that scrolls to the top of the page.
 */
function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

/**
 * Function that takes care of inserting a message that indicates that no destinations
 * have been inserted in the post.
 */
function noDestinations() {
    destinations_container.innerHTML = "<p id='message1'></p>"
    showMessage(document.getElementById("message1"), 'No destinations have been entered at the moment!', 'error');
}

/**
 * Function that takes care of inserting a message that indicates that no images
 * have been inserted in the post.
 */
function noImages() {
    images_container.innerHTML = "<p id='message2'></p>"
    showMessage(document.getElementById("message2"), 'No images have been entered at the moment!', 'error');
}

/**
 * Function that takes care of picking up the destinations used in the auto-suggest of destinations from the bing api.
 */
function autosuggest() {
    Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', {
        callback: onLoad,
        errorCallback: onError
    });

    function onLoad() {
        var options = { maxResults: 5, businessSuggestions: true };
        suggestionsManager = new Microsoft.Maps.AutosuggestManager(options);
    }

    function onError(message) {
        lastResult = null;
    }
}

/**
 * Function that takes care of showing the destinations, obtained from the bing api, in a datalist
 */
function showAutoSuggest() {
    suggestionsManager.getSuggestions(search_field.value, function(suggestionResult) {
        if(suggestionResult.length === 0) {
            return;
        }

        destination_suggests.innerHTML = '';

        let newSuggestions = [];
        for(i=0; i < suggestionResult.length;i++) {
            console.log(search_field.value + ' - ' + suggestionResult[i].formattedSuggestion);
            if(search_field.value === suggestionResult[i].formattedSuggestion) {
                suggestions =  [];
                suggestions.push(suggestionResult[i]);
                console.log(suggestions);
                return;
            }
            destination_suggests.innerHTML += `
                <option value="${suggestionResult[i].formattedSuggestion}">${suggestionResult[i].formattedSuggestion}</option>
            `;
            newSuggestions.push(suggestionResult[i]);
        }
        suggestions = [];
        suggestions = suggestions.concat(newSuggestions);
    });
}

/**
 * Function that takes care of returning the entity id of a destination.
 * 
 * @param {*} place text name of the place
 * @returns place entity id
 */
function getEntityIdByPlace(place) {
    return Array.from(destination_suggests.querySelectorAll("[data-value]")).filter(item => item.formattedSuggestion === place)[0].getAttribute("data-value");
}

/**
 * Function that takes care of returning the destination selected in the datalist.
 * 
 * @returns the selected destination in text format
 */
function getSelectedSuggestion() {
    return suggestions.filter(item=> item.formattedSuggestion === search_field.value);
}

/**
 * Function that takes care of exchanging two elements of a generic list.
 * 
 * @param {*} nodeA first element
 * @param {*} nodeB second element
 */
function swap(nodeA, nodeB) {
    const parentA = nodeA.parentNode;
    const siblingA = nodeA.nextSibling === nodeB ? nodeA : nodeA.nextSibling;

    nodeB.parentNode.insertBefore(nodeA, nodeB);

    parentA.insertBefore(nodeB, siblingA);
}

/**
 * Function that deals with the creation of a list.
 * 
 * @param {*} name_list list id
 * @returns the created list
 */
function createList(name_list) {
    return `
        <div class="row">
            <div class="col gy-4">
                <div class="card">
                    <ul id="${name_list}" class="list-group list-group-flush">
                    </ul>
                </div>
            </div>
        </div>
    `;
}

/**
 * Function that deals with the creation of a new element of the list of destinations.
 * 
 * @param {*} id destination id
 * @param {*} place text name of the place
 * @returns a new item of the destinations list
 */
function newDestinationListElement(id, place) {
    return `
        <li id="destination-${lastIndex}" data-value='${id}' class="list-group-item list-group-item-action container-fluid">
            <div class="row">
                <div data-type="content" class="row">
                    <p class="fw-bold fs-7 mb-1">${place}</p>
                </div>
                <div class="row p-0">
                    <div class="col-12 p-0">
                        <button id="trash-${lastIndex}" data-type="trash" class="btn btn-transparent float-end"  type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </button>
                        <button id="chrevron-down-${lastIndex}" data-type="chrevron-down" class="btn btn-transparent float-end" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <button id="chrevron-up-${lastIndex}" data-type="chrevron-up" class="btn btn-transparent float-end" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </li>
    `;
}

/**
 * Function that deals with the creation of a new element of the list of images.
 * 
 * @param {*} src_image src of the image
 * @param {*} file_name_image  file name of the image
 * @returns a new item of the destinations list
 */
function newImageElement(src_image, file_name_image) {
    lastImage++;
    return `
        <li id="image-${lastIndex}" class="list-group-item list-group-item-action container-fluid">
            <div data-type="content"class="row">
                <div class="col-4">
                    <img class="img-fluid" src="${src_image}" alt="file: ${file_name_image}" data-index="${lastImage}"/>
                </div>
                <div class="col-8">
                    <p class="fw-bold fs-7">${file_name_image}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <button id="trash-${lastIndex}" data-type="trash" class="btn btn-transparent float-end"  type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </button>
                        <button id="chrevron-down-${lastIndex}" data-type="chrevron-down" class="btn btn-transparent float-end" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                        <button id="chrevron-up-${lastIndex}" data-type="chrevron-up" class="btn btn-transparent float-end" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </li>
    `;
}

/**
 * Function that returns the last image in images list
 * @returns the last image in images list
 */
function getLastImage() {
    return document.getElementById("images-list").lastElementChild.getElementsByTagName("img")[0];
}

/**
 * Function that deals with the deletion of an element of a list
 * 
 * @param {*} list considered list
 * @param {*} list_container container list
 * @param {*} f_error function that is called when the list has no more elements
 */
function deleteListElement(list, list_container, f_error) {
    Array.from(list.getElementsByTagName("li"))
    .forEach(item => item.querySelectorAll("[data-type=trash]")[0].addEventListener("click", event=> {
        item.remove();
        if(list.getElementsByTagName("li").length === 0) {
            list_container.children[0].remove();
            f_error();
        }
    }));
}

/**
 * Function that takes care of moving an element of the list with the one above.
 * 
 * @param {*} list considered list
 */
function swapUpElement(list) {
    Array.from(list.getElementsByTagName("li"))
    .forEach(item => item.querySelectorAll("[data-type=chrevron-up]")[0].addEventListener("click", event=> {
        const actualContent = item.querySelectorAll("[data-type=content]")[0];
        const prev = item.previousElementSibling;

        if(prev === null) {
            const last = list.lastElementChild.querySelectorAll("[data-type=content]")[0];
            swap(actualContent, last);
        } else {
            swap(actualContent, prev.querySelectorAll("[data-type=content]")[0]);
        }
    }));
}
/**
 * Function that takes care of moving an element of the list with the one below.
 * 
 * @param {*} list considered list
 */
function swapDownElement(list) {
    Array.from(list.getElementsByTagName("li"))
    .forEach(item => item.querySelectorAll("[data-type=chrevron-down]")[0].addEventListener("click", event=> {
        const actualContent = item.querySelectorAll("[data-type=content]")[0];
        const next = item.nextElementSibling;

        if(next === null) {
            const last = list.firstElementChild.querySelectorAll("[data-type=content]")[0];
            swap(actualContent, last);
        } else {
            swap(actualContent, next.querySelectorAll("[data-type=content]")[0]);
        }
    }));
}

/**
 * Function that takes care of entering a new destination in destinations list.
 */
function addDestination() {

    let selectedSuggestion = getSelectedSuggestion();

    if(search_field.value === '') {
        showIfEmptyField(search_field);
        return;
    }

    if(selectedSuggestion.length === 0) {
        showFieldInvalid(search_field, "No destination has been selected");
    }

    if(destinations_container.getElementsByTagName("ul").length === 0) {
        destinations_container.innerHTML = createList("destinations-list");
    }

    const destinations_list = document.getElementById("destinations-list");

    destinations_list.innerHTML += newDestinationListElement(selectedSuggestion[0].entityId, search_field.value);
    
    deleteListElement(destinations_list, destinations_container, noDestinations);
    swapUpElement(destinations_list);
    swapDownElement(destinations_list);

    lastIndex++;
    search_field.value = '';
    suggestions = [];
    destination_suggests.innerHTML = '';

    showFieldWithoutValidation(search_field);
}

/**
 * Function that takes care of entering a new destination in images list.
 */
function addImage() {
    if(images_field.value === '' || images_field.files.lenght === 0) {
        showFieldInvalid(images_field, "No images selected!");
        return;
    }

    if(images_container.getElementsByTagName("ul").length === 0) {
        images_container.innerHTML = createList("images-list");
    }

    const images_list = document.getElementById("images-list");
    for(let i = 0; i < images_field.files.length; i++) {
        reader = new FileReader();
        reader.fileName = images_field.files[i].name;
        dataImages.push(images_field.files[i]);
        reader.onload = function(e) {
            console.log(e);
            images_list.innerHTML += newImageElement(e.target.result, e.target.fileName);
            deleteListElement(images_list, images_container, noImages);
            swapUpElement(images_list);
            swapDownElement(images_list);
            lastIndex++;
        }

        reader.readAsDataURL(images_field.files[i]);
    }

    images_field.value = '';
    showFieldWithoutValidation(images_field);
    
}

/**
 * Function that takes care of entering the destinations list, taking into account their order.
 * 
 * @returns an Array containing the textual names of the destinations
 */
function getDestinations() {
    return Array.from(destinations_container.getElementsByTagName("p"))
        .filter(item => !item.classList.contains("text-danger"))
        .map(item => item.innerHTML);
}

/**
 * Function that takes care of entering the images list, taking into account their order.
 * 
 * @returns an Array containing the images
 */
function getImages() {
    const images_index = Array.from(images_container.getElementsByTagName("img")).map(item=>item.getAttribute("data-index"))
    return images_index.map(item => dataImages[item]);
}

/**
 * Function that takes care of inserting the post into the database.
 */
function publish_post() {

    //Check that all essential fields have been entered
    showEmptyFields(form);
    
    if(title_field.value !== '') {
        showFieldWithoutValidation(title_field);
    }

    if(description_field.value !== '') {
        showFieldWithoutValidation(description_field);
    }

    if(title_field.value === '' || description_field.value === '') {
        return;
    }


    //disable the submit button to prevent multiple posts from being published
    post_submit.disabled = true;
    loading_icon.hidden = false;


    const formData = new FormData();


    const destinations = getDestinations();
    const images = getImages();

    formData.append("title", title_field.value);
    formData.append("description", description_field.value);

    if(destinations.length != 0) {
        destinations.forEach(item => formData.append("destinations[]", item));
    }

    if(images.length != 0) {
        for(let i=0; i < images.length; i++) {
            formData.append("images[]", images[i]);
        }
    }

    //Sending post data to database
    axios.post('api-post-publication.php', formData).then(response => {
        if(!response.data["error"]) {
            //take the user to the profile page if the post has been entered correctly
            window.location.replace("profile.php");
            post_submit.disabled = true;
            loading_icon.hidden = true;
        }
    });
}
