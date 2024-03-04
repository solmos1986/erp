console.log("Estado Pedido JS");

var table = $(".bodyEstadosPedidos").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${base_url}/almacen/configurar/index`,

    columns: [
        {
            data: "idEstadoInOut",
            name: "idEstadoInOut",
        },
        {
            data: "nomEstadoInOut",
            name: "nomEstadoInOut",
        },
        {
            data: "condicionEstadoInOut",
            name: "condicionEstadoInOut",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                var condicion = `${row.condicionEstadoInOut}`;
                console.log(condicion, "valor condicion");
                if (condicion == 1) {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idEstadoInOut}" class="statusEP form-check-input" id="customSwitch1" checked>
                </div>`;
                } else {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idEstadoInOut}" class="statusEP form-check-input" id="customSwitch1">
                </div>`;
                }
            },
        },
        {
            data: "idEstadoInOut",
            name: "idEstadoInOut",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                return `<a href="#"  data-id="${row.idEstadoInOut}" class="editar fas fa-pencil-alt text-info"></a>`;
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

$(document).on("click", ".nuevoep", function () {
    const tabla = $(this).data("id");
    console.log("abrir modal");

    $("#formConfigurar .tituloModal").text("Nuevo Estado");
    $("#formConfigurar .inputNombre").text("Nombre Estado");
    let datos = $("#formConfigurar").serialize();

    console.log(datos, "datis");
    $("#modalConfigurar").modal("show");
});

$(document).on("click", ".guardar", function () {
    let datos = $("#formConfigurar").serialize();
    console.log("guardar datos");
    console.log(datos);
    $.ajax({
        type: "post",
        url: `${base_url}/almacen/configurar/store`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#formConfigurar").trigger("reset");
            $("#modalConfigurar").modal("hide");
            $(".bodyEstadosPedidos").DataTable().ajax.reload();
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

$(document).on("click", ".editar", function () {
    const id = $(this).data("id");

    console.log("abrir modal editar", id);
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("modificar");

    $.ajax({
        type: "get",
        url: `${base_url}/almacen/configurar/editar/${id}`,
        dataType: "json",
        success: function (response) {
            $("#formConfigurar #idConfigurar").val(response.data.idEstadoInOut);
            $("#formConfigurar #inputNombre").val(response.data.nomEstadoInOut);
            $("#formConfigurar .tituloModal").text("Editar Estado");
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

$(document).on("click", ".modificar", function () {
    const id = $(this).data("#idConfigurar");
    let datos = $("#formConfigurar").serialize();
    console.log(id, "guardar modificaciones");

    console.log(datos);

    $.ajax({
        type: "put",
        url: `${base_url}/almacen/configurar/modificar`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#btn_enviar").removeClass("modificar");
            $("#btn_enviar").addClass("guardar");

            $("#formConfigurar").trigger("reset");
            $("#modalConfigurar").modal("hide");
            $(".bodyEstadosPedidos").DataTable().ajax.reload();
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
$(document).on("click", ".delete", function () {
    const id = $(this).data("id");
    console.log(id, "HOLA recibi info DELETE");
    $("#formDelete").modal("show");
    $(".btnDelete").click(function () {
        $.ajax({
            type: "delete",
            url: `${base_url}/almacen/configurar/borrar/${id}`,
            dataType: "json",

            success: function (response) {
                console.log(response, "LLEGO DATA?");
                $(".bodyEstadosPedidos").DataTable().ajax.reload();
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
$(document).on("change", ".statusEP", function () {
    const id = $(this).data("id");
    var estado = $(this).prop("checked") == true ? 1 : 0;
    console.log(estado, "EL ESTADO DEL SWITCH");
    $.ajax({
        type: "delete",
        url: `${base_url}/almacen/configurar/borrar/${id}`,
        dataType: "json",
        data: { condicionEstadoInOut: estado, idEstadoInOut: id },

        success: function (response) {
            console.log(response, "LLEGO DATA?");
            $(".bodyEstadosPedidos").DataTable().ajax.reload();
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
