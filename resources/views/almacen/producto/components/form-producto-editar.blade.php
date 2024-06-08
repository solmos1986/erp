<form action="/" method="post" enctype="multipart/form-data" id="form_product">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="border p-3 rounded">
                <input type="text" id="idProducto" name="idProducto" value="{{ $producto->idProducto }}" hidden>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                        <label for="codProducto" class="form-label">Codigo <span class="text-danger">*</span></label>
                        <input type="text" id="codProducto" name="codProducto" class="form-control form-control-sm"
                            value="{{ $producto->codProducto }}" placeholder="ej: #######">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                        <label for="nomProducto" class="form-label">Nombre Producto <span
                                class="text-danger">*</span></label>
                        <input type="text" id="nomProducto" class="form-control form-control-sm" name="nomProducto"
                            value="{{ $producto->nomProducto }}" placeholder="ej : Apple iMac">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                        <label for="product-description" class="form-label">Descripcion del producto <span
                                class="text-danger">*</span></label>
                        <div id="descripcion" style="height: 150px;">
                            {!! $producto->descripcion !!}
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                        <label for="product-summary" class="form-label">Resumen del producto</label>
                        <textarea class="form-control form-control-sm" id="resumen" rows="3" placeholder="Porfavor ingresa un resumen">{{ $producto->nomProducto }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="border p-3 rounded">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Imagenes Producto</h5>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input type="file" name="imagenProducto" id="imagenProducto" data-height="300" data-default-file="{{ url('/') }}/imagenes/productos/{{ $producto->imagenProducto }}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
            <div class="border p-3 rounded">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Detalle sobre el producto</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-1">
                        <label for="unidadMedida" class="form-label">Unidad de Medida <span
                                class="text-danger">*</span></label>
                        <select class="form-control form-control-sm form-select form-select-sm" id="unidadMedida"
                            name="unidadMedida">
                            @foreach ($unidad_medida as $medida)
                                <option value="{{ $medida->idUnidadMedida }}"
                                    {{ $medida->idUnidadMedida == $producto->idProducto ? 'selected' : '' }}>
                                    {{ $medida->nomUnidadMedida }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-1">
                        <label for="stockMinimo" class="form-label">Stock Minimo</label>
                        <input type="number" class="form-control form-control-sm" id="stockMinimo" name="stockMinimo"
                            value="{{ $producto->stockMinimo }}" placeholder="Stock">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-1">
                        <label for="idCategoria" class="form-label">Categoria <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm form-select form-select-sm" id="idCategoria"
                            name="idCategoria">
                            @foreach ($categoria as $cat)
                                @php
                                    $espacio = '';
                                    for ($i = 0; $i < $cat->idCategoriaPadre; $i++) {
                                        $espacio .= '- ';
                                    }
                                @endphp
                                <option value="{{ $cat->idCategoria }}"
                                    {{ $cat->idCategoria == $producto->idCategoria ? 'selected' : '' }}>
                                    {{ $espacio }}{{ $cat->nomCategoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
            <div class="border p-3 rounded">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Informacion de precios</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-1">
                        <label for="precio_venta" class="form-label">Precio venta</label>
                        <input type="number" class="form-control form-control-sm" id="precioVenta" name="precioVenta"
                            placeholder="Ej. 20" value="{{ $producto->precioVenta }}">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-1">
                        <label for="promedio" class="form-label">Promedio de precio</label>
                        <input type="number" class="form-control form-control-sm" id="promedio" disabled
                            name="promedio" placeholder="" value="{{ $promedio->promedio }}">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-1">
                        <label for="btn" class="form-label">&nbsp;</label>
                        <button type="button" id="btn"
                            class="detalle_compra btn btn-sm btn-primary waves-effect waves-light w-100">
                            Ver promedio de compra y venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
