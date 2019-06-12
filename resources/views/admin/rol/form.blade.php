<div class="form-group">
    <label class="control-label col-md-2">Nombre
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="name" required="required" placeholder="Nombre"
               class="form-control" type="text" data-parsley-length="[3, 20]"
               value="{{ $oBell->name or '' }}">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Sucursal</label>
    <div class="col-md-4">
        <?php foreach ($aBranch as $oBranch){?>
        <div class="checkbox">
            <label>
                <input name="id_branch[]" type="checkbox" value="<?=$oBranch['id'];?>"><?=$oBranch['name'];?>
            </label>
        </div>
        <?php }?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2" for="name">Tipo de descuento
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <select name="discount_type" required="required"  class="form-control" required="required" style="width: 100%">
            <option value="PORCENTAJE">Porcentaje (%)</option>
            <option value="PRECIO">Precio</option>
        </select>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Descuento
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="discount" required="required" placeholder="Descuento Numerico"
               class="form-control" type="text" data-parsley-length="[3, 20]"
               value="" pattern="^([0-9])*$">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"><small>El formato solo acepta numero</small></div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Fecha Inicio
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input type="text" name="date_start" class="form-control datepicker" value="" data-parsley-length="[8, 8]"
               data-inputmask="'mask': '99/99/9999'" required="required">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Fecha Fin
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input type="text" name="date_end" class="form-control datepicker" value="" data-parsley-length="[8, 8]"
               data-inputmask="'mask': '99/99/9999'" required="required">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Alcance
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <select name="scope" onchange="oPage.getValueScope(this)" class="form-control lib-select2" required="required" style="width: 100%">
            <?php foreach($eScope as $indexScope =>$oScope){?>
            <option value="<?=$indexScope?>"><?=$oScope?></option>
            <?php }?>
        </select>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Descripción</label>
    <div class="col-md-4">
        <textarea name="description" id="" cols="30" rows="2" class="form-control" data-parsley-length="[5, 500]"></textarea>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="x_panel">
            <div class="x_title">
                <label for="txtSearch">Agragar Item :</label>
            </div>
            <div class="row"></div>
            <div class="x_content" id="divBuscarItem">
                <div class="col-md-12">
                    <label for="txtSearch">Buscar :</label>
                    <div class="input-group">
                        <select name="selectItem" class=""  data-placement="bottom" style="width: 100%;">
                            <option value="">Seleccione valor</option>
                        </select>
                        {{--<input type="text" name="selectItem" class="form-control" style="width: 100%">--}}
                        <span class="input-group-btn search-panel">
                            <button type="button" class="btn btn-default" data-toggle="tooltip" onclick="oPage.addItem(this)"
                                    data-placement="bottom" title="" data-original-title="Buscar...">
                                <i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Detalle</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th></th>
                            <th class="column-title">Tipo</th>
                            <th class="column-title">Detalle</th>
                            <th class="column-title no-link last">Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /form input knob -->

</div>