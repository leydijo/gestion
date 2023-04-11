@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Estado Plataforma</h3>
        </div>
        <div class="section-body">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('estados.create') }}">Nuevo</a>
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">ID</th>
                                <th style="color:#fff;">Analista</th>
                                <th style="color:#fff;">Plataforma</th>
                                <th style="color:#fff;">Cliente</th>
                                <th style="color:#fff;">Estado</th>
                                <th style="color:#fff;">Fecha Reporte</th>
                               

                            </thead>
                            <tbody>
                                @foreach ($plataformas as $plataforma)
                                    <tr>
                                        <td>{{ $plataforma->id }}</td>
                                        <td>{{ $plataforma->creado_por }}</td>
                                        <td>{{ $plataforma->plataforma->nombre }}</td>
                                        <td>{{ $plataforma->cliente->nombre }}</td>
                                        <td>{{ $plataforma->estado->nombre }}</td>
                                        <td>{{ $plataforma->fecha_creacion }}</td> 
                                        {{-- <td>{{ $problema->id }}</td>
                                    <td>{{ $problema->creado_por }}</td>
                                    <td>{{ $problema->plataforma }}</td>
                                    <td>{{$problema->cliente_id}}</td>
                                    <td>{{ $problema->estado_id }}</td>
                                    <td>{{ $problema->fecha_creacion }}</td>

                                    <td>                                  
                                     {!! Form::open(['method' => 'DELETE','route' => ['problemas.destroy', $problema->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                      {!! Form::close() !!}
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
    </section>
@endsection
