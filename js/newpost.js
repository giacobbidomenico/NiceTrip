const add_destination_button = document.getElementById("add-destination-button");
const search_field = document.getElementById("search-field");
const destinations_list = document.getElementById("destinations-list");

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
        console.log(message);
    }
    function selectedSuggestion(suggestionResult) {
        console.log(suggestionResult);
    }
    
}

function addDestination() {
    if(search_field.value !== '') {
        destinations_list.innerHTML += `<li class="list-group-item">${search_field.value}</li>`;
    }
}