@component('layouts.private')
@section('title', 'Central')
@slot('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-search"></i> Control / Centrales </h3>
            </div>

            <div class="title_right">
                <div class="col-md-9 col-sm-9 col-xs-12 form-group pull-right ">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel animated bounceInLeft">
                    <div class="x_title">
                        <h2>Listado</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="right">
                            <div class="col-md-2">
                                <label for="txtSearch"></label>
                                <button type="button" class="btn btn-sm btn-success btn-block" data-toggle="modal"
                                        data-target="#mAddItem"><i class="fa fa-plus"></i>Nueva Registro
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="txtSearch">Buscar :</label>
                            <div class="input-group">
                                <input class="form-control txtSearch" type="text" data-toggle="tooltip"
                                       data-placement="bottom" title="" onkeyup="oPageGeneric.filterColumn(this)"
                                       data-original-title="Introduzca la(s) palabra(s) y presione la tecla 'ENTER'">
                                <span class="input-group-btn search-panel">
                                    <button type="button" id="btnBusqAvan" class="btn btn-default" data-toggle="tooltip"
                                            data-placement="bottom" title="" data-original-title="Buscar...">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th></th>
                                    <th class="column-title">Nombre</th>
                                    <th class="column-title">Descripcion</th>
                                    <th class="column-title no-link last">Acciones</th>
                                    <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="tbody-busqueda">
                                   <?php
                                    $i=1;
                                    foreach ($aCentral as $oCentral){
                                        ?>
                                   <tr>
                                       <td>{{$i++}}
                                           <input type="hidden" name="pk" value="{{ $oCentral['id']}}">
                                           <input type="hidden" name="status" value="{{ $oCentral['status']}}">
                                       </td>
                                       <td>
                                           <?= $oCentral['nombre']?>
                                       </td>
                                       <td>
                                           <?= $oCentral['descripcion']?>
                                       </td>
                                       <td>
                                           <button type="button" onclick="oPage.edit(this)" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#mEditItem"><i class="fa fa-edit"></i></button>
                                           <button type="button" class="btn btn-danger" onclick="oPage.delete(this)"><i class="fa fa-trash"></i> </button>
                                       </td>
                                   </tr>
                                   <?php } ?>
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
    </div><!--/empty class-->
</div>

<div class="modal fade" id="mEditItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formEdit" action="{{ url('/param/central/create') }}" data-toggle="validator" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('param.central.form')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" value="ACTIVO">
                    <input type="hidden" name="pk" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success btn-borrador" code="BORRADOR" onclick="oPage.save(this)">Guardar Borrador</button>
                    <button type="button" class="btn btn-primary btn-activo" code="ACTIVO" onclick="oPage.save(this)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Central</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formAdd" action="{{ url('param/central/create') }}" data-toggle="validator" role="form">
            {{--<form class="form-horizontal form-label-left" id="formAdd" action="#" data-toggle="validator" role="form" onsubmit="return false">--}}
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('param.central.form')
                </div>
                <div class="modal-footer">

                    <input type="hidden" name="status" value="ACTIVO">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-activo" code="ACTIVO" onclick="oPage.save(this)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endslot
@slot('javascript')
    @include('param.central.js')
@endslot
@endComponent