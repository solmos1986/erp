// autoseleccion paquete por default 
$(document).ready(function () {
    $("#duracionPaquete").val($('#idPaquete').find(":selected").data('duracion'));
    $("#costoPaquete").val($('#idPaquete').find(":selected").data('costo'));
    setFecha(moment().format('DD/MM/YYYY'))
});

$(document).on('change', '#idPaquete', function () {
    $('#costoPaquete').val($('#idPaquete').find(":selected").data('costo'));
    $('#duracionPaquete').val($('#idPaquete').find(":selected").data('duracion'));
    setFecha($("#fechaInicio").val());
});

$("#fechaInicio").flatpickr({
    enableTime: false,
    dateFormat: "d/m/Y",
    defaultDate: moment().format('DD/MM/YYYY'),//defaul fecha actual
    onChange: function (selectedDates, dateStr, instance) {
        setFecha(dateStr);
    },
});

function setFecha(fechaInicio) {
    var nueva_fecha = moment(fechaInicio, "DD/MM/YYYY").add($("#duracionPaquete").val(), 'months').format(
        'DD/MM/YYYY')
    $("#fechaFin").val(nueva_fecha)
}

//PDF
function verPDF(id) {
    var frame = $('#iframePDF');
    var ahref = $('#cancelPDF');
    //LOADER
    ajax(`${base_url}/comercial/inscripcion-pdf/${id}`, 'GET').then((response) => {
        var src = `data:application/pdf;base64,${response.data}`;
        $('#modalImprimir .modal-title').text('RECIBO DE INSCRIPCION');
        ahref.attr('href', `${base_url}/comercial/inscripcion/index`);
        frame.attr('src', `data:application/pdf;base64,${response.data}`);
        $('#modalImprimir').modal('show');
        $('#iframePDF').data('url', response.data)
    });
}
$(document).on('click', '.imprimir', function () {
    const base64 = $('#iframePDF').data('url')
    printJS({
        printable: base64,
        type: 'pdf',
        base64: true,
        onPrintDialogClose: () => {
            $('#modalImprimir').modal('hide');
            window.location = "index";
        }
    });
})

//STORE
$(document).on('click', '.procesar', function () {
    ajax(`${base_url}/comercial/inscripcion`, 'POST', $('#form_inscripcion').serialize()).then((response) => {
        if (response.status == 1) {
            Swal.fire({
                title: 'Desea imprimir?',
                text: "Esta proceso es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, imprimir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    verPDF(response.data)
                } else {
                    window.location = "index";
                }
            })
        } else {
            SwallErrorValidate(response);
        }
    })
});

const onChangeSelect2Cliente = function (e) {
    var newOption = new Option(e.params.data.docCliente, e.params.data.id, false, false);
    $('#docCliente').append(newOption).trigger('change');
    $('#docCliente').val(e.params.data.id).trigger('change');
}
select2('#idCliente', `${base_url}/clientes/buscar-nombre`, 'GET', onChangeSelect2Cliente)

const onChangeSelect2DocCliente = function (e) {
    var newOption = new Option(e.params.data.nomCliente, e.params.data.id, false, false);
    $('#idCliente').append(newOption).trigger('change');
    $('#idCliente').val(e.params.data.id).trigger('change');
}
select2('#docCliente', `${base_url}/clientes/buscar-ci`, 'GET', onChangeSelect2DocCliente)