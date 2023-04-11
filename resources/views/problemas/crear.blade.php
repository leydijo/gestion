@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear problemas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {!! Form::open(['route' => 'problemas.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="plataforma">Selecciona un cliente</label>
                                        {!! Form::select('cliente_id', $clientes, null, [
                                            'class' => 'form-control',
                                            'id' => 'cliente_id',
                                            'data-cliente-id' => $clientes->pluck('id')->first(),
                                            'onchange' => 'actualizarPlataformas()',
                                        ]) !!}

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="plataforma">Subir Imagen</label>
                                        {!! Form::file('img_error', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="plataforma_id">Plataforma:</label>
                                        <select name="plataforma_id" class="form-control" id="plataforma_id">
                                            <option value="null">Seleccione una plataforma</option>
                                            @foreach ($plataformas as $plataforma)
                                                <option value="{{ $plataforma->id }}"
                                                    data-cliente-id="{{ $plataforma->cliente_id }}">
                                                    {{ $plataforma->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                            {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            {!! Form::hidden('creado_por', auth()->user()->name()) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

<script>
    function actualizarPlataformas() {
        let clienteId = document.getElementById("cliente_id").value;
        let plataformaSelect = document.getElementById("plataforma_id");


        for (var i = 0; i < plataformaSelect.options.length; i++) {
            var opcion = plataformaSelect.options[i];

            if (opcion.getAttribute("data-cliente-id") == clienteId) {
                opcion.style.display = "";
            } else {
                opcion.style.display = "none";
            }
        }

        // Actualizar el valor del campo de plataforma con la primera opción visible
        var primeraOpcionVisible = plataformaSelect.querySelector("option:not([style*='none'])");
        if (primeraOpcionVisible) {
            plataformaSelect.value = primeraOpcionVisible.value;
        }

    }
</script>
