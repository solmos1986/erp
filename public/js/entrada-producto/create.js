
var dataTableEntrada = $('#data_table_entrada').DataTable();

const onChangeAll = (selectedDates, dateStr, instance) => {
    const dataTemp = dataTableEntrada.rows().data().toArray();
    dataTemp.map((prod) => {
        prod.fecha_vencimiento = dateStr
    });
    dataTableEntrada.clear();
    dataTableEntrada.rows.add(dataTemp).draw();
}
flatpickr($(".fecha_vencimiento_all"), moment().format("DD-MM-YYYY"), onChangeAll)

const onChangeFechaVencimiento = (selectedDates, dateStr, instance) => {
    const idEntradaAlmacen = $(instance.input).data('id')
    const dataTemp = dataTableEntrada.rows().data().toArray();
    dataTemp.map((prod) => {
        if (prod.idEntradaAlmacen == idEntradaAlmacen) {
            prod.fecha_vencimiento = dateStr
        }
    });
}
console.log(idEgreso)
$(document).ready(function () {

    ajax(`${base_url}/entrada-almacen/producto-data-table/${idEgreso}`, 'GET').then((response) => {
        dataTableEntrada.destroy();
        if (response.status == '1') {
            const columns = [
                {
                    width: '30%',
                    data: 'serie',
                    name: 'serie',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `<input data-id="${row.idEntradaAlmacen}" class="code_barra form-control form-control-sm" type="text" value="${row.serie}">`;
                    }
                },
                {
                    width: '30%',
                    data: 'nomProducto'
                },
                {
                    width: '20%',
                    data: 'fecha_vencimiento',
                    name: 'fecha_vencimiento',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `<input data-id="${row.idEntradaAlmacen}" class="fecha_vencimiento form-control form-control-sm" type="text" value="${row.fecha_vencimiento}">`;
                    }
                },
                {
                    width: '20%',
                    data: 'almacenes',
                    name: 'almacenes',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        let options = ``;
                        row.almacenes.forEach(almacen => {
                            options += `<option value="${almacen.idAlmacen}">${almacen.nomAlmacen}</option>`
                        });
                        return `
                        <select class="form-control form-control-sm" data-id="${row.idEntradaAlmacen}">
                            ${options}
                        </select>
                        `;
                    }
                },
            ];
            dataTableEntrada = dataTableNoAjax($('#data_table_entrada'), columns, response.data, () => { flatpickr($(".fecha_vencimiento"), '', onChangeFechaVencimiento) })
        } else {
            SwallErrorValidate(response);
        }
    })
});

$(document).on("change", ".code_barra", function () {
    const idEntradaAlmacen = $(this).data('id')
    const dataTemp = dataTableEntrada.rows().data().toArray();
    const value = this.value;
    dataTemp.map((prod) => {
        if (prod.idEntradaAlmacen == idEntradaAlmacen) {
            prod.serie = value
        }
    });
});

$(document).on("click", ".store", function () {
    const btn = $(this)
    btn.prop('disabled', true);
    const valores = dataTableEntrada.rows().data().toArray();
    ajax(`${base_url}/entrada-almacen/store/${idEgreso}`, 'POST', { entradas: valores }).then((response) => {
        if (response.status == '1') {
            SwallSuccess(response.message)
            window.location = `${base_url}/comercial/compra`;
        } else {
            SwallErrorValidate(response);
        }
    })
})

