@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Plataforma</h3>
        </div>
        <div class="section-body">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('plataformas.create') }}">Nuevo</a>
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Url</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($plataformas as $plataforma)
                                    <tr>
                                        <td>{{ $plataforma->id }}</td>
                                        <td>{{ $plataforma->nombre }}</td>
                                        <td>{{ $plataforma->url }}</td>
                                        
                                        <td>

                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['plataformas.destroy', $plataforma->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        

                    </div>
                </div>
            </div>
    </section>
@endsection
