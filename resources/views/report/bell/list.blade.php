@component('layouts.master')
@slot('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-search"></i> Parametros / Item por Sucursal</h3>
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
                            <small>{{$branch}}</small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-chevron-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach ($aBranch as $oBranch){
                                        ?>
                                        <li><a href="<?=url('report/bell').'?id='.$oBranch['id'];?>"><?=$oBranch['name'];?></a></li>
                                        <?php
                                    }?>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
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
                                    <th>
                                    </th>
                                    <th class="column-title">Nro Parte</th>
                                    <th class="column-title">Nombre</th>
                                    <th class="column-title">Categoria</th>
                                    <th class="column-title">Codigo Marketing</th>
                                    <th class="column-title">Cantidad</th>
                                    <th class="column-title">Precio</th>
                                    <th class="column-title">Campañas</th>
                                </tr>
                                </thead>
                                <tbody class="tbody-busqueda">
                                <?php
                                $i=1;
                                foreach ($aItemBranch as $oItem){
                                ?>
                                <tr>
                                    <td>
                                        {{ $i++}}
                                        <input type="hidden" name="pk" value="{{ $oItem['id']}}">
                                    </td>
                                    <td>{{ $oItem['part_nro']}}
                                        <br>
                                        <small><strong> Codigo:</strong>
                                            {{ $oItem['prefix'].'-'.$oItem['part_nro'].'-'.$oItem['product_line']}}</small>
                                    </td>
                                    <td>
                                        {{ $oItem['name']}} <br>
                                        <small><strong> Observación: </strong>{{$oItem['observation'] or ''}}</small>
                                    </td>
                                    <td>
                                        <small><strong> Grupo: </strong>{{isset($aProductGroup[$oItem['product_group']])?$aProductGroup[$oItem['product_group']]:$oItem['product_group']}}</small><br>
                                        <small> <strong>Parte categoria:</strong> {{isset($aPartGategory[$oItem['part_category']])?$aPartGategory[$oItem['part_category']]:$oItem['part_category']}}</small>
                                    </td>
                                    <td>
                                        {{isset($aMarketingCode[$oItem['marketing_code']])?$aMarketingCode[$oItem['marketing_code']]:$oItem['marketing_code'] }}<br>
                                        <small><strong> Linea Producto: </strong>{{isset($aProductLine[$oItem['product_line']])?$aProductLine[$oItem['product_line']]:$oItem['product_line']}}</small>
                                        <br>
                                        <small><strong> Id Estrategía: </strong>{{isset($oItem['strategy_id'])?$oItem['strategy_id']:$oItem['strategy_id']}}</small>
                                    </td>
                                    <td>{{ $oItem['cantidad'] or '0'}} <br>
                                        <small><strong> Stock min: </strong>{{$oItem['stock_minium']}}</small>
                                    </td>
                                    <td>{{ $oItem['price']." ".$oItem['currency']}}</td>
                                    <td>
                                        <?php
                                        if(isset($aBell['*'.$oItem['id_item']]) && is_array($aBell['*'.$oItem['id_item']]) && sizeof($aBell['*'.$oItem['id_item']])>0){
                                        $oBell = $aBell['*'.$oItem['id_item']];
                                        $index = 0;
                                        foreach ($oBell['discount'] as $discount){?>
                                        <small>
                                            <dl>
                                                <dt class="fleft"><strong>Campaña: </strong></dt>
                                                <dd class="fright"><?= $oBell['name'][$index]?></dd>
                                                <br>
                                                <dt class="fleft">Precio</dt>
                                                <dd class="fright"><?=$discount;?></dd>
                                            </dl>
                                        </small>
                                        <?php
                                        $index++;
                                        }};?>
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
<div class="modal fade" id="mAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formAdd" action="{{ url('/param/itemBranch/create') }}" data-toggle="validator" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('param.itemBranch.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="mEditItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="formEdit" action="{{ url('/param/itemBranch/create') }}" data-toggle="validator" role="form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('param.itemBranch.form')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pk" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="oPage.update(this)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endslot
@slot('javascript')
    @include('param.itemBranch.js')
@endslot
@endComponent
