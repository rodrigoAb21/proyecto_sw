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

                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <button type="button" class="btn btn-warning btn-lg btn-block" onclick="eliminarUltimo()">Retroceder</button>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <button type="button" class="btn btn-danger btn-lg btn-block" onclick="eliminarPuntos()">Limpiar Mapa</button>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="form-control" >
                                        </div>

                                        <div class="form-group">
                                            <label>Descripcion</label>
                                            <textarea name="descripcion" class="form-control"></textarea>
                                        </div>

                                    </div>

                                    <table id="tabla" hidden></table>

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

    @push('scripts')
    <script>

        var ruta;
        var map;
        var currentPath;
        var cont = 0;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: -17.783312, lng: -63.182086},
                mapTypeId: 'terrain'
            });

            var puntos = new google.maps.MVCArray();


            ruta = new google.maps.Polyline({
                path: puntos,
                geodesic: true,
                strokeColor: '#347cff',
                strokeOpacity: 1.0,
                strokeWeight: 6
            });

            ruta.setMap(map);

            google.maps.event.addListener(map, 'click', function (e) {
                currentPath = ruta.getPath();
                currentPath.push(e.latLng);
                agregarPunto(e.latLng);
                // console.log(e.latLng.lat());
                // console.log(e.latLng.lng());
            });

        }

        function eliminarPuntos() {
            for (var l = currentPath.length; l != 0; l--){
                currentPath.pop();
                eliminar(l);
            }
        }

        function eliminarUltimo() {
            currentPath.pop();
            eliminar(cont);

        }

        function agregarPunto(location) {
            cont++;
            var longitud = location.lng();
            var latitud = location.lat();
            var fila = '<tr id="fila'+cont+'"><td><input name="longitudT[]" value="'+longitud+'"/><input name="latitudT[]" value="'+latitud+'"/></td></tr>';
            $("#tabla").append(fila);
        }

        function eliminar(index){
            if (cont > 0){
                $("#fila" + index).remove();
                cont--;
            }
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
    </script>
    @endpush
@endsection