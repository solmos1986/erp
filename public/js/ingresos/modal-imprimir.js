function verPDF(id) {
    var frame = $('#iframePDF');
    var ahref = $('#cancelPDF');
    ajax(`${base_url}/comercial/venta-pdf/${id}`, "GET").then((response) => {
        var src = `data:application/pdf;base64,${response.data}`;
            $('#modal_pdf .modal-title').text('ORDEN DE COMPRA');
            ahref.attr('href', `${base_url}/comercial/compra/index`);
            frame.attr('src', `data:application/pdf;base64,${response.data}`);
            $('#modal_pdf').modal('show');
            $('#iframePDF').data('url', response.data)
    });
}

$(document).on('click', '.ver_pdf', function() {
    const id = $(this).data('id')
    verPDF(id)
});

$(document).on('click', '.imprimir', function () {
    console.log('.imprimir')
    const base64 = $('#iframePDF').data('url')
    printJS({
        printable: base64,
        type: 'pdf',
        base64: true,
        onPrintDialogClose: () => {
            $('#modal_pdf').modal('hide');
            window.location = `${base_url}/comercial/venta`;
        }
    });
})