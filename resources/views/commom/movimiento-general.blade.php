<div class="row">
    <input type="text" id="idMovimiento" name="idMovimiento" hidden>
    <div class="col-xl-6 col-lg-4 col-md-6 col-sm-12 mb-1">
        <label for="recibe_entrega" class="form-label">Recibi/Entrege</label>
        <input type="text" class="form-control form-control-sm" name="recibe_entrega" id="recibe_entrega">
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-1">
        <label for="idTipoMov" class="form-label">Tipo movimiento</label>
        <select class="form-control form-control-sm form-select form-select-sm" id="idTipoMov" name="idTipoMov">
          {{--   @foreach ($proyectos as $proyecto)
                <option value="{{ $proyecto->idProyecto }}">{{ $proyecto->nombreProyecto }}</option>
            @endforeach --}}
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-1">
        <label for="idUsuario" class="form-label">Usuario</label>
        <input type="text" id="idUsuario" name="idUsuario" class="form-control form-control-sm" placeholder="Usuario"
            value="{{ auth()->user()->obtener_usuario()->nomUsuario }}" disabled>
    </div>
    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-1">
        <label for="descripcion" class="form-label">Glosa</label>
        <textarea class="form-control form-control-sm" id="descripcion" rows="1"></textarea>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-1">
        <label for="idProyecto" class="form-label">Proyecto</label>
        <select class="form-control form-control-sm form-select form-select-sm" id="idProyecto" name="idProyecto">
          {{--   @foreach ($tipoMovimientos as $movimiento)
                <option value="{{ $movimiento->idTipoMovimiento }}">{{ $movimiento->nomMovimiento }}</option>
            @endforeach --}}
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-1">
        <label for="fechaVenta" class="form-label">Fecha</label>
        <p class="mt-1"><small>{{ date('d-m-Y') }}</small></p>
    </div>
</div>
