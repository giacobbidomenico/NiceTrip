window.addEventListener("load", noDestinations);

const add_destination_button = document.getElementById("add-destination-button");
const add_image_button = document.getElementById("add-image-button");

const search_field = document.querySelectorAll("[list]")[0];
const images_field = document.getElementById("images-field");

const destinations_container = document.getElementById("destinations-container");
const destination_suggests = document.getElementById("destinations-suggests");

const images_container = document.getElementById("images-container");

let suggestions = [];
let suggestionsManager;
let lastIndex = 0;

add_destination_button.addEventListener("click", event => addDestination());
add_image_button.addEventListener("click", event => addImage());

search_field.addEventListener("input", event => showAutoSuggest());


function noDestinations() {
    destinations_container.innerHTML = "<p id='message'></p>"
    showMessage('No destinations have been entered at the moment!', 'error');
}

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

function getEntityIdByPlace(place) {
    return Array.from(destination_suggests.querySelectorAll("[data-value]")).filter(item => item.formattedSuggestion === place)[0].getAttribute("data-value");
}

function getSelectedSuggestion() {
    return suggestions.filter(item=> item.formattedSuggestion === search_field.value);
}


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

function newDestinationListElement(id, place) {
    return `
        <li id="destination-${lastIndex}" data-value='${id}' class="list-group-item list-group-item-action container-fluid">
            <div class="row">
                <div class="row">
                    <h5 class="mb-1">${place}</h5>
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

function newImageElement(src_image, file_name_image) {
    return `
        <li class="list-group-item list-group-item-action container-fluid">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="${src_image}"/>
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

function getLastImage() {
    return document.getElementById("images-list").lastElementChild.getElementsByTagName("img")[0];
}

function deleteListElement(list, lastIndex, message_error='') {

}


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

    /*
    if(destinations_list.getElementsByTagName("li").length > 0) {
        const lastElement = destinations_list.lastElementChild;


        if(lastElement.getAttribute("data-value") === selectedSuggestion[0].entityId) {
            showFieldInvalid(search_field, "");
            return;
        }
    }*/

    destinations_list.innerHTML += newDestinationListElement(selectedSuggestion[0].entityId, search_field.value);
    
    Array.from(destinations_list.getElementsByTagName("li"))
        .forEach(item => item.querySelectorAll("[data-type=trash]")[0].addEventListener("click", event=> {
            item.remove();
            if(destinations_list.getElementsByTagName("li").length === 0) {
                destinations_container.children[0].remove();
                noDestinations();
            }
        }));

    lastIndex++;
    search_field.value = '';
    suggestions = [];
    destination_suggests.innerHTML = '';

    showFieldWithoutValidation(search_field);
}

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
        reader.onload = function(e) {
            console.log(e);
            images_list.innerHTML += newImageElement(e.target.result, e.target.fileName);
        }

        reader.readAsDataURL(images_field.files[i]);
    }

    
    lastIndex++;
}
