
//detectar code barra
$(document).on("change", "#code_barra", function () {
    const serie = $(this);
    ajax(`${base_url}/almacen/producto/buscar-serie`, "POST", {
        serie: serie.val(),
    }).then((response) => {
        if (response.status == "1") {
            const producto = response.data;
           /*  const validador = detalleVenta.find(
                (item) => item.idProducto == producto.idProducto
            ); */

            detalleVenta.push({
                ...producto,
                serie: response.data.serie,
                precio: producto.precioVenta,
                precioTotal: parseFloat(producto.precioVenta * 1),
            });
            SumaTotales();
            renderDetalleVenta();
            serie.val("");
        } else {
            serie.val("");
        }
    });
});