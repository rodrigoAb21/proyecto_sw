@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="pr-2">Gestionar Vehiculos</h4><a href="{{url('/vehiculos/create')}}"><button class="btn btn-info btn-sm"><i class="nc-icon nc-simple-add"></i></button></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <th>Nro</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Opciones</th>
                                </thead>
                                <tbody>
                                @foreach($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$vehiculo->placa}}</td>
                                        <td>{{$vehiculo->marca}}</td>
                                        <td>{{$vehiculo->modelo}}</td>
                                        <td>
                                            <a href="{{url('/vehiculos/'.$vehiculo->id.'/edit')}}">
                                                <button class="btn btn-warning"><i class="nc-icon nc-settings-gear-65"></i></button>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{$vehiculo->id}}"><i class="nc-icon nc-simple-remove"></i></button>
                                        </td>
                                        @include('vehiculos.modal')
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