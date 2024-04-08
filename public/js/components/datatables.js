function dataTable(element, url, columns) {
    var dataTable = element.DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: url,
            data: [],
            async: true,
            error: function (xhr, error, code) {
                error_status(xhr)
            }
        },
        columns: columns,
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            //processing: "Procesando...",
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            search: "Buscar:",
            loadingRecords: "Cargando...",
            searchPanes: {
                clearMessage: "Borrar todo",
                collapse: {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                count: "{total}",
                countFiltered: "{shown} ({total})",
                emptyPanes: "Sin paneles de búsqueda",
                loadMessage: "Cargando paneles de búsqueda",
                title: "Filtros Activos - %d",
                showMessage: "Mostrar Todo",
                collapseMessage: "Colapsar Todo"
            },
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    return dataTable;
}
