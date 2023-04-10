@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Plataformas</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                          <a class="btn btn-warning" href="{{ route('plataformas.create') }}">Nuevo</a>        
                         
                            <table class="table table-striped mt-2">
                              <thead style="background-color:#6777ef">                                     
                                  <th style="color:#fff;">ID</th>
                                  <th style="color:#fff;">Nombre</th>
                                  <th style="color:#fff;">Cliente</th>
                                  <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                                @foreach ($plataformas as $plt)
                                  <tr>
                                    <td>{{ $plt->id }}</td>
                                    <td>{{ $plt->nombre }}</td>
                                    <td>{{ $plt->cliente->nombre }}</td>
                                   
                                    <td>                                  
                                    
                                      {!! Form::open(['method' => 'DELETE','route' => ['plataformas.destroy', $plt->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                      {!! Form::close() !!}
                                    </td>
                                   
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->
                          <div class="pagination justify-content-end">
                            {!! $plataformas->links() !!}
                          </div>     
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection