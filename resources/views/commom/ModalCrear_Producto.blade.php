 <!-- NUEVO Modal -->
 <div class="modal fade" id="formPDF" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary waves-effect"
                         data-bs-dismiss="modal">Cancelar</button>
                     <button type="sumit" class="guardarp btn btn-info waves-effect waves-light">Guardar</button>
                 </div>
             </div>
         </div>
     </div>
     {!! Form::close() !!}
 </div><!-- /.modal -->
