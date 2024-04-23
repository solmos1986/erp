// autoseleccion paquete por default
var detalleCuentas = [];
$(document).ready(function () {
    /* $("#duracionPaquete").val(
        $("#idPaquete").find(":selected").data("duracion")
    );
    $("#costoPaquete").val($("#idPaquete").find(":selected").data("costo"));
    setFecha(moment().format("DD/MM/YYYY")); */
});

/* $(document).on("change", "#idPaquete", function () {
    $("#costoPaquete").val($("#idPaquete").find(":selected").data("costo"));
    $("#duracionPaquete").val(
        $("#idPaquete").find(":selected").data("duracion")
    );
    setFecha($("#fechaInicio").val());
    calcularImpuesto();
}); */

/* $(document).on("change", "#idTipoComprobante", function () {
    console.log("OnChangeeee");
    calcularImpuesto();
}); */
/* function calcularImpuesto() {
    var impuesto = $("#idTipoComprobante").find(":selected").data("value");
    console.log(impuesto, "MPUESTOOOOOO");
    var costoIns = $("#costoPaquete").val();
    var tImpuesto = impuesto * costoIns;
    $("#impuestoInscripcion").val(tImpuesto);
} */

/* $("#fechaInicio").flatpickr({
    enableTime: false,
    dateFormat: "d/m/Y",
    defaultDate: moment().format("DD/MM/YYYY"), //defaul fecha actual
    onChange: function (selectedDates, dateStr, instance) {
        setFecha(dateStr);
    },
}); */

/* function setFecha(fechaInicio) {
    var nueva_fecha = moment(fechaInicio, "DD/MM/YYYY")
        .add($("#duracionPaquete").val(), "months")
        .format("DD/MM/YYYY");
    $("#fechaFin").val(nueva_fecha);
} */

//PDF
function verPDF(id) {
    var frame = $("#iframePDF");
    var ahref = $("#cancelPDF");
    //LOADER
    ajax(`${base_url}/comercial/inscripcion-pdf/${id}`, "GET").then(
        (response) => {
            var src = `data:application/pdf;base64,${response.data}`;
            $("#modalImprimir .modal-title").text("RECIBO DE INSCRIPCION");
            ahref.attr("href", `${base_url}/comercial/inscripcion/index`);
            frame.attr("src", `data:application/pdf;base64,${response.data}`);
            $("#modalImprimir").modal("show");
            $("#iframePDF").data("url", response.data);
        }
    );
}
$(document).on("click", ".imprimir", function () {
    const base64 = $("#iframePDF").data("url");
    printJS({
        printable: base64,
        type: "pdf",
        base64: true,
        onPrintDialogClose: () => {
            $("#modalImprimir").modal("hide");
            window.location = "index";
        },
    });
});

//STORE
$(document).on("click", ".procesar", function () {
    var dato = {
        idTipoIngreso: 3,
        idCliente: $("#idCliente").val(),
        idTipoPago: $("#idTipoPago").val(),
        idTipoComprobante: $("#idTipoComprobante").val(),
        numeroComprobante: $("#numComprobante").val(),
        descripcion: $("#descripcion").val(),
        totalIngreso: $("#totalIngreso").val(),
        fechaIngreso: $("#fechaIngreso").val(),
        estado: 1,
        idUsuario: $("#idUsuario").val(),
    };
    $.ajax({
        type: "post",
        url: `${base_url}/contabilidad/ingresos/store`,
        dataType: "json",
        data: $("#form_inscripcion").serialize(),
        success: function (response) {
            // window.location = "index";
            Swal.fire({
                title: "Desea imprimir?",
                text: "Esta proceso es irreversible",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, imprimir!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "index";
                    /* verPDF(response.data); */
                } else {
                    window.location = "index";
                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            SwallErrorValidate(response);
        },
        fail: function () {},
    });
});

const onChangeSelect2Cliente = function (e) {
    var newOption = new Option(
        e.params.data.docCliente,
        e.params.data.id,
        false,
        false
    );
    $("#docCliente").append(newOption).trigger("change");
    $("#docCliente").val(e.params.data.id).trigger("change");
};
select2(
    "#idCliente",
    `${base_url}/clientes/buscar-nombre`,
    "GET",
    onChangeSelect2Cliente
);

const onChangeSelect2DocCliente = function (e) {
    var newOption = new Option(
        e.params.data.nomCliente,
        e.params.data.id,
        false,
        false
    );
    $("#idCliente").append(newOption).trigger("change");
    $("#idCliente").val(e.params.data.id).trigger("change");
};
select2(
    "#docCliente",
    `${base_url}/clientes/buscar-ci`,
    "GET",
    onChangeSelect2DocCliente
);
$(document).on("click", ".add_cuenta", function () {
    let posicion = $(this).data("id");
    console.log(posicion, "IDDDD");
    let producto = productos[posicion];
    console.log(producto, "PRODUCTOOOO");
    const validador = detalleVenta.find(
        (item) => item.idProducto == producto.idProducto
    );

    if (validador == undefined) {
        detalleVenta.push({
            ...producto,
            cantidad: 1,
            precio: producto.precioVentaProducto,
            precioTotal: parseFloat(producto.precioVentaProducto * 1),
        });
    } else {
        detalleVenta.map((item) => {
            if (item.idProducto == producto.idProducto) {
                item.cantidad = item.cantidad + 1;
                item.precioTotal = parseFloat(
                    item.precio * item.cantidad
                    /* .repleace(",", ".") */
                ) /* .toFixed(2) */;
            }
        });
    }
    console.log("detalleVentaAddCard", detalleVenta);
    SumaTotales();
    renderDetalleVenta();
});
