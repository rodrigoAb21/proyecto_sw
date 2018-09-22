@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="pr-2">Resultado busqueda</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <th>Codigo</th>
                                <th>Hora de salida</th>
                                <th>Estado</th>
                                <th>Costo</th>
                                <th>Opciones</th>
                                </thead>
                                <tbody>
                                @foreach($servicios as $servicio)
                                    <tr>
                                        <td>{{$servicio->id}}</td>
                                        <td>{{$servicio->fecha}}</td>
                                        <td>{{$servicio->estado}}</td>
                                        <td>{{$servicio->costo}}</td>
                                        <td>
                                            <a href="{{url('/servicio/solicitar/detalle/'.$servicio->id)}}">
                                                <button class="btn btn-default btn-block"><i class="nc-icon nc-zoom-split"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection