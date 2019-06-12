@component('layouts.private')
@section('title', 'Reporte')
@slot('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-search"></i> Reporte </h3>
            </div>
            <div class="title_right">
                <div class="col-md-9 col-sm-9 col-xs-12 form-group pull-right ">
                </div>
            </div><!--/title_right-->
        </div><!--/page-title-->
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel animated bounceInLeft">
                    <div class="x_title">
                        <h2>Listado
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-inline" name="formFilter" onsubmit="return false;">
                                    <div class="form-group">
                                        <label for="ex3">Central</label>
                                        <select name="idCentralFilter" id="" class="form-control">
                                            <option value="">Todas</option>
                                            <?php foreach ($aCentral as $oCentral){?>
                                                <option value="<?=$oCentral['id'];?>"><?=$oCentral['nombre'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex4">Tipo Alerta</label>
                                        <select name="tipoFilter" class="form-control">
                                            <option value="">Todos</option>
                                            <?php foreach ($aTipo as $oTipo){?>
                                            <option value="<?=$oTipo['codigo'];?>"><?=$oTipo['detalle'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaInicioFilter">Fecha Inicio</label>
                                        <input type="text" name="fechaInicioFilter" class="form-control datepicker" placeholder="dd/mm/aaaa">
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaFinFilter">Fecha Fin</label>
                                        <input type="text" name="fechaFinFilter" class="form-control datepicker" placeholder="dd/mm/aaaa">
                                    </div>
                                    <button type="button" class="btn btn-default" onclick="oPage.getList()">Buscar</button>

                                </form>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" onclick="oPage.getPdf()"><i class="fa fa-file-pdf-o"></i>Exportar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label for="boxRows">Filas :</label>
                                <select class="form-control pointer" id="boxRows">
                                    <option value="5">5</option>
                                    <option value="10" selected="selected">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th>
                                    </th>
                                    <th class="column-title">Nro</th>
                                    <th class="column-title">Central</th>
                                    <th class="column-title">Alarma</th>
                                    <th class="column-title">Tipo</th>
                                    <th class="column-title">Estado</th>
                                    <th class="column-title">Fecha</th>
                                    <th class="column-title">Descripcion</th>
                                    <th class="column-title">Ubicación</th>
                                </tr>
                                </thead>
                                <tbody class="tbody-busqueda">
                                <?php
                                $i=1;
                                foreach ($aSensorDato as $oAlarma){
                                ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ $i++}}
                                        <input type="hidden" name="pk" value="{{ $oAlarma['id']}}">
                                    </td>
                                    <td>{{ $oAlarma['central']}}</td>
                                    <td>{{ $oAlarma['codigo'].' - '.$oAlarma['detalle']}}</td>
                                    <td>{{ $oAlarma['tipo']}}</td>
                                    <td>{{ $oAlarma['estado']}}</td>
                                    <td>{{ $oAlarma['fecha']}}</td>
                                    <td>{{ $oAlarma['descripcion']}}</td>
                                    <td>
                                        {{ $oAlarma['ubicacion']}} <br>
                                        <small><strong> Coordenadas: </strong>{{$oAlarma['latitud'] .', '.$oAlarma['longitud'] }}</small>
                                    </td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 col-md-offset-4">
                                <div class="input-group">
                            <span class="input-group-btn">
                            <button class="btn btn-default btnPrevious " type="button" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Página Anterior"><i
                                        class="fa fa-arrow-left"></i></button>
                            </span>
                                    <select class="selectpicker form-control pointer boxSkip " data-live-search="true"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Número de Página">
                                        <option value="0">1</option>
                                        option
                                    </select>
                                    <span class="input-group-btn">
                            <button class="btn btn-default btnNext " type="button" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Página Siguiente"><i
                                        class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- LARGE MODAL --}}
        <div class="modal fade bs-example-modal-lg {{-- animated tada --}}" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <div class="modal-content modal-content-lg"></div>
            </div>
        </div>
    </div>
</div>
@endslot
@slot('javascript')
    @include('report.reporte.js')
@endslot
@endComponent
