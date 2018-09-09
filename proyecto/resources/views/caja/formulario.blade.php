<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('plantilla/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('plantilla/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Nuevo Deposito
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
            background-color: #8a8a8a;
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
            <div id="login-column" class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" method="POST" action="{{url('/pago')}}">
                        {{ csrf_field() }}
                        <h3 class="text-center text-info">Nuevo Deposito</h3>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="cuenta" class="text-info">Nro de Cuenta:</label><br>
                                <input type="number" name="cuenta" id="cuenta" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="monto" class="text-info">Monto:</label><br>
                            <input type="number" name="monto" id="monto" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-info btn-block" type="submit">Guardar</button>
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