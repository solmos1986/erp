console.log("TipoPago");

var table = $(".bodyFormasPagos").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${base_url}/almacen/configurar`,

    columns: [
        {
            data: "idTipoPago",
            name: "idTipoPago",
        },
        {
            data: "nomTipoPago",
            name: "nomTipoPago",
        },
        {
            data: "condicionTipoPago",
            name: "condicionTipoPago",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                var condicion = `${row.condicionTipoPago}`;
                console.log(condicion, "valor condicion");
                if (condicion == 1) {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idTipoPago}" class="statusFP form-check-input" id="customSwitch1" checked>
                </div>`;
                } else {
                    return `<div class="form-check form-switch"><input type="checkbox" data-id="${row.idTipoPago}" class="statusFP form-check-input" id="customSwitch1">
                </div>`;
                }
            },
        },
        {
            data: "idTipoPago",
            name: "idTipoPago",
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                console.log("LLEGO FILA", data);
                return `<a href="#"  data-id="${row.idTipoPago}" class="editartp fas fa-pencil-alt text-info"></a>`;
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

$(document).on("click", ".nuevotp", function () {
    const tabla = $(this).data("id");
    console.log("abrir modal");
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("guardartp");
    $("#formConfigurar .tituloModal").text("Nuevo Forma Pago");
    $("#formConfigurar .inputNombre").text("Nombre Forma Pago");
    let datos = $("#formConfigurar").serialize();

    console.log(datos, "datis");
    $("#modalConfigurar").modal("show");
});

$(document).on("click", ".guardartp", function () {
    let datos = $("#formConfigurar").serialize();
    console.log("guardar datos");
    console.log(datos);
    $.ajax({
        type: "post",
        url: `${base_url}/almacen/tipopago`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#formConfigurar").trigger("reset");
            $("#btn_enviar").removeClass("guardartp");
            $("#btn_enviar").addClass("guardar");
            $("#modalConfigurar").modal("hide");
            $(".bodyFormasPagos").DataTable().ajax.reload();
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

$(document).on("click", ".editartp", function () {
    const id = $(this).data("id");

    console.log("abrir modal editar", id);
    $("#btn_enviar").removeClass("guardar");
    $("#btn_enviar").addClass("modificartp");

    $.ajax({
        type: "get",
        url: `${base_url}/almacen/tipopago/editar/${id}`,
        dataType: "json",
        success: function (response) {
            $("#formConfigurar #idConfigurar").val(response.data.idTipoPago);
            $("#formConfigurar #inputNombre").val(response.data.nomTipoPago);
            $("#formConfigurar .tituloModal").text("Editar Forma Pago");
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

$(document).on("click", ".modificartp", function () {
    const id = $(this).data("#idConfigurar");
    let datos = $("#formConfigurar").serialize();
    console.log(id, "guardar modificaciones");

    console.log(datos);

    $.ajax({
        type: "put",
        url: `${base_url}/almacen/tipopago/modificar`,
        dataType: "json",
        data: $("#formConfigurar").serialize(),
        success: function (response) {
            $("#btn_enviar").removeClass("modificartp");
            $("#btn_enviar").addClass("guardar");

            $("#formConfigurar").trigger("reset");
            $("#modalConfigurar").modal("hide");
            $(".bodyFormasPagos").DataTable().ajax.reload();
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
$(document).on("click", ".deletetp", function () {
    const id = $(this).data("id");
    console.log(id, "HOLA recibi info DELETE");
    $("#btnDelete").removeClass("btnDelete");
    $("#btnDelete").addClass("btnDeletetp");
    $("#formDelete").modal("show");
    $(".btnDeletetp").click(function () {
        $.ajax({
            type: "delete",
            url: `${base_url}/almacen/tipopago/borrar/${id}`,
            dataType: "json",

            success: function (response) {
                console.log(response, "LLEGO DATA?");
                $(".bodyFormasPagos").DataTable().ajax.reload();
                $("#btnDelete").removeClass("btnDeletetp");
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
$(document).on("change", ".statusFP", function () {
    const id = $(this).data("id");
    var estado = $(this).prop("checked") == true ? 1 : 0;
    console.log(estado, "EL ESTADO DEL SWITCH");
    $.ajax({
        type: "delete",
        url: `${base_url}/almacen/tipopago/borrar/${id}`,
        dataType: "json",
        data: { condicionTipoPago: estado, idTipoPago: id },

        success: function (response) {
            console.log(response, "LLEGO DATA?");
            $(".bodyFormasPagos").DataTable().ajax.reload();
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
