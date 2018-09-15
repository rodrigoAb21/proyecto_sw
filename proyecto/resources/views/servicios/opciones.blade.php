@extends('layouts.dashboard')
@section('contenido')
<div class="content">
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <a href="{{url('/servicio/ofrecer')}}">
                <div class="card card-stats">
                    <div class="card-header"></div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-bus-front-12"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Ofrecer servicio</p>
                                    <p class="card-title">Conductor<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <a href="{{url('/servicio/solicitar')}}">
                <div class="card card-stats">
                    <div class="card-header"></div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-02 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Solicitar servicio</p>
                                    <p class="card-title">Cliente<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection()