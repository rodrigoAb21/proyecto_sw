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
                                                <button type="button" class="btn btn-warning btn-block" onclick="eliminarUltimo()">Retroceder</button>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <button type="button" class="btn btn-danger btn-block" onclick="eliminarPuntos()">Limpiar Mapa</button>
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

    @push('shead')
        <script src='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css' rel='stylesheet' />
    @endpush

    @push('scripts')
    <script>

        var cont = 0;


        L.mapbox.accessToken = 'pk.eyJ1Ijoicm9kcmlnb2FiMjEiLCJhIjoiY2psenZmcDZpMDN5bTNrcGN4Z2s2NWtqNSJ9.bSdjQfv-28z1j4zx7ljvcg';
        var map = L.mapbox.map('map', 'mapbox.streets')
            .setView([-17.783603, -63.180547], 14);


        var puntos = [];
        var opciones = {
            color: '#347cff',

        };

        var ruta = L.polyline(puntos, opciones).addTo(map);


        map.on('click', function(e) {
            ruta.addLatLng(e.latlng)
            agregarPunto(e.latlng);
        });


        function eliminarPuntos() {
            for (var l = ruta.getLatLngs().length; l != 0; l--){
                eliminarUltimo();
                eliminar(l);
            }
        }

        function eliminarUltimo() {
            if(ruta.getLatLngs().length > 0){
                ruta.getLatLngs().pop();
                ruta.setLatLngs(ruta.getLatLngs());
                eliminar(cont);
            }
        }

        function agregarPunto(location) {
            cont++;
            var latitud = location.lat;
            var longitud = location.lng;
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
    @endpush
@endsection