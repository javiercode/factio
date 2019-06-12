<?php
/**
 * Created by PhpStorm
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
            oPageGeneric.delete("{{url('param/sensor/update')}}", $aData)
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
