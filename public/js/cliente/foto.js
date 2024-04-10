
const webcamElement = document.getElementById('webcam');
const canvasElement = document.getElementById('canvas');
const snapSoundElement = document.getElementById('snapSound');
const webcam = new Webcam(webcamElement, 'user', canvasElement /* , snapSoundElement */);

$(document).on("click", "#capturar", async function () {
    var base64Imagen = webcam.snap();
    $('#foto_tomada').prop('src', base64Imagen)
    $('#webcam').hide()
    $('#foto_tomada').show();
    $('#image').val(base64Imagen);
    console.log('antes de la reduccion', base64Imagen)
    const base64 = await resizeBase64Image(base64Imagen);
    console.log('despues de la reduccion', base64)
});

$(document).on("click", "#cancelar", function () {
    $('#webcam').show();
    $('#foto_tomada').hide();
    $('#image').val('');
});

$('#formCliente').on('hidden.bs.modal', function () {
    webcam.stop();
})

$(document).on("click", ".subir_foto", function () {
    //subir archivo
    SubirFoto(true)
    SubirTomarFoto(false)
    webcam.stop();
    $('#webcam').hide();
    $('#foto_tomada').show();
});

$(document).on("click", ".usar_camara", function () {
    //usar camara
    SubirFoto(false)
    SubirTomarFoto(true)
    webcam.start()
        .then(result => {
            console.log("webcam started");
            $('#webcam').show();
        })
        .catch(err => {
            console.log(err);
        });
    $('#webcam').show();
    $('#foto_tomada').hide()
});

function SubirFoto(estado) {
    $('#iniciar').prop('disabled', estado);
    $('#capturar').prop('disabled', estado);
    $('#cancelar').prop('disabled', estado);
}
function SubirTomarFoto(estado) {
    $('#subir_foto').prop('disabled', estado);
    $('#cancelar_subir_foto').prop('disabled', estado);
}

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

//preview file

$(document).on("click", "#subir_foto", function () {
    console.log('subir_foto')
    $("#file").trigger("click");
});

$(document).on("change", "#file", async function () {
    const [file] = $(this).prop('files')
    if (file) {
        const base64 = await getBase64(file)
        console.log('antes de la reduccion', base64)
        const base64Imagen = await resizeBase64Image(base64);
        console.log('despues de la reduccion', base64Imagen)

        $('#foto_tomada').prop('src', base64Imagen)
        $('#webcam').hide()
        $('#foto_tomada').show();
        $('#image').val(base64Imagen);
    }
});

$(document).on("click", "#cancelar_subir_foto", function () {
    $('#foto_tomada').prop('src', `${base_url}/assets/perfil/peril.webp`);
    $('#image').val('');
});

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}