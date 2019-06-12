<div class="form-group">
    <label class="control-label col-md-2" for="name">Persona
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <select name="id_person" class="form-control lib-select2" required="required">
            <?php
            foreach ($aPerson as $oValue){
            $nombreFormal =($oValue['first_name']?:'')." ".($oValue['second_name']?:'')." ".($oValue['first_lastname']?:'')." ".($oValue['second_lastname']?:'');
            ?>
            <option value="<?=$oValue['id'];?>"><?=$nombreFormal;?></option>
            <?php }?>
        </select>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Usuario</label>
    <div class="col-md-4">
        <input name="username" required="required" placeholder="Usuario"
               class="form-control" type="text" data-parsley-length="[3, 20]">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2" for="name">Correo
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="email" required="required" placeholder="Usuario"
               class="form-control" type="email" data-parsley-length="[3, 20]"
               data-error="No es un formato valido para correo">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Password
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input type="password" name="password" class="form-control"
               required="required">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2">Confirmar Password
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input type="password" name="password_confirm" class="form-control"
               required="required">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
</div>