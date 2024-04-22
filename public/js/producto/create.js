const createEditor = new Quill("#descripcion", {
    theme: "snow",
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike']
        ]
    }
})

$('#imagenProducto').dropify({
    messages: {
        default: "Arrastre y suelte un archivo aquí o haga clic",
        replace: " Arrastra y suelta o haz clic para reemplazar",
        remove: "Eliminar",
        error: "Vaya, se ha añadido algo mal.",
    },
    error: {
        fileSize: "El tamaño del archivo es demasiado grande (1 M como máximo)."
    },
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    var formData = new FormData($('#form_product')[0]);
    formData.append('descripcion', createEditor.root.innerHTML);
    ajaxFormData(`${base_url}/almacen/producto`, 'POST', formData).then((response) => {
        if (response.status == '1') {
            SwallSuccess(response.message);
            btn.prop('disabled', false);
            window.location = `${base_url}/almacen/producto`;
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
})

