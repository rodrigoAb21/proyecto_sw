@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="pr-2">Servicios</h4><a href="{{url('/servicio/create')}}"><button class="btn btn-info btn-sm"><i class="nc-icon nc-simple-add"></i></button></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Ruta</th>
                                <th>Vehiculo</th>
                                <th>Sentido</th>
                                <th>Estado</th>
                                <th>Pasajeros</th>
                                <th>Costo</th>
                                <th>Opciones</th>

                                </thead>
                                <tbody>
                                @foreach($servicios as $servicio)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$servicio->fecha}}</td>
                                        <td>{{$servicio->ruta}}</td>
                                        <td>{{$servicio->vehiculo}}</td>
                                        <td>{{$servicio->sentido}}</td>
                                        <td>{{$servicio->estado}}</td>
                                        <td>{{$servicio->cant_p}}</td>
                                        <td>{{$servicio->costo}}</td>
                                        <td>
                                            <a href="{{url('/servicio/'.$servicio->id)}}">
                                                <button class="btn btn-default"><i class="nc-icon nc-zoom-split"></i></button>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{$servicio->id}}"><i class="nc-icon nc-simple-remove"></i></button>
                                        </td>
                                        @include('servicios.modal')
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