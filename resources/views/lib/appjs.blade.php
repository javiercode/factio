<script type="text/javascript">
    var oPageGeneric={
        init:function () {
            oPageGeneric.initSelect2();
            oPageGeneric.initDatePicker();
            $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        },
        controlKeyEnter:function(){
            $('input').keypress(function(e) {
                if (e.which == 13) {
                    $(this).next('input').focus();
                    e.preventDefault();
                }
            });
        },
        initDatePicker:function () {
            $('.datepicker').datepicker({
                singleDatePicker: true,
                dateFormat: 'dd/mm/yy',
                singleClasses: "picker_1"
            }, function(start, end, label) {
                //console.log(start.toISOString(), end.toISOString(), label);
            });
        },
        initSelect2:function () {
            $( ".lib-select2" ).select2({
                theme: "bootstrap",
                width:'100%'
            });
//            $(".lib-select2").select2();
        },
        filterColumn:function (obj) {
            var rex = new RegExp($(obj).val(), 'i');
            var columnFilter = $(obj).attr('key');
            var $tr = $('.tbody-busqueda').find('tr');
            $tr.hide();
            $tr.find('td').filter(function () {
                return rex.test($(this).text());
            }).closest('tr').show();
        },
        filterColumnPersonalize:function (obj) {
            var rex = new RegExp($(obj).val(), 'i');
            var columnFilter = $(obj).attr('key');
            $('.td-'+columnFilter).parent().hide();
            $('.td-'+columnFilter).filter(function () {
                return rex.test($(this).text());
            }).parent().show();
        },
        delete:function (url,data) {
            data._token = "{{csrf_token()}}";
            $.ajax({
                url: url,
                type: 'DELETE',
                async: true,
                data: data,
                dataType: 'json',
                success: function (response) {
                    location.reload();
                    new PNotify({
                        title: 'Notificación',
                        text: 'Registro eliminado',
                        opacity: 0.90,
                        styling: 'bootstrap3',
                        delay: 4000,
                        shadow: true,
                        type: 'danger'
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        },
        bootstrapValidator:function (obj) {
            $(obj).bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                live: 'enabled',
                trigger: null,
                excluded: [':disabled', ':hidden', function ($field, validator) {
                    return !$field.is(':visible');
                }]
            }).on('error.field.bv', function (e, data) {
                $("#aux").val($('#FormPacienteAnte').data('bootstrapValidator').isValid());
            })
        },
        pNotifyConfirm:function () {
            (new PNotify({
                title: 'Confirmar Acción',
                text: '¿Desea eliminar el registro?',
                icon: 'glyphicon glyphicon-question-sign',
                hide: false,
                confirm: {
                    confirm: true
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                }
            })).get().on('pnotify.confirm', function() {
                alert('Ok, cool.');
            }).on('pnotify.cancel', function() {
                alert('Oh ok. Chicken, I see.');
            });
        },
        setForm:function (oForm, data) {
            $.each(data,function (index, oValue) {
                var $obj= oForm.find("input[name='" +index+"']");
                $obj=$obj.length>0? $obj: oForm.find("select[name='" +index+"']");
                $obj=$obj.length>0? $obj: oForm.find("textarea[name='" +index+"']");
                if($obj.length>0){
                    switch ($obj[0].tagName){
                        case 'INPUT':
                            switch ($obj[0].type){
                                case 'radio':
                                    var $radios = oForm.find("input[name=" +index+"][value='" +oValue+"']");
                                    $radios.filter('[value=' +oValue+']').prop('checked', true);
                                    break;
                                case 'checkbox':
                                    var $checks = oForm.find("input[name=" +index+"][value='" +oValue+"']");
                                    $checks.filter('[value=' +oValue+']').prop('checked', true);
                                    break;
                                case 'text':
                                    $obj.val(oValue);
                                    break;
                            }
                            break;
                        case 'SELECT':
                            $obj.find('option').removeAttr('selected');
                            $obj.find('option[value="' +oValue+'"]').attr('selected', 'selected');
                            if($obj.hasClass('lib-select2')){
                                $obj.val(oValue).trigger('change');
                            }
                            break;
                        case 'TEXTAREA':
                            $obj.val(oValue);
                            break;
                    }
                }
            });
        },
        validar:function (url, oForm, data) {
            $.post(url,data,function (response) {
                if(response.status){
                    oForm.submit();
                }else{
                    $.each(response.errors,function (iError, oError) {
                        var sObject=oForm.find("input[name='" +iError+"']");
                        var liError = sObject.closest('div').find('.help-block');
                        if(sObject.length>0 && liError.length>0){
                            var sHelp = '<ul class="list-unstyled">';
                            $.each(oError,function (iDetail, oDetail) {
                                sHelp +='<li class="width-error">' +oDetail+'</li>';
                            });
                            sHelp +='</ul>';
                            liError.html(sHelp);
                        }
                    });
                }
            });
        }
    };
var oMessage={
    notifyWarning:function (titulo, texto) {
        new PNotify({
            title: titulo,
            text: texto,
            opacity: 0.90,
            styling: 'bootstrap3',
            delay: 4000,
            shadow: true,
            type: 'warning'
        });
    }

};
var oNumber = {
    format:function(valor){
        if(!isNaN(valor)){
            return valor.toFixed(2);
        }
        return 0;
    },
    isNumber:function(valor){
        return (!isNaN(valor));
    }
}
</script>