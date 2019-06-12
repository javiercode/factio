@component('layouts.private')
@section('title', 'Usuario')
@slot('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-search"></i> Administración / Usuario </h3>
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
                                        data-target="#mAddItem"><i class="fa fa-plus"></i>Nueva usuario
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
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="column-title">Persona</th>
                                    <th colspan="<?=sizeof($aRol)+1;?>" class="column-title center">Usuarios</th>
                                    <th rowspan="2" class="column-title">Acciones</th>
                                </tr>
                                <tr>
                                    <th width="100">username</th>
                                    <?php foreach ($aRol as $rol){?>
                                    <th width="100"><?=$rol['name'];?></th>
                                    <?php }?>
                                </tr>
                                </thead>
                                <tbody class="tbody-busqueda">
                                <?php
                                $i=1;
                                foreach ($aPersonUser as $oPerson){
                                ?>
                                <tr>
                                    <td><?=$i++?>
                                        <input type="hidden" name="pk" value="<?= $oPerson['id']?>">
                                    </td>
                                    <td><?=$oPerson['nombre_formal'];?></td>
                                    <td colspan="5">
                                        <table class="sub-tabla">
                                            <tbody>
                                            <?php
                                            $aUserPerson = isset($aUser[$oPerson['id']])? $aUser[$oPerson['id']]:array();

                                            foreach ($aUserPerson as $oUser){
                                                ?>
                                                <tr>
                                                    <td width="100"><?=$oUser['username'];?>
                                                        <input type="hidden" name="pkUser" value="<?=$oUser['id_user'];?>">
                                                    </td>
                                                    <?php foreach ($aRol as $rol){
                                                        ?>
                                                        <td width="100">
                                                            <input type="hidden" name="id_user" value="<?=$oUser['id_user'];?>">
                                                            <input type="hidden" name="id_rol" value="<?=$rol['id'];?>">
                                                            <input type="checkbox" <?= isset($aRolUser[$oUser['id_user']]) && in_array($rol['id'], $aRolUser[$oUser['id_user']])?'checked':'';?> name="" onclick="oPage.updateRol(this)">
                                                        </td>
                                                    <?php }?>
                                                    <td width="100">
                                                        <button type="button" onclick="oPage.edit(this)" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#mEditItem"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger" onclick="oPage.delete(this)"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr><?php
                                            }?>
                                            </tbody>
                                        </table>
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
    </div>
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
            <form class="form-horizontal form-label-left" id="formEdit" action="{{ url('admin/user/create') }}" data-toggle="validator" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('admin.user.form')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" value="ACTIVO">
                    <input type="hidden" name="pk" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-activo" onclick="oPage.save(this)">Guardar</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formAdd" action="{{ url('admin/user/create') }}" data-toggle="validator" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('admin.user.form')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" value="ACTIVO">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-activo" onclick="oPage.save(this)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formRol" action="#" data-toggle="validator" onsubmit="return false" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('admin.user.rol')
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>
@endslot
@slot('javascript')
    @include('admin.user.js')
@endslot
@endComponent