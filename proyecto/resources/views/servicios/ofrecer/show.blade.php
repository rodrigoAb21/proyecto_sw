@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="height: 490px"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <h6>Detalle</h6>
                            <div class="row">

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Codigo</label>
                                        <p class="form-control" >{{$servicio->id}}</p>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Hora</label>
                                        <p class="form-control" >{{$servicio->fecha}}</p>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <p  class="form-control" >{{$servicio->costo}} Bs.</p>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Asientos libres</label>
                                        <p  class="form-control" >{{$servicio->cant_p}}</p>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <p class="form-control">{{$vehiculo->marca}} - {{$vehiculo->modelo}}</p>
                                        <label>Placa</label>
                                        <p class="form-control">{{$vehiculo->placa}}</p>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <img src="{{asset('img/vehiculos/'.$vehiculo -> placa.'/'.$vehiculo->foto)}}" alt="{{$vehiculo -> placa}}"class="img-thumbnail pt-2" style="margin: 0 auto; display: block;" >
                                </div>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <th>Nombre</th>
                                    <th>Registro</th>
                                    </thead>
                                    <tbody>
                                    @foreach($solicitudes as $solicitud)
                                        <tr>
                                            <td>{{$solicitud->nombre}} {{$solicitud->apellido}}</td>
                                            <td>{{$solicitud->codigo}}</td>
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
    </div>

    @push('shead')
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
    @endpush
    @push('scripts')
        <script>
            mapboxgl.accessToken = 'pk.eyJ1Ijoicm9kcmlnb2FiMjEiLCJhIjoiY2psenZmcDZpMDN5bTNrcGN4Z2s2NWtqNSJ9.bSdjQfv-28z1j4zx7ljvcg';
            var map = new mapboxgl.Map({
                container: 'map', // container id
                style: 'mapbox://styles/mapbox/streets-v9',
                center: [-63.180547, -17.783603], // starting position
                zoom: 12 // starting zoom
            });

            // Add geolocate control to the map.
            map.addControl(new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            }));

            // Create a GeoJSON source with an empty lineString.
            var ruta = {
                "type": "FeatureCollection",
                "features": [{
                    "type": "Feature",
                    "geometry": {
                        "type": "LineString",
                        "coordinates": []
                    }
                }]
            };




            @foreach($solicitudes as $solicitud)
                var marker = new mapboxgl.Marker()
                        .setLngLat([parseFloat('{{$solicitud -> longitud}}'), parseFloat('{{$solicitud -> latitud}}')])
                        .addTo(map);
            @endforeach


            map.on('load', function() {

                @foreach($puntos as $punto)
                    ruta.features[0].geometry.coordinates.push([parseFloat('{{$punto -> longitud}}'),parseFloat('{{$punto -> latitud}}')]);
                @endforeach

                map.addLayer({
                    'id': 'linea',
                    'type': 'line',
                    'source': {
                        'type': 'geojson',
                        'data': ruta
                    },
                    'layout': {
                        'line-cap': 'round',
                        'line-join': 'round'
                    },
                    'paint': {
                        'line-color': '#338ced',
                        'line-width': 8,
                        'line-opacity': .8
                    }
                });



            });


        </script>

    @endpush




@endsection