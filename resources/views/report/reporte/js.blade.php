<?php
/**
 * Created by PhpStorm.
 * User: javier.canqui
 * Date: 08/09/2017
 * Time: 07:29 PM
 */?>
<script type="text/javascript">
    var oPage={
        aData:{
            formAdd:null,
            formEdit:null
        },
        init:function () {
            oPageGeneric.init();
        },
        getPdf:function () {
            kendo.drawing.drawDOM("div.table-responsive",
                {
                    paperSize: "A4",
                    margin: { top: "1cm", bottom: "1cm" },
                    scale: 0.8,
                    height: 500
                })
                .then(function(group){
                    kendo.drawing.pdf.saveAs(group, "Exported.pdf")
                });
        },
        getList:function () {
            var $aData =$("form[name='formFilter']").serialize();
            console.log($aData);
            $.getJSON("{{url('report/list')}}",$aData,function (response) {
                var iCorrelativo = 0;
                var $tbody = $("tbody.tbody-busqueda");
                var $tr="";
                $.each(response.aSensorDato, function( index, oValue){
                    iCorrelativo++;
                    $tr +="<tr>";
                    $tr +="<td></td>";
                    $tr +="<td>" +iCorrelativo+"<input type='hidden' name='pk' value='" +oValue.id+"'/>" +"</td>";
                    $tr +="<td>" +oValue.central+"</td>";
                    $tr +="<td>" +oValue.codigo+" - "+oValue.detalle+"</td>";
                    $tr +="<td>" +oValue.tipo+"</td>";
                    $tr +="<td>" +oValue.estado+"</td>";
                    $tr +="<td>" +oValue.fecha+"</td>";
                    $tr +="<td>" +oValue.descripcion+"</td>";
                    $tr +="<td>" +oValue.ubicacion
                        +"<br><small><strong> Coordenadas: </strong>" +oValue.latitud+" - "+oValue.longitud+"</small></td>";

                    $tr +="</tr>";
                });
                $tbody.html($tr);
            });
        },
        update:function (obj) {
            {{--var $aData = oPage.aData.formEdit.serialize();--}}
            {{--oPageGeneric.validar(--}}
                {{--"{{url('param/getValidate')}}",--}}
                {{--oPage.aData.formEdit,--}}
                {{--$aData--}}
            {{--);--}}
            $(obj).closest('form').submit();
        },
        edit:function (obj) {
            var $pk = $(obj).closest('tr').find("input[name='pk']");
            oPage.aData.formEdit.find("input[name='pk']").val($pk.val());
            var $aData = {
                'id':$pk.val()
            };
            $.getJSON("{{url('param/itemBranchGetEdit')}}",$aData,function (response) {
                console.log(response);
                oPageGeneric.setForm(oPage.aData.formEdit, response.oItemBranch);
                oPage.aData.formEdit.find("input[name='part_nro']").attr('readonly',true);
            });
        }
    };
    $(document).ready(function() {
        oPage.init();
    });
</script>
