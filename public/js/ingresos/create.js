var productos = [];
var detalleVenta = [];

$(document).on("click", ".addCart", function () {
    let posicion = $(this).data("id");
    let producto = productos[posicion];
    const validador = detalleVenta.find(
        (item) => item.idProducto == producto.idProducto
    );
    detalleVenta.push({
        ...producto,
        serie: '',
        precio: producto.precioVenta,
        precioTotal: parseFloat(producto.precioVenta * 1),
    });
    console.log(detalleVenta)
    /*  if (validador == undefined) {
         
     } else {
         detalleVenta.map((item) => {
             if (item.idProducto == producto.idProducto) {
                 item.cantidad = item.cantidad + 1;
                 item.precioTotal = parseFloat(item.precio * item.cantidad);
             }
         }); 
     }*/
    renderDetalleVenta();
    SumaTotales();
});

function renderDetalleVenta() {
    $("#dtVE").html("");
    let html = ``;
    detalleVenta.forEach((item, i) => {
        html += `
            <tr id="fila${i}">
                <td>
                    <p class='descripcion'><small>${item.codProducto} - ${item.nomProducto}</small></p>
                    <input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control">
                </td>
                <td>
                    <input type="text" value="${item.serie}" data-id="${i}" name="serie[]" class="serie form-control form-control-sm">
                </td>
                <td>
                    <input type="number" min="1" value="${item.precioVenta}" data-id="${i}" name="precioVenta[]" class="precio form-control form-control-sm" disabled>
                </td>
                <td class="total${i}">${item.precioTotal}</td>
                <td class="delete${i}"><i data-id="${i}"  class="deleteItem fas fa-trash-alt text-danger pointer"></i></td>
            </tr>
            `;
    });
    $("#dtVE").append(html);
}

$(document).on("keyup change", ".serie", function () {
    let serie = $(this).val();
    let posicion = $(this).data("id");
    console.log(serie, posicion);

    detalleVenta.map((item, i) => {
        if (i == posicion) {
            item.serie = serie;
        }
    });
    SumaTotales();
});

function SumaTotales() {
    let total = 0;
    detalleVenta.map((item, i) => {
        total += parseFloat(item.precioTotal);
    });
    $("#TotalCart").text(redondeo(total));
}

$(document).on("click", ".deleteItem", function () {
    let posicion = $(this).data("id");
    let tr = document.querySelector("#fila" + posicion);
    tr.remove();
    detalleVenta.splice(posicion, 1);
    SumaTotales();
});

$(document).on("click", ".procesar", function () {
    const btn = $(this);
    var serialize = $('#form_venta').serialize(); //  <-----------
    var data = $('#form_venta').serializeJSON();
    btn.prop('disabled', true)
    ajax(`${base_url}/comercial/venta`, "POST", {
        ...data,
        detalleVenta
    }).then((response) => {
        if (response.status == "1") {
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
                    verPDF(response.data.insertVenta);
                } else {
                    window.location = "index";
                }
            });
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false)
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
