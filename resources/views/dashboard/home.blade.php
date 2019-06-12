@component('layouts.private')
@section('title', 'Inicio')
@slot('content')
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css" />

<div class="right_col" role="main">
    <div class="">
        <div class="row top_tiles div-content"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mapa</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="mapa_canvas" style="border:1px solid red; width: 800px;height: 500px;">mapa</div>
                        <button class="form-control"><i class="fa fa-refresh"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="divClone" style="display: none">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="alert alert-danger">
                <div class="icon">
                    <i class="fa fa-bullhorn"></i>
                </div>
            </div>
            <div class="count div-estado">NO DISPONIBLE</div>
            <h3 class="h-detalle">New Sign ups</h3>
            <p class="p-tipo">Lorem ipsum psdea itgum rixt.</p>
        </div>
    </div>
</div>
<div id="divCloneLi" style="display: none">
    <li class="media event">
        <a class="pull-left border-green profile_thumb">
            <i class="fa fa-bullhorn green"></i>
        </a>
        <div class="media-body">
            <a class="title" href="#">Ms. Mary Jane</a>
            <p class="p-detalle"><strong>$2300. </strong> Agent Avarage Sales </p>
            <p>
                <small class="s-descripcion">12 Sales Today</small>
            </p>
        </div>
    </li>
</div>
<div class="modal fade" id="mAsignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Registro Vehicular</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formAsignacion" action="{{ url('control/asignacion/create') }}" data-toggle="validator" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sensor</label>
                                <div class="col-md-8 div-nombre-sensor">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Marca
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select name="id_vehiculo" id="" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pk" value="">
                    <input type="hidden" name="status" value="ACTIVO">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-activo" code="ACTIVO">Guardar</button>
                    {{--<button type="button" class="btn btn-primary" onclick="oPage.save()">Guardar</button>--}}
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="mAlerta" tabindex="-1" role="dialog" aria-labelledby="modalAlerta" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alerta de alarma</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-lg-2 control-label">Detalle</label>
                    <div class="col-lg-10">
                        <p class="form-control-static p-alerta-detalle"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Tipo</label>
                    <div class="col-lg-10">
                        <p class="form-control-static p-alerta-tipo"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="oPage.apagarAlerta()" data-dismiss="modal">Apagar Alarma</button>
            </div>
        </div>
    </div>
</div>


<!--<script src="http://www.google.com/jsapi"></script>-->
<!--<script src="http://maps.google.com/maps/api/js"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB496BgOHBb3XeURpxPvhfVGHVFY3iMsTw"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
@endslot
@slot('javascript')
    @include('dashboard.js')
@endslot
@endComponent