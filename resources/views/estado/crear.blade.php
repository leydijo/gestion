@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reportar estado de plataforma</h3>
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

                            {!! Form::open(['route' => 'estados.store', 'method' => 'POST']) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="plataforma_id">Selecciona un cliente</label>
                                        {!! Form::select('cliente_id', $clientes, null, [
                                            'class' => 'form-control',
                                            'id' => 'cliente_id',
                                            'onchange' => 'actualizarPlataformas(this.value)', 
                                            'placeholder' => 'Selecciona un cliente'
                                        ]) !!}
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
                                            <label for="estado_id">Selecciona un estado:</label>
                                            <select name="estado_id" class="form-control">
                                                @foreach ($estados as $id => $nombre)
                                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                                @endforeach
                                            </select>

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
    function actualizarPlataformas(clienteId) {
        var opcionesPlataforma = document.querySelectorAll('#plataforma_id option');
        for (var i = 0; i < opcionesPlataforma.length; i++) {
            var opcion = opcionesPlataforma[i];
            if (opcion.value != 'null' && opcion.getAttribute('data-cliente-id') != clienteId) {
                opcion.style.display = 'none';
            } else {
                opcion.style.display = 'block';
            }
        }
    }
</script>



