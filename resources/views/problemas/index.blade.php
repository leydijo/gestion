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
                                <th style="color:#fff;">Fecha solución</th>
                                <th style="color:#fff;">Fecha creación</th>
                                <th style="color:#fff;">Acciones</th>

                            </thead>
                            <tbody>
                                @if ($problems->isEmpty())
                                    <tr>
                                        <td class="center">
                                            <p>No hay problemas registrados.</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($problems as $problem)
                                        <tr>
                                            <td>{{ $problem->id }}</td>
                                            <td>{{ $problem->creado_por }}</td>
                                            <td>{{ $problem->plataforma->nombre }}</td>
                                            <td>{{ $problem->cliente->nombre }}</td>
                                            <td>{{ $problem->descripcion }}</td>
                                            <td><img src="{{ asset('storage') . '/' . $problem->img_error }}"
                                                    width="100">
                                            </td>
                                            <td><button class="btn btn-primary">ver</button></td>
                                            <td>{{ $problem->solucionado_por }}</td>
                                            <td>{{ $problem->fecha_solucion }}</td>
                                            <td>{{ $problem->fecha_creacion }}</td>
                                            <td>

                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal" data-problem-id="{{ $problem->id }}">
                                                    Ingresar solución
                                                </button>

                                                {{-- {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['problemas.destroy', $problem->id],
                                                    'style' => 'display:inline',
                                                ]) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!} --}}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
            @php
                $problemaId = $problems->isEmpty() ? null : $problems->first()->id;
            @endphp
            <div class="modal fade " id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ingrese una solución</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('problemas.update', $problemaId) }}" method="POST">
                                @csrf
                                @method('PATCH')
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
                                <input type="hidden" name="problema" id="problema-id" value="">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" data-dismiss="modal"
                                        data-backdrop="false">Guardar</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div  style="display:block;width:50%;">
                <h3>Graficas</h3>
                <canvas id="myChart" style="display:block;width:100%; height:600px"></canvas>
            </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const ctx = document.getElementById('myChart')

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:  {!! json_encode($descrip) !!},
                    datasets: [{
                        label: ' Top de Problemas',
                        data:  {!! json_encode($data) !!},
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                    
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
            
                        ],
                        
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
