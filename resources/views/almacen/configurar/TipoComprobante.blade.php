<div class="row">
    <h5>TIPO COMPROBANTE</h5>
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="text-lg-end my-1 my-lg-0">
            <button type="button" class="nuevotc btn w-sm btn-success waves-effect waves-light"
                data-id="TIPO COMPROBANTE">Nuevo</button>
            <div class="row">
                <br>
            </div>
        </div>
        <div class="table-responsive">
            <table id="bodyTipoComprobante"
                class="bodyTipoComprobante table table-borderless table-nowrap table-centered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Tipo Comprobante</th>
                        <th style="width: 50px;">Status</th>
                        <th style="width: 50px;">Accion</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@include('commom.HeadModal')
<div class="row">
    <div class="col-md-12 mb-1">
        <label for="inputNombre" class="form-label"><span class="inputNombre">
                Nombre</span></label>
        <div class="input-group">
            <input type="text" class="form-control" id="idConfigurar" autocomplete="off" placeholder="" hidden
                name="idConfigurar">
            <input type="text" class="form-control" id="inputNombre" autocomplete="off" placeholder="Ingrese Nombre"
                required name="inputNombre">
        </div>
    </div>
</div>
@include('commom.FootModal')
@include('commom.DeleteModal')
