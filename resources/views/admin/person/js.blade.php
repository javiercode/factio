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
        delete:function (obj) {
            var $pk = $(obj).closest('tr').find("input[name='pk']");
            var $aData = {
                'id':$pk.val()
            };
            oPageGeneric.delete("{{url('admin/person/destroy')}}", $aData)
        },
        save:function (obj) {
            $(obj).closest('form').submit();
        },
    };
    $(document).ready(function(){
        oPage.init();
    });
</script>
