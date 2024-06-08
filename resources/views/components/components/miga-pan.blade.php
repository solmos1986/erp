<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @foreach ($rutas as $key => $ruta)
                        <li class="breadcrumb-item"><a href="{{ $ruta['direccion'] }}">{{ $ruta['nombre'] }}</a></li>
                    @endforeach
                    <li class="breadcrumb-item active">{{ $rutaActual }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ $rutaActual }}</h4>
        </div>
    </div>
</div>
