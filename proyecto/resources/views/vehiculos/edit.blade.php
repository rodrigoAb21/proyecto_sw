@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('img/vehiculos/'.$vehiculo -> placa.'/'.$vehiculo->foto)}}" alt="{{$vehiculo -> placa}}"class="img-thumbnail" style="margin: 0 auto; display: block;" >
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="card-title">Editar vehiculo</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/vehiculos/'.$vehiculo->id)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Placa</label>
                                        <input type="text" name="placa" class="form-control" value="{{$vehiculo->placa}}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <input type="text" name="marca" class="form-control" value="{{$vehiculo->marca}}" >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Modelo</label>
                                        <input type="text" name="modelo" class="form-control" value="{{$vehiculo->modelo}}" >
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Año</label>
                                        <input type="number" name="anho" class="form-control" value="{{$vehiculo->anho}}">
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" name="color" class="form-control" value="{{$vehiculo->color}}">
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Capacidad (Pasajeros)</label>
                                        <input type="number" min="1" name="capacidad" class="form-control" value="{{$vehiculo->capacidad}}">
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="foto" >Foto</label>
                                        <br>
                                        <span class="btn btn-warning btn-round btn-sm">Seleccionar
                                            <input type="file" class="form-control-file" name="foto" accept="image/jpeg, image/jpg, image/png, image/bmp">
                                        </span>
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