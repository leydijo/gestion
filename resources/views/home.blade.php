@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                    {{-- <div class="col-md-4 col-xl-4"> --}}
                                    
                                    {{-- <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                            <h5>Usuarios</h5>                                               
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ url('/usuarios') }}" class="text-white">Ver más</a></p>
                                            </div>                                     
                                        </div>                                    
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                            <h5>Roles</h5>                                               
                                                @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ url('/roles') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>                                                                 --}}
                                    
                                    {{-- <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Plataformas</h5>                                               
                                                @php
                                                 use App\Models\Plataforma;
                                                $cant_plataf = Plataforma::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_plataf}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ url('/plataformas') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Clientes</h5>                                               
                                                @php
                                                 use App\Models\Cliente;
                                                $cant_clit = Cliente::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_clit}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ url('/clientes') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-grey">
                                            <div class="card-block">
                                                <h3>Plataformas caidas</h3>
                                                <table id="plataformas" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Cliente</th>
                                                            <th>Plataforma</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($resultados as $resultado)
                                                        <tr>
                                                            <td>{{ $resultado->nombreCliente }}</td>
                                                            <td>{{ $resultado->nombrePlataforma }}</td>
                                                            <td class="{{ $resultado->estado == 'Caido' ? 'text-danger blink' : '' }}">{{ $resultado->estado }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Problemas y Solicitudes</h5>                                               
                                                @php
                                                 use App\Models\Problema;
                                                $cant_problm = Problema::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_problm}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ url('/problemas') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Estado de plaformas</h5>                                               
                                                @php
                                                 use App\Models\EstadoPlataforma;
                                                $cant_status = EstadoPlataforma::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_status}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ url('/estados') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>                        
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-xl-6">
                                    <div class="card bg-c-grey">
                                        <div class="card-block">
                                            <h3>Top 10 Clientes</h3>
                                            <canvas id="clientes" style="display:block;width:100%; height:600px"></canvas>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-4 col-xl-6">
                                    <div class="card bg-c-grey">
                                        <div class="card-block">
                                            <h3>Top 10 Usuarios</h3>
                                            <canvas id="usuarios" style="display:block;width:100%; height:600px"></canvas>
                                        </div>
                                    </div>
                                </div> 

                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')


<script>
    $(document).ready(function() {
        const cData = JSON.parse(`<?php echo $data_json; ?>`)
        console.log(cData);
        const ctx = document.getElementById('clientes')

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cData.label,
                datasets: [{
                    label: '# of Votes',
                    data: cData.data,
                    borderWidth: 1,
                    backgroundColor: 'rgba(54,162,235,1)'
                }]
            },
            options: {
                scales: {
                    yAxes: {
                        beginAtZero: true
                    }
                }
            }
        })
    });

    $(document).ready(function() {
        const cData = JSON.parse(`<?php echo $data_json2; ?>`)
        console.log(cData);
        const ctx = document.getElementById('usuarios')

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cData.label,
                datasets: [{
                    label: '# of Votes',
                    data: cData.data,
                    borderWidth: 1,
                    backgroundColor: 'rgba(54,162,235,1)'
                }]
            },
            options: {
                scales: {
                    yAxes: {
                        beginAtZero: true
                    }
                }
            }
        })
    });

    $(document).ready(function() {
        setInterval(function() {
            $('.blink').fadeOut(500).fadeIn(500);
        }, 1000);
    });

</script>
@endsection
