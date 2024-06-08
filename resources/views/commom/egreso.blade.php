<div class="row">
    {{-- <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="docCliente" class="form-label">NIT/CI</label>
        <select class="form-control form-control-sm form-select form-select-sm" id="docCliente" name="docCliente">
        </select>
    </div> --}}
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idProveedor" class="form-label">Proveedor</label>
        <select class="form-control form-control-sm select2" id="idProveedor" name="idProveedor">
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="btn" class="form-label">&nbsp; </label>
        <button type="button" id="btn" class="nuevo btn btn-sm btn-primary waves-effect waves-light w-100">
            <i class="mdi mdi-plus-circle me-1"></i> Agregar Proveedor</button>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idEstadoEgreso" class="form-label">Estado Orden</label>
        <select class="form-control form-control-sm form-select form-select-sm" id="idEstadoEgreso"
            name="idEstadoEgreso">
            @foreach ($estado_egreso as $ee)
                <option value="{{ $ee->idEstadoEgreso }}">{{ $ee->nomEstado }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="fechaVenta" class="form-label">Fecha</label>
        <input type="text" class="form-control form-control-sm" id="fecha" name="fecha" placeholder="Fecha"
            value="<?php echo date('d-m-Y H:i:s'); ?>" readonly>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idMetodoPago" class="form-label">Tipo Pago</label>
        <select class="form-control form-control-sm form-select form-select-sm" id="idMetodoPago" name="idMetodoPago">
            @foreach ($metodoPago as $mp)
                <option value="{{ $mp->idMetodoPago }}">{{ $mp->nomMetodoPago }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idTipoComprobante" class="form-label">Tipo comprobante</label>
        <select class="form-control form-control-sm form-select form-select-sm" id="idTipoComprobante"
            name="idTipoComprobante">
            @foreach ($tipo_comprobante as $tp)
                <option value="{{ $tp->idTipoComprobante }}">
                    {{ $tp->nomTipoComprobante }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="numComprobante" class="form-label">Num comprabante</label>
        <input type="text" id="numComprobante" name="numComprobante" class="form-control form-control-sm"
            placeholder="Comprabante">
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idUsuario" class="form-label">Usuario</label>
        <input type="text" id="idUsuario" name="idUsuario" class="form-control form-control-sm" placeholder=""
            value="{{ auth()->user()->obtener_usuario()->nomUsuario }}" disabled>
    </div>
</div>
