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
                                        <td>{{ auth()->user()->name() }}</td>
                                        <td>{{ $plataforma->plataforma->nombre }}</td>
                                        <td>{{ $plataforma->cliente->nombre }}</td>
                                        <td>{{ $plataforma->estado->nombre }}</td>
                                        <td>{{ $plataforma->fecha_creacion }}</td> 
                                        
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="pagination justify-content-end">
                            {!! $plataformas->links() !!}
                        </div>

                    </div>
                </div>
            </div>
    </section>
@endsection
