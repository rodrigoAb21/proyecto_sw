@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="card-title">Nuevo Servicio</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/servicio/ofrecer')}}" method="POST" autocomplete="off">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Sentido</label>
                                        <select  class="form-control" name="sentido">
                                            @foreach($sentidos as $sentido)
                                                <option value="{{$sentido}}">{{$sentido}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Fecha a realizarse</label>
                                        <input type="date" name="fecha" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Hora de inicio</label>
                                        <input type="time" name="hora" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Cantidad (pasajeros)</label>
                                        <input type="number" name="cant_p" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Costo</label>
                                        <input type="number" name="costo" class="form-control">
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Vehiculo</label>
                                        <select  class="form-control" name="vehiculo_id">
                                            @foreach($vehiculos as $vehiculo)
                                                <option value="{{$vehiculo -> id}}">{{$vehiculo -> marca}} - {{$vehiculo -> placa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Ruta</label>
                                        <select  class="form-control" name="ruta_id">
                                            @foreach($rutas as $ruta)
                                                <option value="{{$ruta -> id}}">{{$ruta -> nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button class="btn btn-warning btn-round" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection