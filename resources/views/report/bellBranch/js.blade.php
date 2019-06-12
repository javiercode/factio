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
            oPage.aData.formAdd = $("#formAdd");
            oPage.aData.formEdit = $("#formEdit");
            oPageGeneric.init();
            oPage.getItem();
            //oPageGeneric.initSelect2();
        },
        swDetalle:function (obj) {
            var contenido=$(obj).closest('tr').find('.panel-collapse');
            var i=$(obj).find('i');
            if(contenido.hasClass('collapse')){
                contenido.removeClass('collapse');
                i.addClass('fa-minus-square').removeClass('fa-plus-square');
            }else{
                contenido.addClass('collapse');
                i.removeClass('fa-minus-square').addClass('fa-plus-square');

            }
        },
        getItem:function () {
            var inputItem = oPage.aData.formAdd.find("select[name='id_item']");
            var $aData =[];
            $.getJSON("{{url('param/getItem')}}",{},function (response) {
                $.each(response.aItem, function( index, oValue){
                    var text = oValue.part_nro +" - "+ oValue.name;
                    var oData = {
                        "id":oValue.id,
                        "text": text
                    };
                    $aData.push(oData);
                });
                $('.id_item-').select2({
                    placeholder: "Seleccione Item",
                    data: $aData,
                    width:'100%'
                }).on('select2-selecting', function(e) {
                    console.log(e);
                });
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
