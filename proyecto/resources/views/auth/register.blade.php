<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('plantilla/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('plantilla/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Registro
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('plantilla/css/bootstrap.min.css')}}" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
        }
        #login .container #login-row #login-column #login-box {
            margin-top: 5em;
            border: 1px solid #ffffff;
            background-color: #ffffff;
            border-radius: 2em;
            margin-bottom: 5em;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
    </style>
</head>

<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-xs-12">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <h3 class="text-center text-info">Registro</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="carnet" class="text-info">Carnet:</label><br>
                                    <input type="number" name="carnet" id="carnet" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="codigo" class="text-info">Codigo:</label><br>
                                    <input type="number" name="codigo" id="codigo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="text-info">Nombres:</label><br>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="text-info">Apellidos:</label><br>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="text-info">Telefono:</label><br>
                            <input type="number" name="telefono" id="telefono" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="text-info">Direccion:</label><br>
                            <input type="text" name="direccion" id="direccion" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-block" type="submit">Registrarse</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('plantilla/js/core/jquery.min.js')}}"></script>
<script src="{{asset('plantilla/js/core/popper.min.js')}}"></script>
<script src="{{asset('plantilla/js/core/bootstrap.min.js')}}"></script>
</body>

</html>