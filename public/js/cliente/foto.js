
const webcamElement = document.getElementById('webcam');
const canvasElement = document.getElementById('canvas');
const snapSoundElement = document.getElementById('snapSound');
const webcam = new Webcam(webcamElement, 'user', canvasElement /* , snapSoundElement */);

$(document).ready(function () {
    $('#camara').hide();
});

$(document).on("click", "#tomar_foto", async function () {
    $(this).prop('disabled', true);
    $('#activar_camara').prop('disabled', false);
    var base64Imagen = webcam.snap();
    $('#camara').hide()
    $('#preview').show()
    const base64 = await resizeBase64Image(base64Imagen);
    $('#image').val(base64Imagen);
    resetPreview('imagenCliente', base64, 'foto.jpg');
    webcam.stop();
});

$(document).on("click", "#cancelar", function () {
    $(".dropify-clear").trigger("click");
    $('#camara').hide()
    $('#preview').show()
    webcam.stop();
    $('#image').val('');
    $('#tomar_foto').prop('disabled', true);
    $('#activar_camara').prop('disabled', false);
});

$(document).on("click", "#activar_camara", function () {
    //usar camara
    webcam.start()
        .then(result => {
            $(this).prop('disabled', true);
            $('#tomar_foto').prop('disabled', false);
            $('#camara').show();
            $('#preview').hide();
        })
        .catch(err => {
            console.log(err);
        });
    $('#webcam').show();
    $('#foto_tomada').hide()
});


function resizeBase64Image(base64Imagen) {
    return new Promise((resolve, reject) => {
        const maxSizeInMB = 1;
        const maxSizeInBytes = maxSizeInMB * 350 * 350;
        const img = new Image();
        img.src = base64Imagen;
        img.onload = function () {
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext('2d');
            const width = img.width;
            const height = img.height;
            const aspectRatio = width / height;
            const newWidth = Math.sqrt(maxSizeInBytes * aspectRatio);
            const newHeight = Math.sqrt(maxSizeInBytes / aspectRatio);
            canvas.width = newWidth;
            canvas.height = newHeight;
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            let quality = 0.8;
            let dataURL = canvas.toDataURL('image/jpeg', quality);
            var base64rz = dataURL;
            resolve(dataURL);
        }
    })
}


function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

$('#imagenCliente').dropify({
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

function resetPreview(name, src, fname = '') {
    let input = $('input[name="' + name + '"]');
    let wrapper = input.closest('.dropify-wrapper');
    let preview = wrapper.find('.dropify-preview');
    let filename = wrapper.find('.dropify-filename-inner');
    let render = wrapper.find('.dropify-render').html('');

    input.val('').attr('title', fname);
    wrapper.removeClass('has-error').addClass('has-preview');
    filename.html(fname);

    render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
    preview.fadeIn();
}