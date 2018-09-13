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

    @push('scripts')
        <script>

            var ruta;
            var map;
            var puntos = [];

            @foreach($puntos as $punto)
                puntos.push({lat:parseFloat('{{$punto -> latitud}}'), lng:parseFloat('{{$punto -> longitud}}')});
            @endforeach

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: {lat: -17.783312, lng: -63.182086},
                    mapTypeId: 'terrain'
                });

                console.log(puntos);

                ruta = new google.maps.Polyline({
                    path: puntos,
                    geodesic: true,
                    strokeColor: '#347cff',
                    strokeOpacity: 1.0,
                    strokeWeight: 6
                });

                ruta.setMap(map);

            }


        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
        </script>
    @endpush
@endsection