    <!-- NUEVO Modal -->
    <div class="modal fade" id="formProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--  {!! Form::open(['url' => 'almacen/proveedor', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        {{ Form::token() }} --}}

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Crear Proveedor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">

                            <div class="col-md-12 mb-1">
                                <label for="nomProveedor" class="form-label">Nombre Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nomProveedorp"
                                        placeholder="Ingrese Proveedor" required name="nomProveedorp">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-1">
                                <label for="tel1Proveedor" class="form-label">Telefono 1 Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel1Proveedorp"
                                        placeholder="Telefono 1" required name="tel1Proveedorp">
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="tel2Proveedor" class="form-label">Telefono 2 Proveedor</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tel2Proveedorp"
                                        placeholder="Telefono 2" required name="tel2Proveedorp">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="mailProveedor" class="form-label">Correo Electronico</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailProveedorp" placeholder="E-mail"
                                        required name="mailProveedorp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label for="dirProveedor" class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dirProveedorp"
                                        placeholder="Direccion" required name="dirProveedorp">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="sumit" class="guardarp btn btn-info waves-effect waves-light">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        {{--         {!! Form::close() !!} --}}
    </div><!-- /.modal -->
