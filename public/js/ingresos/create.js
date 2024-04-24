var productos = [];
var stock = 0;
var detalleVenta = [];

$(document).ready(function () {
    $("#paginate_producto").hide();
    CargarProducto();
});
function CargarProducto() {
    $("#loader_producto").show();
    $("#paginate_producto").hide();
    ajax(`${base_url}/producto`, "GET").then((response) => {
        if (response.status == "1") {
            $("#loader_producto").hide();
            $("#paginate_producto").show();
            productos = response.data;
            stock = response.stock;
            renderCard();
        } else {
            SwallErrorValidate(response);
        }
    });
}
function renderCard() {
    $("#list_cards").html("");
    let cards = ``;
    productos.map((item, i) => {
        cards += `
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0" >
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface" >
                                    <img src="${base_url}/imagenes/productos/${item.imagenProducto}"
                                        class="w-100" />
                                    <a href="#!">
                                        <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                        </div>
                                    </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div>
                                        <h5 class="text-truncate">${item.nomProducto}</h5>
                                    </div>

                                    <div class="mt-1 mb-0 text-muted small">
                                        <span>Caract.1</span>
                                        <span class="text-primary"> • </span>
                                        <span>Caract.2</span>
                                        <span class="text-primary"> • </span>
                                        <span>Caract.3<br /></span>
                                    </div>
                                    <div class="mb-2 text-muted small">
                                        <span>Categoria</span>
                                        <span class="text-primary"> • </span>
                                        <span>SubCate</span>
                                        <span class="text-primary"> • </span>
                                        <span>Tipo<br /></span>
                                    </div>
                                    <p class="texto mb-4 mb-md-0">
                                    There are many variations of passages of Lorem Ipsum available, but the
                                    majority have suffered alteration in some form, by injected humour, or
                                    randomised words which don't look even slightly believable.
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start ">
                                    <div class="d-flex flex-row justify-content-center align-items-center mb-0">
                                        <h4 class="me-1">Bs. ${item.precio_venta}</h4>
                                    </div>
                                        <div class="d-flex flex-row justify-content-center align-items-center mb-0">
                                       <h5 class="me-1">Stock: ${item.stock}</h5>
                                    </div>
                                    <div class="d-flex flex-column mt-4">
                                        <button data-id="${i}" class="add_product btn btn-outline-primary btn-sm mt-2 " type="button">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                `;
    });
    $("#list_cards").append(cards);
}
$(document).on("click", ".add_product", function () {
    let posicion = $(this).data("id");
    let producto = productos[posicion];
    const validador = detalleVenta.find(
        (item) => item.idProducto == producto.idProducto
    );

    if (validador == undefined) {
        detalleVenta.push({
            ...producto,
            cantidad: 1,
            precio: producto.precio_venta,
            precioTotal: parseFloat(producto.precio_venta * 1),
        });
    } else {
        detalleVenta.map((item) => {
            if (item.idProducto == producto.idProducto) {
                item.cantidad = item.cantidad + 1;
                item.precioTotal = parseFloat(item.precio * item.cantidad);
            }
        });
    }
    console.log("detalleVentaAddCard", detalleVenta);
    SumaTotales();
    renderDetalleVenta();
});

function renderDetalleVenta() {
    console.log("detalleVentaAddCard", detalleVenta);
    $("#dtVE").html("");
    let html = ``;
    detalleVenta.forEach((item, i) => {
        html += `
            <tr id="fila${i}">
                <td>
                    <p class="h6">${item.codProducto} - ${item.nomProducto}</p>
                    <input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control" placeholder="0" style="width: 90px;">
                </td>
                <td>
                    <input type="number" min="1" value="${item.cantidad}" data-id="${i}" name="cantidad[]" class="cantidad form-control form-control-sm" placeholder="0" style="width: 90px;">
                </td>
                <td>
                    <input type="number" min="1" value="${item.precio_venta}" data-id="${i}" name="precio_venta[]" class="precio form-control form-control-sm" placeholder="0" style="width: 90px;">
                </td>
                <td class="total${i}">${item.precioTotal}</td>
                <td class="delete${i}"><i data-id="${i}"  class="deleteItem fas fa-trash-alt text-danger"></i></td>
            </tr>
            `;
    });
    $("#dtVE").append(html);
}
$(document).on("keyup change", ".precio", function () {
    let precio = $(this).val();
    let posicion = $(this).data("id");
    /* let td = '#pro' + posicion
    let colum = $(this).data('td');*/
    console.log(precio, posicion, "PROBANDO");
    let total = 0;
    detalleVenta.map((item, i) => {
        if (i == posicion) {
            item.precioTotal = parseFloat(precio * item.cantidad);
            item.precio_venta = parseFloat(precio);
            $(`.total${posicion}`).text(item.precioTotal); //restringir cantidad decimales
        }
        total += item.precioTotal;
    });

    console.log(detalleVenta, "Mapeando Precio");
    SumaTotales();
});
$(document).on("keyup change", ".cantidad", function () {
    let cantidad = $(this).val();
    let posicion = $(this).data("id");
    console.log(cantidad, posicion);
    detalleVenta.map((item, i) => {
        if (i == posicion) {
            item.precioTotal = parseFloat(item.precio * cantidad);
            item.cantidad = parseFloat(cantidad);
            $(`.total${posicion}`).text(item.precioTotal);
        }
    });
    console.log(detalleVenta, "Mapeando cantidad");
    SumaTotales();
});

