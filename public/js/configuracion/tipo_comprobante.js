console.log("Comprobante JS");

var table = $(".bodyTipoComprobante").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${base_url}/almacen/comprobante`,

    columns: [
        {
            data: "idTipoComprobante",
            name: "idTipoComprobante",
        },
        {
            data: "nomTipoComprobante",
            name: "nomTipoComprobante",
        },
        {
            data: "condicionTipo_Comprobante",
            name: "condicionTipo_Comprobante",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                var condicion = `${row.condicionTipo_Comprobante}`;
                console.log(condicion, "valor condicion");
                if (condicion == 1) {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idTipoComprobante}" class="statusTC form-check-input" id="customSwitch1" checked>
                </div>`;
                } else {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idTipoComprobante}" class="statusTC form-check-input" id="customSwitch1">
                </div>`;
                }
            },
        },
        {
            data: "idTipoComprobante",
            name: "idTipoComprobante",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                return `<a href="#"  data-id="${row.idTipoComprobante}" class="editartc fas fa-pencil-alt text-info"></a>`;
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

$(document).on("click", ".nuevotc", function () {
    const tabla = $(this).data("id");
    console.log("abrir modal");
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("guardartc");
    $("#formConfigurar .tituloModal").text("Nuevo Tipo Comprobante");
    $("#formConfigurar .inputNombre").text("Nombre Tipo Comprobante");
    let datos = $("#formConfigurar").serialize();

    console.log(datos, "datis");
    $("#modalConfigurar").modal("show");
});

$(document).on("click", ".guardartc", function () {
    let datos = $("#formConfigurar").serialize();
    console.log("guardar datos");
    console.log(datos);
    $.ajax({
        type: "post",
        url: `${base_url}/almacen/tipocomprobante`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#formConfigurar").trigger("reset");
            $("#btn_enviar").removeClass("guardartc");
            $("#btn_enviar").addClass("guardar");
            $("#modalConfigurar").modal("hide");
            $(".bodyTipoComprobante").DataTable().ajax.reload();
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

$(document).on("click", ".editartc", function () {
    const id = $(this).data("id");

    console.log("abrir modal editar", id);
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("modificartc");

    $.ajax({
        type: "get",
        url: `${base_url}/almacen/tipocomprobante/editar/${id}`,
        dataType: "json",
        success: function (response) {
            $("#formConfigurar #idConfigurar").val(
                response.data.idTipoComprobante
            );
            $("#formConfigurar #inputNombre").val(
                response.data.nomTipoComprobante
            );
            $("#formConfigurar .tituloModal").text("Editar Tipo Comprobante");
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

$(document).on("click", ".modificartc", function () {
    const id = $(this).data("#idConfigurar");
    let datos = $("#formConfigurar").serialize();
    console.log(id, "guardar modificaciones");

    console.log(datos);

    $.ajax({
        type: "put",
        url: `${base_url}/almacen/tipocomprobante/modificar`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#btn_enviar").removeClass("modificartc");
            $("#btn_enviar").addClass("guardar");

            $("#formConfigurar").trigger("reset");
            $("#modalConfigurar").modal("hide");
            $(".bodyTipoComprobante").DataTable().ajax.reload();
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
$(document).on("click", ".deletetc", function () {
    const id = $(this).data("id");
    console.log(id, "HOLA recibi info DELETE");
    $("#btnDelete").removeClass("btnDelete");
    $("#btnDelete").addClass("btnDeletetc");
    $("#formDelete").modal("show");
    $(".btnDeletetc").click(function () {
        $.ajax({
            type: "delete",
            url: `${base_url}/almacen/tipocomprobante/borrar/${id}`,
            dataType: "json",

            success: function (response) {
                console.log(response, "LLEGO DATA?");
                $(".bodyTipoComprobante").DataTable().ajax.reload();
                $("#btnDelete").removeClass("btnDeletetc");
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
$(document).on("change", ".statusTC", function () {
    const id = $(this).data("id");
    var estado = $(this).prop("checked") == true ? 1 : 0;
    console.log(estado, "EL ESTADO DEL SWITCH", id, "EL IDDD");
    $.ajax({
        type: "delete",
        url: `${base_url}/almacen/tipocomprobante/borrar/${id}`,
        dataType: "json",
        data: { condicionTipo_Comprobante: estado, idTipoComprobante: id },

        success: function (response) {
            console.log(response, "LLEGO DATA?");
            $(".bodyTipoComprobante").DataTable().ajax.reload();
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
