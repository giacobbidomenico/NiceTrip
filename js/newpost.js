function loadMapScenario() {
    Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', {
        callback: onLoad,
        errorCallback: onError
    });
    function onLoad() {
        var options = { maxResults: 5, businessSuggestions: true };
        var manager = new Microsoft.Maps.AutosuggestManager(options);
        manager.attachAutosuggest('#searchBox', '#searchBoxContainer', selectedSuggestion);
    }
    function onError(message) {
        console.log(message);
    }
    function selectedSuggestion(suggestionResult) {
        console.log(suggestionResult);
    }
    
}