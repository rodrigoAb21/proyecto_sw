@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mensaje del: {{$mensaje->fecha}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Titulo</label>
                                            <p class="form-control">{{$mensaje->titulo}}</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Descripcion</label>
                                            <p class="form-control">{{$mensaje->descripcion}}</p>
                                        </div>
                                    </div>

                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection