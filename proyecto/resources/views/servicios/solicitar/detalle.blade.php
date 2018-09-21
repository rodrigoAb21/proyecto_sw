@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <h6>Detalle</h6>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Codigo</label>
                                        <p class="form-control" >{{$servicio->id}}</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Hora</label>
                                        <p class="form-control" >{{$servicio->fecha}}</p>
                                    </div>


                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <p  class="form-control" >{{$servicio->costo}} Bs.</p>
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                    <img src="{{asset('img/'.$conductor->codigo.'/'.$conductor->foto)}}" class="img-thumbnail" style="margin: 0 auto; display: block;" >
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Registro</label>
                                        <p class="form-control">{{$conductor->codigo}}</p>
                                        <label>Nombre completo</label>
                                        <p class="form-control">{{$conductor->nombre}} {{$conductor -> apellido}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <p class="form-control">{{$vehiculo->marca}} - {{$vehiculo->modelo}}</p>
                                        <label>Placa</label>
                                        <p class="form-control">{{$vehiculo->placa}}</p>
                                    </div>
                                </div>

                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <img src="{{asset('img/vehiculos/'.$vehiculo -> placa.'/'.$vehiculo->foto)}}" alt="{{$vehiculo -> placa}}"class="img-thumbnail pt-2" style="margin: 0 auto; display: block;" >
                                </div>

                            </div>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <form action="{{url('/servicio/solicitar/busqueda')}}" method="POST" autocomplete="off">
                                        {{csrf_field()}}
                                        <input type="text" id="latitud" name="latitud" hidden>
                                        <input type="text" id="longitud" name="longitud" hidden>
                                        <button class="btn btn-warning btn-round" type="submit">Solicitar</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="height: 490px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection