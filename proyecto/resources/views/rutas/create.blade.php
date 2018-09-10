@extends('layouts.dashboard')
@section('contenido')
    <div class="content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header form-inline">
                        <h4 class="card-title">Nueva Ruta</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/rutas')}}" method="POST" autocomplete="off">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div id="map" style="height: 500px;"></div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4">

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <button type="button" class="btn btn-danger btn-lg btn-block">Limpiar Mapa</button>


                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="form-control" >
                                        </div>

                                        <div class="form-group">
                                            <label>Descripcion</label>
                                            <textarea name="descripcion" class="form-control"></textarea>
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


    <script>

        // This example creates a simple polygon representing the Bermuda Triangle.

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: -17.783312, lng: -63.182086},
                mapTypeId: 'terrain'
            });

            var flightPlanCoordinates = [
                {lat: -17.817699, lng: -63.225777},
                {lat: -17.822625, lng: -63.220469},
                {lat: -17.829316, lng: -63.227976},
                {lat: -17.823934, lng: -63.232901}
            ];
            var flightPath = new google.maps.Polyline({
                path: flightPlanCoordinates,
                geodesic: true,
                strokeColor: '#347cff',
                strokeOpacity: 1.0,
                strokeWeight: 6
            });

            flightPath.setMap(map);

        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
    </script>
@endsection