const add_destination_button = document.getElementById("add-destination-button");
const search_field = document.getElementById("search-field");
const destination_list_container = document.getElementById("destination-list-container");
let lastResult = null;

add_destination_button.addEventListener("click", event=> addDestination());


function autosuggest() {
    Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', {
        callback: onLoad,
        errorCallback: onError
    });

    function onLoad() {
        var options = { maxResults: 5, businessSuggestions: true };
        var manager = new Microsoft.Maps.AutosuggestManager(options);
        manager.attachAutosuggest('#search-field', '#search-field-container', selectedSuggestion);
    }

    function onError(message) {
        lastResult = null;
    }

    function selectedSuggestion(suggestionResult) {
        lastResult = suggestionResult;
    }
}


function addDestination() {
    if(lastResult === null || search_field.value === '') {
        return;
    }

    if(destination_list_container.getElementsByTagName("ul").length === 0) {
        destination_list_container.innerHTML = '<ul id="destinations-list" class="list-group"></ul>';
    }

    const destinations_list = document.getElementById("destinations-list");

    if(destinations_list.getElementsByTagName("li").length !== 0 && destinations_list.lastElementChild.value === search_field.value) {
        console.log(destination_list_container.lastElementChild);
        return;
    }

    destinations_list.innerHTML += `<li class="list-group-item" data-value="${lastResult.entityId}">${search_field.value}</li>`;
    lastResult = null;
}