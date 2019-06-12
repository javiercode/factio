<?php
/**
 * Created by PhpStorm.
 * User: javier.canqui
 * Date: 08/09/2017
 * Time: 07:29 PM
 *
 */?>
<script type="text/javascript">
    var oPage={
        aData:{
            formAdd:null,
            formEdit:null,
        },
        init:function () {
            oPage.aData.formAdd = $("#formAdd");
            oPage.aData.formEdit = $("#formEdit");
            oPageGeneric.init();
        },
        updateRol:function (obj) {
            var $aData={
                'idUser':$(obj).closest("td").find("input[name='id_user']").val(),
                'idRol':$(obj).closest("td").find("input[name='id_rol']").val(),
                'checked':$(obj).is(':checked')?1:0
            };
            $.getJSON("{{url('admin/updateRol')}}",$aData,function (response) {
                console.log(response);
            });
        },
        mostrarBusquedaItem:function () {
            var div = $('#divBuscarItem');
            if (div.is(':hidden')){
                div.show();
            }
            else{
                div.hide();
            }
        },
        delete:function (obj) {
            var $pk = $(obj).closest('tr').find("input[name='pk']");
            var $aData = {
                'id':$pk.val()
            };
            oPageGeneric.delete("{{url('param/bell/update')}}", $aData)
        },
        edit:function (obj) {
            var $pk = $(obj).closest('tr').find("input[name='pkUser']");
            oPage.aData.formEdit.find("input[name='pk']").val($pk.val());
            var $aData = {
                'id':$pk.val()
            };
            console.log($aData);
            $.getJSON("{{url('admin/getEditUser')}}",$aData,function (response) {
                console.log(response);
                oPageGeneric.setForm(oPage.aData.formEdit, response.oUser);
            });
        },
        save:function (obj) {
            var oForm = $(obj).closest('form');
            var $password = oForm.find("input[name='password']");
            var $passwordConfirm = oForm.find("input[name='password_confirm']");
            var isVerifyPassword = $password.val()== $passwordConfirm.val();

            if(isVerifyPassword){
                console.log(oForm);
                oForm.submit();
            }else{
                console.log('false');
            }
        },
        saveRol:function (obj) {
            var $aDatsa =$("form[name='formFilter']").serialize();
            var $aData = $(obj).closest('.div-rol').serialize();
            //console.log($("input[name='idUser']").val());
            console.log($("input[type='checkbox']").serializeArray());
            console.log($("input[name='rolUser[]']").serializeArray());
            console.log($("input[name='idRolUser[]']").serializeArray());
            //console.log($('div.form-group.div-rol'));

        }
    };
    $(document).ready(function(){
        oPage.init();
    });
</script>
