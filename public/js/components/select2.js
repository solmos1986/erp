

function select2(idComponent, url, method, onSelect) {
    $(idComponent).select2({
        //theme: "bootstrap4",
        width: '100%',
        ajax: {
            url: url,
            type: method,
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
        language: {
            noResults: function () {
                return "No hay resultado";
            },
            searching: function () {
                return "Buscando..";
            }
        }
    }).on("select2:select", onSelect);
}