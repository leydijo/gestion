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
                                <th style="color:#fff;">Fecha creación</th>
                                <th style="color:#fff;">Acciones</th>

                            </thead>
                             <tbody>
                                @foreach ($problemas as $problema)
                                  <tr>
                                    <td>{{ $problema->id }}</td>
                                    <td>{{ $problema->creado_por }}</td>
                                    <td>{{ $problema->plataforma->nombre }}</td>
                                    <td>{{$problema->cliente->nombre}}</td>
                                    <td>{{ $problema->descripcion }}</td>
                                    <td><img src="{{ asset('storage').'/'.$problema->img_error }}" width="100"></td>
                                    <td>{{ $problema->solucion }}</td>
                                    <td>{{ $problema->fecha_creacion }}</td>
                                    <td>                                  
                                     {!! Form::open(['method' => 'DELETE','route' => ['problemas.destroy', $problema->id],'style'=>'display:inline']) !!}
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
