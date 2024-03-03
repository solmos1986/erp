<div class="modal fade" id= "modalConfigurar" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formConfigurar" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel"><span class="tituloModal">Crear +
                            Categoria</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
