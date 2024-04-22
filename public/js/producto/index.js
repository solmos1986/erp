const columnsProducto = [{
    data: 'imagenProducto',
    name: 'imagenProducto',
    type: 'upload',
    render: function (data, type, row, mneta) {
        return `<img src="${base_url}/imagenes/productos/${row.imagenProducto}" style="height:50px;width:50px;" />`;
    }
},
{
    data: 'codProducto',
    name: 'codProducto'
},
{
    data: 'nomProducto',
    name: 'nomProducto'
},
{
    data: 'unidadMedida',
    name: 'unidadMedida'
},
{
    data: 'nomCategoria',
    name: 'nomCategoria'
},
{
    data: 'stockMinimo',
    name: 'stockMinimo'
},
{
    data: 'promedio',
    name: 'promedio'
},
{
    data: 'precio_venta',
    name: 'precio_venta'
},
{
    data: 'stock',
    name: 'stock'
},
{
    data: 'idProducto',
    name: 'idProducto',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return ` <i data-id="${row.idProducto}" class="edit fas fa-pencil-alt text-primary m-1 cursor-pointer" title="Recibir Orden"></i>
        <i data-id="${row.idProducto}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Ver pdf"></i>`;
    }
}];

const tableCompras = dataTable($('.dtProducto'),
    `${base_url}/almacen/producto/data-table`,
    columnsProducto);

$(document).on("click", ".delete", function () {
    const id = $(this).data('id');
    
    $('#idProductoDelete').val(id)
    $('#formDeleteProducto').modal('show');
    $(".btnDelete").click(function () {
        $.ajax({
            type: "delete",
            url: `${base_url}/almacen/producto/${id}`,
            dataType: 'json',

            success: function (response) {
                console.log(response, "LLEGO DATA?")
                $('#formDeleteProducto').modal('hide');
                $('.dtProducto').DataTable().ajax.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //error_status(jqXHR)
                console.log(response, "ERROR?")
            },
            fail: function () {
                //fail()
            }
        })
    })
});