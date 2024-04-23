<form action="/" method="post" enctype="multipart/form-data" id="form_product">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="border p-3  mt-lg-2 rounded">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <label for="codProducto" class="form-label">Codigo <span class="text-danger">*</span></label>
                    <input type="text" id="codProducto" name="codProducto" class="form-control"
                        placeholder="ej: #######">
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <label for="nomProducto" class="form-label">Nombre Producto <span
                            class="text-danger">*</span></label>
                    <input type="text" id="nomProducto" class="form-control" name="nomProducto"
                        placeholder="ej : Apple iMac">
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <label for="product-description" class="form-label">Descripcion del producto <span
                            class="text-danger">*</span></label>
                    <div id="descripcion" style="height: 150px;"></div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <label for="product-summary" class="form-label">Resumen del producto</label>
                    <textarea class="form-control" id="product-summary" rows="3" placeholder="Porfavor ingresa un resumen"></textarea>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="border p-3  mt-lg-2 rounded">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Imagenes Producto</h5>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <input type="file" name="imagenProducto" id="imagenProducto" data-height="300" />
                </div>
            </div>
            <div class="border p-3  mt-lg-2 rounded">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Almacen</h5>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <label for="unidadMedida" class="form-label">Unidad de Medida <span
                            class="text-danger">*</span></label>
                    <select class="form-control select2" id="unidadMedida" name="unidadMedida">
                        @foreach ($categoria as $cat)
                            <option value="metro">metro</option>
                            <option value="pieza">pieza</option>
                            <option value="kilogramo">kilogramo</option>
                            <option value="balde">balde</option>
                            <option value="bolsa">bolsa</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <label for="idCategoria" class="form-label">Categoria <span class="text-danger">*</span></label>
                    <select class="form-control select2" id="idCategoria" name="idCategoria">
                        @foreach ($categoria as $cat)
                            <option value="{{ $cat->idCategoria }}">{{ $cat->nomCategoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                    <div class="row">
                        {{--   <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-1">
                            <label for="precioCompra">Precio Compra <span
                                    class="text-danger">*</span></label><!-- Trae el resultado del promedio de los ingresos a almacen por compra -->
                            <input type="text" class="form-control" id="precioCompra" name="precioCompra"
                                placeholder="Enter amount" readonly>
                        </div> --}}
                        <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12 mb-1">
                            <label for="pecioVenta">Porcentaje de ganancia %</label>
                            <input type="number" class="form-control" id="porcentaje_ganancia"
                                name="porcentaje_ganancia" placeholder="Ej. 20">
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12 mb-1">
                            <label for="stockMinimo">Stock Minimo</label>
                            <input type="number" class="form-control" id="stockMinimo" name="stockMinimo"
                                placeholder="Stock">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
