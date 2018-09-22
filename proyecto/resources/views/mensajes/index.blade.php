@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="pr-2">Mensajes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Titulo</th>
                                <th>Opciones</th>

                                </thead>
                                <tbody>
                                @foreach($mensajes as $mensaje)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$mensaje->fecha}}</td>
                                        <td>{{$mensaje->titulo}}</td>
                                        <td>
                                            <a href="{{url('/mensajes/'.$mensaje->id)}}">
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