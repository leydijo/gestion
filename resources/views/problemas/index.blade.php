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
                                <th style="color:#fff;">Description</th>
                                <th style="color:#fff;">Imagen</th>
                                <th style="color:#fff;">Solución</th>
                                <th style="color:#fff;">Fecha creación</th>

                            </thead>
                            
                        </table>
                        

                    </div>
                </div>
            </div>
    </section>
@endsection
