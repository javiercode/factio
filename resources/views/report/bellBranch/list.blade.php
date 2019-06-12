@component('layouts.master')
@slot('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-search"></i> Reportes / por campaña</h3>
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
                            <small><?=$branch;?></small>
                        </h2>
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
                                    <th rowspan="2"></th>
                                    <th rowspan="2" class="column-title">Campaña</th>
                                    <th rowspan="2" class="column-title">Descuento</th>
                                    <th rowspan="2" class="column-title">Alcance</th>
                                    <th colspan="4" class="column-title">Detalle</th>
                                </tr>
                                <tr>
                                    <th class="column-title" width="1"></th>
                                    <th class="column-title" width="180">Item</th>
                                    <th class="column-title" width="50">Precio Normal</th>
                                    <th class="column-title" width="50">Precio Descuento</th>
                                </tr>
                                </thead>
                                <tbody class="tbody-busqueda">
                                <?php
                                $i=1;
                                foreach ($aBell as $oBell){
                                ?>
                                <tr>
                                    <td>
                                        <?= $i++;?>
                                        <input type="hidden" name="pk" value="<?= $oBell['id'];?>">
                                    </td>
                                    <td><?= $oBell['name'];?>
                                        <br>
                                        <small><strong> Periodo:</strong>
                                            <?= $oBell['date_start']?> a <?=$oBell['date_end'];?></small>
                                        <br>
                                        <small><strong> Descripción: </strong><?=$oBell['description'];?></small>
                                        <br>
                                        <small>
                                            <strong class="legend-status-borrador">
                                                <?= $oBell['status']?>
                                            </strong>
                                        </small>
                                    </td>
                                    <td>
                                        <?= $oBell['discount'] ?><?=  $oBell['discount_type']=='PRECIO'? '(Moneda)':'(%)' ?>
                                        <a class="panel-heading" role="tab" href="javascript:void(0)" onclick="oPage.swDetalle(this)">
                                            <i class="fa fa-minus-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <table class="table panel-collapse" style="width: 100%">
                                            <tbody>
                                            <?php
                                            if(isset($aBellDetail[$oBell['id']])){
                                                foreach ($aBellDetail[$oBell['id']] as $oDetail){?>
                                            <tr>
                                                <td><?=$aScope[$oDetail['type']];?></td>
                                                <td><?=$oDetail['name'];?></td>
                                            </tr>
                                            <?php } }?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td colspan="5">
                                        <table class="table panel-collapse" style="width: 100%">
                                            <tbody>
                                            <?php
                                             if(isset($aBellItemDetail[$oBell['id']])){
                                                 foreach ($aBellItemDetail[$oBell['id']] as $oBellDetail){
                                                $priceNew = $oBell['discount_type']=='PRECIO'? ((($oBellDetail['price'])*1)-$oBell['discount']):($oBellDetail['price']- (($oBell['discount']/100)*($oBellDetail['price'])));
                                                ?>
                                            <tr>
                                                <td scope="row"></td>
                                                <td><?=$oBellDetail['name'];?> <br>
                                                    <small><strong>Codigo: </strong>
                                                        <?=$oBellDetail['part_nro'];?></small>
                                                </td>
                                                <td><?=$oBellDetail['price'];?></td>
                                                <td><?=$priceNew;?></td>
                                            </tr>
                                            <?php } }?>
                                            </tbody>
                                        </table>
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
    @include('report.bellBranch.js')
@endslot
@endComponent
