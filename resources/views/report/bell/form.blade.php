<div class="form-group">
    <label class="control-label col-md-2">Item
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <select name="id_item" class="id_item form-control lib-select2" required="required">
            <?php foreach($aItem as $oItem){?>
                <option value="<?=$oItem['id'];?>"><?=$oItem['name']." ".$oItem['part_nro'];?></option>
            <?php }?>
        </select>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-2" for="name">Stock minimo
        <span class="required">*</span>
    </label>
    <div class="col-md-4">
        <input name="stock_minium" required="required" placeholder="Stock minimo"  pattern="^([0-9])*$"
               class="form-control" type="text" data-parsley-length="[3, 10]"
               value="">
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors">El formato solo acepta numero!</div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Observación
    </label>
    <div class="col-md-4">
        <textarea name="observation" id="" cols="30" rows="2" class="form-control" data-parsley-length="[5, 500]"></textarea>
    </div>
</div>