const columns = [{
    data: 'idProveedor',
    name: 'idProveedor'
},
{
    data: 'nomProveedor',
    name: 'nomProveedor'
},
{
    data: 'tel1Proveedor',
    name: 'tel1Proveedor'
},
{
    data: 'dirProveedor',
    name: 'dirProveedor'
},
{
    data: 'mailProveedor',
    name: 'mailProveedor'
},
{
    data: 'idProveedor',
    name: 'idProveedor',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<i data-id="${row.idProveedor}" class="edit fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
        <i data-id="${row.idProveedor}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>`
            ;
    }
},
];

const tableProveedor = dataTable($('.dtProveedor'),
    `${base_url}/almacen/proveedor`,
    columns)

$(document).on("click", ".nuevo", function () {
    $('#modal_proveedor').modal('show');
    $('#form_proveedor').trigger("reset");
    $('#modal_proveedor .modal-title').text('Nuevo proveedor');
    BtnAddSave($('#btn_save'), 'store', 'update')
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    ajax(`${base_url}/almacen/proveedor`, 'POST', $('#form_proveedor').serialize()).then((response) => {
        if (response.status == '1') {
            $('#modal_proveedor').modal('hide');
            tableProveedor.ajax.url(`${base_url}/almacen/proveedor`).load();
            btn.prop('disabled', false);
            SwallSuccess(response.message)
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
});

$(document).on("click", ".edit", function () {
    const id = $(this).data('id');
    $('#form_proveedor').trigger("reset");
    $('#modal_proveedor .modal-title').text('Editar proveedor');
    BtnAddUpdate($('#btn_save'), 'store', 'update')
    ajax(`${base_url}/almacen/proveedor/${id}`, 'GET').then((response) => {
        if (response.status == '1') {
            $('#idProveedor').val(response.data.idProveedor)
            $('#nomProveedor').val(response.data.nomProveedor)
            $('#tel1Proveedor').val(response.data.tel1Proveedor)
            $('#tel2Proveedor').val(response.data.tel2Proveedor)
            $('#dirProveedor').val(response.data.dirProveedor)
            $('#mailProveedor').val(response.data.mailProveedor)
            $('#modal_proveedor').modal('show');
        } else {
            SwallErrorValidate(response);
        }
    })
});

/*<!-- AJAX UPDATE Modal -->*/
$(document).on("click", ".update", function () {
    ajax(`${base_url}/almacen/proveedor/${$('#idProveedor').val()}`, 'PUT', $('#form_proveedor').serialize()).then((response) => {
        if (response.status == '1') {
            $('#modal_proveedor').modal('hide');
            tableProveedor.ajax.url(`${base_url}/almacen/proveedor`).load();
            btn.prop('disabled', false);
            SwallSuccess(response.message)
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })

})

$(document).on("click", ".delete", function () {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "Esta proceso es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar esto!'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar(id)
        }
    })
});

function eliminar(id) {
    ajax(`${base_url}/almacen/proveedor/${id}`, 'DELETE').then((response) => {
        SwallSuccess(response.message)
        tableProveedor.ajax.url(`${base_url}/almacen/proveedor`).load();
    }).catch(() => {

    });
} 