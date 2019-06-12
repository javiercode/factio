<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-4">Telefono (Codigo)</label>
            <div class="col-md-8">
                <input name="codigo" required="required" placeholder="Codigo"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Detalle</label>
            <div class="col-md-8">
                <input name="detalle" required="required" placeholder="Detalle"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-4">Central (Alarma)</label>
            <div class="col-md-8">
                <select name="id_central" id="" class="form-control">
                    <?php foreach($aCentral as $oCentral){ ?>
                    <option value="<?=$oCentral['id'];?>"><?=$oCentral['nombre'];?></option>
                    <?php
                    }
                    ?>
                </select>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="name">Descripción
            </label>
            <div class="col-md-8">
        <textarea name="descripcion" class="form-control"
                  id="" cols="30" rows="3"></textarea>
            </div>
        </div>
    </div>
</div>