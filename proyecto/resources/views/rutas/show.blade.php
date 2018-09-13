@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="card-title">Ruta: {{$ruta -> nombre}}</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="map" style="height: 500px;"></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <p class="form-control">{{$ruta -> descripcion}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('shead')
        <script src='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css' rel='stylesheet' />
    @endpush
    @push('scripts')
        <script>

            L.mapbox.accessToken = 'pk.eyJ1Ijoicm9kcmlnb2FiMjEiLCJhIjoiY2psenZmcDZpMDN5bTNrcGN4Z2s2NWtqNSJ9.bSdjQfv-28z1j4zx7ljvcg';
            var map = L.mapbox.map('map', 'mapbox.streets')
                .setView([-17.783603, -63.180547], 14);


            var puntos = [];

            @foreach($puntos as $punto)
            puntos.push([parseFloat('{{$punto -> latitud}}'),parseFloat('{{$punto -> longitud}}')]);
            @endforeach

            var opciones = {
                color: '#347cff',

            };

            L.polyline(puntos, opciones).addTo(map);


        </script>

    @endpush
@endsection