<form name="formFilter" onsubmit="return false;">
    <div class="form-group div-rol">
        <table class="table panel-collapse" style="width: 100%">
            <thead class="thead-roles">
            <tr>
                <th>User</th>
                <th>SUP</th>
                <th>ADM</th>
                <th>RESP</th>
            </tr>
            </thead>
            <tbody class="tbody-roles">
            <?php
            $i = 1;
            foreach ($aRol as $oRol){
            ?>
            <tr>
                <td scope="row"><?=$i++;?>
                    <input type="hidden" name="idRol" value="<?=$oRol['id'];?>">
                </td>
                <td><?=$oRol['code'];?></td>
                <td><?=$oRol['name'];?></td>
                <td class="td-rol-user">
                    <input type="checkbox" name="<?=$oRol['id'];?>" value=""/>
                    <input type="checkbox" name="idRolUser[]" value=""/>
                </td>
            </tr>
            <?php
            }?>
            </tbody>
        </table>
        <div class="modal-footer">
            <input type="hidden" name="idUser" value="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btn-activo" onclick="oPage.saveRol(this)">Guardar</button>
        </div>
    </div>
</form>