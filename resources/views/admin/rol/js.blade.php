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
            eScope:{},
            aDataPartCategory:[],
            aDataProductGroup:[],
            aDataItem:[],
            aBellDetail:[],
        },
        init:function () {
            oPage.getDetail();
            oPage.aData.formAdd = $("#formAdd");
            oPage.aData.formEdit = $("#formEdit");
            oPageGeneric.init();
            oPage.getScope(oPage.aData.formAdd);


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
        getScope:function (oForm) {
            var $aData =[];
            $.getJSON("{{url('param/getScope')}}",{},function (response) {
                $.each(response.aPartCategory, function( index, oValue){
                    var text = "("+oValue.value+") "+oValue.code +" - "+ oValue.label;
                    var oData = {
                        "id":oValue.id,
                        "text": text
                    };
                    $aData.push(oData);
                });
                oPage.aData.aDataPartCategory =$aData;
                $aData =[];
                $.each(response.aProductGroup, function( index, oValue){
                    var text = oValue.value +" - "+ oValue.label;
                    var oData = {
                        "id":oValue.id,
                        "text": text
                    };
                    $aData.push(oData);
                });
                oPage.aData.aDataProductGroup=$aData;
                $aData =[];
                $.each(response.aItem, function( index, oValue){
                    var text = oValue.part_nro +" - "+ oValue.name;
                    var oData = {
                        "id":oValue.id,
                        "text": text
                    };
                    $aData.push(oData);
                });
                oPage.aData.aDataItem =$aData;
                oPage.getValueScope(oForm.find("select[name='scope']"));
            });
        },
        getValueScope:function (obj) {
            var $oSelectScope = $(obj).closest('form').find("select[name='selectItem']");
            var $aData = [];
            var sPlaceHolder = "Seleccione ";
            $oSelectScope.empty().trigger('change');
            switch ($(obj).val()){
                case'PART_CATEGORY':
                    $aData = oPage.aData.aDataPartCategory ;
                    sPlaceHolder += " Part Category";
                    break;
                case'PRODUCT_GROUP':
                    $aData = oPage.aData.aDataProductGroup ;
                    sPlaceHolder += " Product Group";
                    break;
                case'PART_NRO':
                    $aData = oPage.aData.aDataItem ;
                    sPlaceHolder += " Part Number";
                    break;
            }
            $oSelectScope.select2({
                placeholder: "Seleccione Part Category",
                data: $aData
            }).on('select2-selecting', function(e) {
                console.log(e);
            });
        },
        addItem:function (obj) {
            var $tBodyDetaslle = $(obj).closest('form').find(".table-responsive tbody");

            var $objScope = $(obj).closest('form').find("select[name='scope']");
            var $objItem = $(obj).closest('form').find("select[name='selectItem']");
            var $idScope = $objScope.find('option:selected').val();
            var $sScope = $objScope.find('option:selected').text();
            var $idItem =$objItem.find('option:selected').val();
            var $sItem =$objItem.find('option:selected').text();

            var $aIdTabla = $tBodyDetaslle.find("input[name='verify[]']").serializeArray();
            $aIdTabla = $aIdTabla.filter(function (oValue) {
                if(oValue.value == ($idItem+"|"+$idScope)){
                    return oValue.value;
                }
            });
            if($aIdTabla.length==0){
                var $tr = "<tr>" +
                    "<td>" +
                    "<input type='hidden' name='verify[]' value='" +$idItem+"|"+$idScope+"'>" +
                    "<input type='hidden' name='pkDetail[]' value='0'>" +
                    "<input type='hidden' name='idTabla[]' value='" +$idItem+"'>" +
                    "<input type='hidden' name='idScope[]' value='" +$idScope+"'>" +
                    "<input type='hidden' name='nombre[]' value='" +$sItem+"'>" +
                    "</td>" +
                    "<td>" +$sScope+"</td>" +
                    "<td>" +$sItem+"</td>" +
                    "<td>" +"<button type='button' class='btn btn-danger' onclick='oPage.deleteItem(this)'><i class='fa fa-trash'></button></td>" +
                    "</tr>";
                var $averify = oPage.aData.aBellDetail ? oPage.aData.aBellDetail[$idScope+'|'+$idItem]:null;
                if($averify){
                    oMessage.notifyWarning('Repuesto ya registrado!','<strong>Campaña(s): </strong> '+$averify.join(', '));
                }
                $(obj).closest('form').find(".table-responsive tbody").append($tr);
            }
        },
        deleteItem:function (obj) {
            $(obj).closest('tr').remove();
        },
        delete:function (obj) {
            var $pk = $(obj).closest('tr').find("input[name='pk']");
            var $aData = {
                'id':$pk.val()
            };
            oPageGeneric.delete("{{url('param/bell/update')}}", $aData)
        },
        edit:function (obj) {
            oPage.getDetail();
            var $pk = $(obj).closest('tr').find("input[name='pk']");
            oPage.aData.formEdit.find("input[name='pk']").val($pk.val());
            var $aData = {
                'id':$pk.val()
            };
            var $tipo = $(obj).closest('tr').find("input[name='status']").val();
            oPage.aData.formEdit.find('.btn-borrador').fadeIn();
            oPage.aData.formEdit.find('.btn-activo').fadeIn();
            switch ($tipo){
                case 'BORRADOR':
                    oPage.aData.formEdit.find('.btn-borrador').fadeOut();
                    break;
                case 'ACTIVO':
                    oPage.aData.formEdit.find('.btn-borrador').fadeOut();
                    oPage.aData.formEdit.find('.btn-activo').fadeOut();
                    break;
                case 'INACTIVO':
                    oPage.aData.formEdit.find('.btn-borrador').fadeOut();
                    oPage.aData.formEdit.find('.btn-activo').fadeOut();
                    break;
            }
            $.getJSON("{{url('param/bellGetEdit')}}",$aData,function (response) {
                oPageGeneric.setForm(oPage.aData.formEdit, response.oBell);
                oPage.getValueScope(oPage.aData.formEdit.find("select[name='scope']"));

                var aInputBranch = oPage.aData.formEdit.find("input[name='id_branch[]']");
                $.each(aInputBranch, function (index, oValue) {
                    if(response.aBellBranch && response.aBellBranch['*'+$(oValue).val()]){
                        $(oValue).attr('checked',true);
                    }else{
                        $(oValue).removeAttr('checked');
                    }
                });
                oPage.aData.formEdit.find(".table-responsive tbody").html("");
                $.each(response.aDetilBell,function (index,oValue) {
                    var $tr = "<tr>" +
                        "<td>" +
                        "<input type='hidden' name='verify[]' value='" +oValue.id_tabla+"|"+oValue.type+"'>" +
                        "<input type='hidden' name='pkDetail[]' value='" +oValue.id+"'>" +
                        "<input type='hidden' name='nombre[]' value='" +oValue.name+"'>" +
                        "<input type='hidden' name='idTabla[]' value='" +oValue.id_tabla+"'>" +
                        "<input type='hidden' name='idScope[]' value='" +oValue.type+"'>" +
                        "</td>" +
                        "<td>" +oValue.type+"</td>" +
                        "<td>" +oValue.name+"</td>" +
                        "<td>" +"<button type='button' class='btn btn-danger' onclick='oPage.deleteItem(this)'><i class='fa fa-trash'></button></td>" +
                        "</tr>";
                    oPage.aData.formEdit.find(".table-responsive tbody").append($tr);
                });
            });
        },
        save:function (obj) {
            $(obj).closest('form').find("input[name='status']").val($(obj).attr('code'));
            $(obj).closest('form').submit();
        },
        getDetail:function () {
            var $aData={};
            $.getJSON("{{url('param/getBellDetail')}}",$aData,function (response) {
                oPage.aData.aBellDetail =response.aDetilBell;
            });
        }
    };
    $(document).ready(function(){
        oPage.init();
    });
</script>
