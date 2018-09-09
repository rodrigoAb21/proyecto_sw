@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Movimientos de la cuenta: {{$cuenta -> nro}}</h4>
                        <h6 class="pull-right">Saldo: {{$cuenta -> saldo}} Bs.</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-full-width">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <th>ID</th>
                                <th>fecha</th>
                                <th>Tipo</th>
                                <th>Descripcion</th>
                                <th>monto</th>
                                </thead>
                                <tbody>
                                    @foreach($movimientos as $movimiento)
                                        <tr>
                                            <td>{{$movimiento->id}}</td>
                                            <td>{{$movimiento->fecha}}</td>
                                            <td>{{$movimiento->tipo}}</td>
                                            <td>{{$movimiento->descripcion}}</td>
                                            <td>{{$movimiento->monto}} Bs.</td>
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