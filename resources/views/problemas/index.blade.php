@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Problemas</h3>
        </div>
        <div class="section-body">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('problemas.create') }}">Nuevo</a>
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">ID</th>
                                <th style="color:#fff;">Creado por</th>
                                <th style="color:#fff;">Plataforma</th>
                                <th style="color:#fff;">Cliente</th>
                                <th style="color:#fff;">Descripción</th>
                                <th style="color:#fff;">Imagen</th>
                                <th style="color:#fff;">Solución</th>
                                <th style="color:#fff;">Solucionado por</th>
                                <th style="color:#fff;">Solucionado el</th>
                                <th style="color:#fff;">Fecha creación</th>
                                <th style="color:#fff;">Acciones</th>

                            </thead>
                            <tbody>
                                @foreach ($problemas as $problema)
                                    <tr>
                                        <td>{{ $problema->id }}</td>
                                        <td>{{ $problema->creado_por }}</td>
                                        <td>{{ $problema->plataforma->nombre }}</td>
                                        <td>{{ $problema->cliente->nombre }}</td>
                                        <td>{{ $problema->descripcion }}</td>
                                        <td><img src="{{ asset('storage') . '/' . $problema->img_error }}" width="100">
                                        </td>
                                        <td><button class="btn btn-primary">ver</button></td>
                                        <td>{{ $problema->solucionado_por }}</td>
                                        <td>{{ $problema->fecha_solucion }}</td>
                                        <td>{{ $problema->fecha_creacion }}</td>
                                        <td>

                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Ingresar solución
                                            </button>

                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['problemas.destroy', $problema->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="pagination justify-content-end">
                            {!! $problemas->links() !!}
                        </div>

                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese una solución</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($problema, ['method' => 'PATCH', 'route' => ['problemas.update', $problema->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="solucion">Solución</label>
                                {!! Form::textarea('solucion', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                {!! Form::text(
                                    'solucionado_por',
                                    auth()->user()->name(),
                                    ['class' => 'form-control'],
                                ) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {!! Form::hidden('fecha_solucion', \Carbon\Carbon::now()->format('Y-m-d H:i:s')) !!}
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
