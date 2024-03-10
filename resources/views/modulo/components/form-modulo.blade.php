<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 class="mb-3 mt-0 font-18">Nuevo modulo</h4>
    </div>
    <form id="form_modulo" action="">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mb-3">
                    <label for="nombre_modulo" class="form-label">Nombre modulo</label>
                    <input type="text" id="nombre_modulo" name="nombre_modulo" class="form-control">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mb-3">
                    <label for="url" class="form-label">Url</label>
                    <input type="text" id="url" name="url" class="form-control">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <div class="mb-">
                            <label for="class_icon" class="form-label">Icon <small>(class html)</small></label>
                            <input type="text" id="class_icon" name="class_icon" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <div class="mb-3">
                            <label for="icon" class="form-label">Preview</label>
                            <div class="mt-1" id="icon_ejemplo">
                                <i data-feather="pocket"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <div class="mb-3">
                            <label for="icon" class="form-label">Iconos</label>
                            <br>
                            <div class="mt-1">
                                <a href="{{ route('modulo.icons') }}" target="_blank">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mb-3">
                    <label for="select_super_modulo" class="form-label">Seccion</label>
                    <select class="form-select" id="select_super_modulo" name="super_modulo_id">

                    </select>
                </div>
            </div>

        </div>
    </form>
</div>
