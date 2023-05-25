const add_destination_button = document.getElementById("add-destination-button");
const search_field = document.getElementById("search-field");
const destinations_container = document.getElementById("destinations-container");
const start_time_field = document.getElementById("start-time-field");
const end_time_field = document.getElementById("end-time-field");
const destination_suggests = document.getElementById("destinations-suggests");
let suggestions = [];
let suggestionsManager;

let lastIndex = 1;

add_destination_button.addEventListener("click", event=> addDestination());
search_field.addEventListener("input", event => showAutoSuggest());

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


function createDestinationsList() {
    return `
        <div class="row">
            <div class="col gy-4">
                <div class="card">
                    <ul id="destinations-list" class="list-group list-group-flush">
                    </ul>
                </div>
            </div>
        </div>
    `;
}

function newDestinationListElement(id, place, start, end) {
    return `
        <li data-value='${id}' class="list-group-item list-group-item-action container-fluid">
            <div class="row">
                <p class="mb-1">${start.toLocaleDateString()} - ${end.toLocaleDateString()}</p>
            </div>
            <div class="row">
                <div class="col-12 col-lg-9 pe-0">
                    <h5 class="mb-1">${place}</h5>
                </div>
                <div class="col-12 col-lg-3 p-lg-0">
                    <small>${start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})} - ${end.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</small>
                </div>
            </div>
        </li>
    `;
}

function addDestination() {

    let selectedSuggestion = getSelectedSuggestion();

    if(search_field.value === '' || start_time_field.value === '' || end_time_field.value === '') {
        showIfEmptyField(search_field);
        showIfEmptyField(start_time_field);
        showIfEmptyField(end_time_field);
        return;
    }

    if(selectedSuggestion.length === 0) {
        showFieldInvalid(search_field, "No destination has been selected");
    }

    const start = new Date(start_time_field.value);
    const end = new Date(end_time_field.value);

    if(start.getTime() > end.getTime()) {
        showFieldInvalid(start_time_field, "Error, the start time cannot be after the end time");
        showFieldInvalid(end_time_field, "Error, it is not possible that the end time is before the end time");
        return;
    } else {
        showFieldWithoutValidation(start_time_field);
        showFieldWithoutValidation(end_time_field);
    }

    if(destinations_container.getElementsByTagName("ul").length === 0) {
        destinations_container.innerHTML = createDestinationsList();
    }

    const destinations_list = document.getElementById("destinations-list");
    if(destinations_list.getElementsByTagName("li").length > 0) {
        const lastElement = destinations_list.lastElementChild;

        if(lastElement.getAttribute("data-value") === selectedSuggestion[0].entityId) {
            return;
        }
    }

    

    destinations_list.innerHTML += newDestinationListElement(selectedSuggestion[0].entityId, search_field.value, start, end);

    lastIndex++;
    search_field.value = '';
    start_time_field.value = '';
    end_time_field.value = '';
    suggestions = [];
    
    showFieldWithoutValidation(search_field);
    showFieldWithoutValidation(start_time_field);
    showFieldWithoutValidation(end_time_field);
}
