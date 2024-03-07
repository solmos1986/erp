@extends('layouts.admin')
@push('css')
@endpush

@section('contenido')
    <div class="col-xl-12 col-lg-12">
        <video id="webcam" autoplay playsinline width="640" height="480"></video>
        <img id="foto_tomada" src="" alt="">
        <canvas id="canvas" class="d-none"></canvas>
        <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>
        <button class="btn btn-primary" id="capturar" type="button">
            Tomar foto
        </button>
        <button class="btn btn-primary" id="cancelar" type="button">
            Cancelar
        </button>

    </div>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/webcam-easy/webcam-easy.min.js') }}"></script>
    <script>
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
        webcam.start()
            .then(result => {
                console.log("webcam started");
            })
            .catch(err => {
                console.log(err);
            });
        $(document).on("click", "#capturar", function() {
            var data = webcam.snap();
            console.log(data)
            $('#foto_tomada').prop('src', data)
            $('#webcam').hide();

        });
        $(document).on("click", "#cancelar", function() {
            $('#foto_tomada').prop('src', '')
            //$('#foto_tomada').hide();
            $('#webcam').show();
        });
    </script>
@endpush