var comprobante = document.getElementById("idTipoComprobante");
comprobante.addEventListener("change", function () {
    console.log("Comprobante cambio", comprobante.value);
    calcularImpuesto();
});

function calcularImpuesto() {
    var impuesto = comprobante.value;
    var costoIns = $("#TotalCart").val();
    var tImpuesto = impuesto * costoIns;
    $("#impuestoIngreso").val(tImpuesto);
    console.log(tImpuesto, "Valor Comprobante");
}

function SumaTotales() {
    let tabla = document.getElementById("dtVE");
    let total = 0;
    detalleVenta.map((item, i) => {
        total += parseFloat(item.precioTotal);
        $("#TotalCart").val(total);
    });
    $("#TotalCart").html(total);
    calcularImpuesto();
}
$(document).on("click", ".deleteItem", function () {
    let posicion = $(this).data("id");
    let tr = document.querySelector("#fila" + posicion);
    tr.remove();
    console.log("eliminando elemento", posicion);
    detalleVenta.splice(posicion, 1);
    console.log("resultado", detalleVenta);
    SumaTotales();
    //renderDetalleVenta()
});

$(document).on("click", ".procesar", function () {
    const btn = $(this);

    if ($("#impuestoIngreso").val() == 0) {
        var idTC = 1;
    } else {
        var idTC = 2;
    }
    var dato = {
        detalleVenta: detalleVenta,
        idCliente: $("#idCliente").val(),
        idTipoPago: $("#idTipoPago").val(),
        idTipoComprobante: idTC,
        fechaIngreso: $("#fechaVenta").val(),
        impuestoIngreso: $("#impuestoIngreso").val(),
        estadoIngreso: 1,
        idUsuario: $("#idVendedor").val(),
    };

    $.ajax({
        type: "post",
        url: `${base_url}/comercial/venta`,
        dataType: "json",
        data: dato,
        success: function (response) {
            btn.prop("disabled", true);
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
                    verPDF(response.data);
                } else {
                    window.location = "index";
                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error de programacion");
            Swal.fire({
                type: "error",
                title: "Oops...",
                text: "ejemplos!",
            });
        },
        fail: function () {
            console.log("error servidor");
        },
    });
});

function verPDF(id) {
    var frame = $("#iframePDF");
    var ahref = $("#cancelPDF");
    //LOADER
    $.ajax({
        type: "GET",
        url: `${base_url}/comercial/venta-pdf/${id}`,
        dataType: "json",
        success: function (response) {
            var src = `data:application/pdf;base64,${response.data}`;
            $("#modalImprimir .modal-title").text("RECIBO DE VENTA");
            ahref.attr("href", "{{ url('comercial/venta/index') }}");
            frame.attr("src", `data:application/pdf;base64,${response.data}`);
            $("#modalImprimir").modal("show");
            $("#iframePDF").data("url", response.data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error de programacion");
            Swal.fire({
                type: "error",
                title: "Oops...",
                text: "ejemplo!",
            });
        },
        fail: function () {},
    });
}

$(document).on("click", ".nuevoCli", function () {
    $("#formCliente").modal("show");
});

$(document).on("click", ".guardar", function () {
    $.ajax({
        type: "post",
        url: "{{ route('store.cliente') }}",
        dataType: "json",
        data: {
            nomCliente: $("#nomCliente").val(),
            docCliente: $("#docCliente").val(),
            tel1Cliente: $("#tel1Cliente").val(),
            tel2Cliente: $("#tel2Cliente").val(),
            dirCliente: $("#dirCliente").val(),
            mailCliente: $("#mailCliente").val(),
            imagen: $("#base64").val(),
        },
        success: function (response) {
            console.log(response.img, "LLEGO NAMEEEEE?");
            console.log(response.data, "LLEGO NAMEEEEE?");
            $("#formCliente").modal("hide");
            /*  $('.dtCliente').DataTable().ajax.reload(); */
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error_status(jqXHR)
            //console.log(response, "ERROR?")
        },
        fail: function () {
            //fail()
        },
    });
});
$(document).on("click", ".imprimir", function () {
    const base64 = $("#iframePDF").data("url");
    printJS({
        printable: base64,
        type: "pdf",
        base64: true,
        onPrintDialogClose: () => {
            console.log(" detecion de cierre");
        },
    });
});

//detectar code barra
$(document).on("change", "#code_barra", function () {
    const serie = $(this);
    ajax(`${base_url}/almacen/producto/buscar-serie`, "POST", {
        serie: serie.val(),
    }).then((response) => {
        if (response.status == "1") {
            const producto = response.data;
            const validador = detalleVenta.find(
                (item) => item.idProducto == producto.idProducto
            );

            if (validador == undefined) {
                detalleVenta.push({
                    ...producto,
                    cantidad: 1,
                    precio: producto.precio_venta,
                    precioTotal: parseFloat(producto.precio_venta * 1),
                });
            } else {
                detalleVenta.map((item) => {
                    if (item.idProducto == producto.idProducto) {
                        item.cantidad = item.cantidad + 1;
                        item.precioTotal = parseFloat(
                            item.precio * item.cantidad
                        );
                    }
                });
            }
            console.log("detalleVentaAddCard", detalleVenta);
            SumaTotales();
            renderDetalleVenta();
            //SwallSuccess(response.message)
            serie.val("");
        } else {
            //SwallErrorValidate(response);
            serie.val("");
        }
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
