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
                            <div class="table-responsive">
                                <table class="table table-striped mt-2">
                                    <thead style="background-color:#6777ef">
                                        
                                        <th style="color:#fff;">Creado por</th>
                                        <th style="color:#fff;">Cliente</th>
                                        <th style="color:#fff;">Plataforma</th>
                                        <th style="color:#fff;">Problema</th>
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
                                                    <td>{{ $problem->creado_por }}</td>
                                                    <td>{{ $problem->cliente->nombre }}</td>
                                                    <td>{{ $problem->plataforma->nombre }}</td>
                                                    <td>{{ $problem->titulo }}</td>
    
                                                    <td>{{ $problem->solucionado_por }}</td>
                                                    <td>{{ $problem->fecha_solucion }}</td>
                                                    <td>{{ $problem->fecha_creacion }}</td>
                                                    <td>
    
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#addModal{{ $problem->id }}">
                                                            Dar solución
                                                        </button>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modModal{{ $problem->id }}">
                                                            Editar
                                                        </button>
    
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['problemas.destroy', $problem->id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                <div style="z-index: 1;"class="modal fade" id="addModal{{ $problem->id }}" tabindex="1" aria-labelledby="addModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addModalLabel">Ingrese una solución</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                            
                                                                                
                                                                    <form action="{{ route('problemas.update', $problem->id) }}" method="POST">
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
                                                                            <button type="submit" class="btn btn-primary" data-backdrop="false">Guardar</button>
                                                                        </div>
                                            
                                                                    </form>
                                            
                                                            </div>
                                            
                                                        </div>
                                                    </div>
                                                </div>
 
                                                <div style="z-index: 1;"class="modal fade" id="modModal{{ $problem->id }}" tabindex="1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detalles del problema</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                <form action="{{ route('problemas.update', $problem->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="titulo">Titulo</label>
                                                                                {!! Form::text('titulo', $problem->titulo, ['class' => 'form-control']) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="descripcion">Descripcion</label>
                                                                                {!! Form::textarea('descripcion', $problem->descripcion, ['class' => 'form-control']) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="descripcion">Evidencia</label>
                                                                                <img src="{{ asset('storage') . '/' . $problem->img_error }}" width="75%">
    
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="solucion">Solucion</label>
                                                                                <p>{{$problem->solucion}}</p>
                                                                                
                                                                            </div>
                                                                        </div>                                                                        
                                        
                                                                    </div>
                                                                    <input type="hidden" name="problema" id="problema-id" value="">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" data-backdrop="false">Guardar</button>
                                                                    </div>
                                        
                                                                </form>

                                            
                                                            </div>
                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
    
                                        
                                        @endif
                                    </tbody>
    
                                </table>
                            </div>
                            
                        <div class="pagination justify-content-end">
                            {!! $problems->links() !!}
                          </div> 


                    </div>
                </div>
            </div>
        

    </section>
     
@endsection