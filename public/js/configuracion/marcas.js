console.log("Comprobante JS");

var table = $(".bodyMarcas").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${base_url}/almacen/marcas`,

    columns: [
        {
            data: "idMarcas",
            name: "idMarcas",
        },
        {
            data: "nomMarcas",
            name: "nomMarcas",
        },
        {
            data: "condicionMarcas",
            name: "condicionMarcas",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                var condicion = `${row.condicionMarcas}`;
                console.log(condicion, "valor condicion");
                if (condicion == 1) {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idMarcas}" class="statusM form-check-input" id="customSwitch1" checked>
                </div>`;
                } else {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idMarcas}" class="statusM form-check-input" id="customSwitch1">
                </div>`;
                }
            },
        },
        {
            data: "idMarcas",
            name: "idMarcas",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                return `<a href="#"  data-id="${row.idMarcas}" class="editarm fas fa-pencil-alt text-info"></a>`;
            },
        },
    ],
    language: {
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>",
        },
    },
    drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
    },
});

$(document).on("click", ".nuevom", function () {
    const tabla = $(this).data("id");
    console.log("abrir modal");
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("guardarm");
    $("#formConfigurar .tituloModal").text("Nueva Marca");
    $("#formConfigurar .inputNombre").text("Nombre Marca");
    let datos = $("#formConfigurar").serialize();

    console.log(datos, "datis");
    $("#modalConfigurar").modal("show");
});

$(document).on("click", ".guardarm", function () {
    let datos = $("#formConfigurar").serialize();
    console.log("guardar datos");
    console.log(datos);
    $.ajax({
        type: "post",
        url: `${base_url}/almacen/marcas`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#formConfigurar").trigger("reset");
            $("#btn_enviar").removeClass("guardarm");
            $("#btn_enviar").addClass("guardar");
            $("#modalConfigurar").modal("hide");
            $(".bodyMarcas").DataTable().ajax.reload();
            console.log("datos guardados");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error_status(jqXHR)
        },
        fail: function () {
            //fail()
        },
    });
});

$(document).on("click", ".editarm", function () {
    const id = $(this).data("id");

    console.log("abrir modal editar", id);
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("modificarm");

    $.ajax({
        type: "get",
        url: `${base_url}/almacen/marcas/editar/${id}`,
        dataType: "json",
        success: function (response) {
            $("#formConfigurar #idConfigurar").val(response.data.idMarcas);
            $("#formConfigurar #inputNombre").val(response.data.nomMarcas);
            $("#formConfigurar .tituloModal").text("Editar Marca");
            let datos = $("#formConfigurar form").serialize();
            console.log(datos);
            $("#modalConfigurar").modal("show");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error_status(jqXHR)
        },
        fail: function () {
            //fail()
        },
    });
});

$(document).on("click", ".modificarm", function () {
    const id = $(this).data("#idConfigurar");
    let datos = $("#formConfigurar").serialize();
    console.log(id, "guardar modificaciones");

    console.log(datos);

    $.ajax({
        type: "put",
        url: `${base_url}/almacen/marcas/modificar`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#btn_enviar").removeClass("modificarm");
            $("#btn_enviar").addClass("guardar");

            $("#formConfigurar").trigger("reset");
            $("#modalConfigurar").modal("hide");
            $(".bodyMarcas").DataTable().ajax.reload();
            console.log(response, "ACTUALIZO");
            Swal.fire({
                type: "success",
                title: "OK",
                text: response.message,
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error de programacion");
            Swal.fire({
                type: "error",
                title: "Oops...",
                text: "ejemplosdsfs!",
            });
        },
        fail: function () {
            console.log("error servidor");
        },
    });
});
$(document).on("click", ".deletem", function () {
    const id = $(this).data("id");
    console.log(id, "HOLA recibi info DELETE");
    $("#btnDelete").removeClass("btnDelete");
    $("#btnDelete").addClass("btnDeletem");
    $("#formDelete").modal("show");
    $(".btnDeletem").click(function () {
        $.ajax({
            type: "delete",
            url: `${base_url}/almacen/marcas/borrar/${id}`,
            dataType: "json",

            success: function (response) {
                console.log(response, "LLEGO DATA?");
                $(".bodyMarcas").DataTable().ajax.reload();
                $("#btnDelete").removeClass("btnDeletem");
                $("#btnDelete").addClass("btnDelete");
                $("#formDelete").modal("hide");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //error_status(jqXHR)
                console.log(response, "ERROR?");
            },
            fail: function () {
                //fail()
            },
        });
    });
});
$(document).on("change", ".statusM", function () {
    const id = $(this).data("id");
    var estado = $(this).prop("checked") == true ? 1 : 0;
    console.log(estado, "EL ESTADO DEL SWITCH");
    $.ajax({
        type: "delete",
        url: `${base_url}/almacen/marcas/borrar/${id}`,
        dataType: "json",
        data: { condicionMarcas: estado, idMarcas: id },

        success: function (response) {
            console.log(response, "LLEGO DATA?");
            $(".bodyMarcas").DataTable().ajax.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error_status(jqXHR)
            console.log(response, "ERROR?");
        },
        fail: function () {
            //fail()
        },
    });
});
