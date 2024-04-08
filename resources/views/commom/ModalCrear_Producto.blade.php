 <!-- NUEVO Modal -->
 <div class="modal fade" id="crearProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                 <h4 class="modal-title" id="myLargeModalLabel">Crear Producto</h4>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="needs-validation" novalidate>
                     <div class="row">

                         <div class="col-md-4 mb-1">
                             <label for="codProducto" class="form-label">Cod. Producto</label>
                             <div class="input-group">
                                 <input type="text" class="form-control" id="codProducto" placeholder="ej. ######"
                                     required name="codProducto">
                             </div>
                         </div>
                         <div class="col-md-8 mb-1">
                             <label for="nomProducto" class="form-label">Nombre Producto</label>
                             <div class="input-group">
                                 <input type="text" class="form-control" id="nomProducto"
                                     placeholder="ej. Apple iMac" required name="nomProducto">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6 mb-1">
                             <label for="unidadMedida" class="form-label">Unidad de Medida</label>
                             <div class="input-group">
                                 <select class="form-control select2" id="unidadMedida" name="unidadMedida">
                                     <option value="metro">metro</option>
                                     <option value="pieza">pieza</option>
                                     <option value="kilogramo">kilogramo</option>
                                     <option value="balde">balde</option>
                                     <option value="bolsa">bolsa</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-6 mb-1">
                             <label for="stockMinimo" class="form-label">Stock Minimo</label>
                             <div class="input-group">
                                 <input type="text" class="form-control" id="stockMinimo" name="stockMinimo"
                                     placeholder="Enter amount">
                             </div>
                         </div>
                     </div>
                 </form>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary waves-effect"
                         data-bs-dismiss="modal">Cancelar</button>
                     <button type="sumit" class="guardarprod btn btn-info waves-effect waves-light">Guardar</button>
                 </div>
             </div>
         </div>
     </div>
     {{--   {!! Form::close() !!} --}}
 </div><!-- /.modal -->
