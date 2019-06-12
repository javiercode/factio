<div class="form-group">
    <label class="control-label col-md-2">Importador
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <?=$importador['name'];?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Chasis</label>
    <div class="col-md-4">
        <input name="chasis" required="required" placeholder="Chasis"
               class="form-control" type="text" data-parsley-length="[3, 20]"
               value="">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Marca
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="marca" required="required" placeholder="Marca"
               class="form-control" type="text" data-parsley-length="[3, 20]"
               value="">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2" for="name">Modelo
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="modelo" required="required" placeholder="Modelo"
               class="form-control" type="text" data-parsley-length="[3, 20]"
               value="">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2" for="name">Color
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="color" required="required" placeholder="Color"
               class="form-control" type="text" data-parsley-length="[3, 20]"
               value="">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2" for="name">Observacion
    </label>
    <div class="col-md-4">
        <textarea name="observacion" class="form-control"
                  id="" cols="30" rows="3"></textarea>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Detalle</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
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
                <div class="row">
                    <label class="control-label col-md-1" for="name">Tipo
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-3">
                        <select name="searchTipo" id="" class="form-control">
                            <?php foreach($aTipoEnum as $keyTipo=>$oTipo){ ?>
                            <option value="<?=$keyTipo;?>"><?=$oTipo;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <label class="control-label col-md-1" for="name">Detalle
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-3">
                        <input name="searchDetalle" required="required" placeholder="Detalle"
                               class="form-control" type="text" value="">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-success" onclick="oPage.addItem(this)"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <br>
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