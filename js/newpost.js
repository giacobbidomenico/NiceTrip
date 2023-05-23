const add_destination_button = document.getElementById("add-destination-button");
const search_field = document.getElementById("search-field");
const destinations_table_container = document.getElementById("destinations-table-container");
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

    if(destinations_table_container.getElementsByTagName("table").length === 0) {
        destinations_table_container.innerHTML = `
            <table id="destinations-table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End time</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        `;
    }

    const destinations_table = document.getElementById("destinations-table");

    if(destinations_table.rows.length > 1) {
        const lastElement = destinations_table.rows[ destinations_table.rows.length - 1 ].querySelectorAll("[data-type=name-destination]")[0];

        if(lastElement.getAttribute("data-value") === lastResult.entityId) {
            return;
        }
    }

    destinations_table.tBodies[0].innerHTML += `
        <tr>
            <th scope="row"></th>
            <td data-type="name-destination" data-value='${lastResult.entityId}'>${search_field.value}</td>
            <td></td>
            <td></td>
            <td>
                <button class="btn btn-primary-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg>
                </button>
            </td>
            <td>
                <button class="btn btn-primary-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </td>
            <td>
                <button class="btn btn-primary-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                </button>
            </td>
        </tr>
    `;

    search_field.value = '';
    lastResult = null;
}