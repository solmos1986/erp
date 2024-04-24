<div class="row">
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="fechaVenta" class="form-label">Fecha</label>
        <input type="text" class="form-control form-control-sm" id="fechaVenta" name="date" placeholder="Fecha"
            value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idVendedor" class="form-label">Vendedor</label>
        <input type="text" id="idVendedor" name="idVendedor" class="form-control form-control-sm" placeholder=""
            value="{{ auth()->user()->obtener_usuario()->nomUsuario }}" disabled>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idCliente" class="form-label">Cliente</label>
        <select class="form-control form-control-sm" id="idCliente" name="idCliente">
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="btn" class="form-label">&nbsp </label>
        <button type="button" id="btn" class="nuevo btn btn-sm btn-primary waves-effect waves-light w-100">
            <i class="mdi mdi-plus-circle me-1"></i> Agregar Cliente</button>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="docCliente" class="form-label">NIT/CI</label>
        <select class="form-control form-control-sm" id="docCliente" name="docCliente">
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idTipoPago" class="form-label">Tipo Pago</label>
        <select class="form-control form-control-sm" id="idTipoPago">
            @foreach ($tipopago as $tp)
                <option value="{{ $tp->idTipoPago }}">{{ $tp->nomTipoPago }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="idTipoComprobante" class="form-label">Comprobante</label>
        <select class="form-control form-control-sm" id="idTipoComprobante">
            @foreach ($tipo_comprobante as $tp)
                <option value="{{ $tp->impuestoComprobante }}">
                    {{ $tp->nomTipoComprobante }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
        <label for="impuestoIngreso" class="form-label">Impuestos</label>
        <input type="number" class="form-control form-control-sm" id="impuestoIngreso" placeholder="% impuesto"
            value="">
    </div>
</div>
