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
            oPage.getValueScope(oPage.aData.formAdd.find("select[name='scope']"));
            oPage.initDateRange();
            oPageGeneric.init();
        },
        initDateRange:function () {
            var today = new Date();
            var dateLat = moment(today).add(1, 'month').format("DD/MM/YYYY");
            today = moment(today).format('DD/MM/YYYY');
            $('input[name="periodo"]').daterangepicker({
                "minDate": today,
                "startDate": today,
                "endDate": dateLat,
                "opens": "left",
                "locale": {
                    "format": 'DD/MM/YYYY'
                }
            }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
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
//            $oSelectScope.select2({
//                placeholder: sPlaceHolder,
//                data: $aData
//            }).on('select2-selecting', function(e) {
//                console.log(e);
//            });

            $oSelectScope.select2({
                placeholder: sPlaceHolder,
                ajax: {
                    url: "{{url('param/getScope')}}",
                    dataType: 'json',
                    minimumInputLength: 2,
                    delay: 250,
                    data: function (term) {
                        return {
                            term: term,
                            type:$(obj).val()
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.aResult
                        };
                    },
                    cache: true
                }
            });
        },
        addItem:function (obj) {
            var $tBodyDetaslle = $(obj).closest('form').find(".table-responsive tbody");

            var $sDetalle = $(obj).closest('form').find("input[name='searchDetalle']").val();
            var $objTipo = $(obj).closest('form').find("select[name='searchTipo']");
            var $idTipo = $objTipo.find('option:selected').val();
            var $sTipo = $objTipo.find('option:selected').text();

            var $tr = "<tr>" +
                "<td>" +
                "<input type='hidden' name='pkDetail[]' value='0'>" +
                "<input type='hidden' name='detalle[]' value='" +$sDetalle+"'>" +
                "<input type='hidden' name='tipo[]' value='" +$idTipo+"'>" +
                "</td>" +
                "<td>" +$sTipo+"</td>" +
                "<td>" +$sDetalle+"</td>" +
                "<td>" +"<button type='button' class='btn btn-danger' onclick='oPage.deleteItem(this)'><i class='fa fa-trash'></button></td>" +
                "</tr>";
            $tBodyDetaslle.append($tr);
        },
        deleteItem:function (obj) {
            $(obj).closest('tr').remove();
        },
        delete:function (obj) {
            var $pk = $(obj).closest('tr').find("input[name='pk']");
            var $aData = {
                'id':$pk.val()
            };
            oPageGeneric.delete("{{url('control/vehiculo/update')}}", $aData)
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
//                    oPage.aData.formEdit.find('.btn-borrador').fadeOut();
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
            $.getJSON("{{url('control/bellGetEdit')}}",$aData,function (response) {
                oPageGeneric.setForm(oPage.aData.formEdit, response.oBell);
                console.log(response.oBell);
                oPage.getValueScope(oPage.aData.formEdit.find("select[name='scope']"));

                var aInputBranch = oPage.aData.formEdit.find("select[name='id_branch[]']");
                var aIdBranch = [];
                $.each($(aInputBranch).find("option"), function (index, oValue) {
                    if(response.aBellBranch && response.aBellBranch['*'+$(oValue).val()]){
                        aIdBranch.push($(oValue).val());
                        $(oValue).attr('checked',true);
                    }
                });
                aInputBranch.val(aIdBranch).trigger("change");
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
