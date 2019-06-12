<?php
/**
 * Created by PhpStorm.
 * User: javier.canqui
 * Date: 08/09/2017
 * Time: 07:29 PM
 *
 */?>
<script type="text/javascript">
    var oAudio={
        aData:{
            audio:null,
            alarmaDefecto:"{{URL::asset('audio/alarma.mp3')}}"
        },
        init:function (audio) {
            oAudio.aData.audio = new Audio(audio);
            oAudio.aData.audio.addEventListener('ended', function() {
                this.currentTime = 0;
                this.play();
            }, false);
        },
        play:function (tipo) {
            oAudio.init(tipo);
            oAudio.aData.audio.play();
        },
        stop:function () {
            oAudio.aData.audio.pause();
            oAudio.aData.audio.currentTime = 0;
        }
    };
    var oMap={
        aData:{
            mapa:null,
            aSitios:{},
            image:{
                url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                size: new google.maps.Size(20, 32),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32)
            },
            mapOptions: {
                zoom: 12,
                //center: oMap.getLatLng(-16.4897,-68.1193)
                center: new google.maps.LatLng(-16.4897,-68.1193)
            }
        },
        getLatLng:function (lat, lng) {
            return new google.maps.LatLng(lat,lng);
        },
        getMarker:function (lat,lng,texto,img) {
            return new google.maps.Marker({
                position: oMap.getLatLng(lat,lng),
                title:texto,
                icon:img
            });
        },
        setMarker:function (marker) {
            marker.setMap(oMap.aData.mapa);
        },
        init:function (div) {
            oMap.aData.mapa = new google.maps.Map(
                document.getElementById(div), oMap.aData.mapOptions);
        }
    };
    var oPage={
        aData:{
            estadoAlerta:"ENCENDIDO",
            frecuenciaMS:5000,
            alarmaActivada:false
        },
        init:function () {
            oPage.aData.formAdd = $("#formAdd");
            oPage.aData.formEdit = $("#formEdit");
            oPage.aData.aSitios=[];
            oPageGeneric.init();
            oPage.initData();
            //oPage.initializeMap();
            oMap.init("mapa_canvas");
            //var audio = new Audio('audio_file.mp3');
        },
        initData:function(){
            var $divContent = $(".div-content");

            $.getJSON("{{ url('sensor/listSensor') }}",{},function (response) {
                $.each( response.data, function(key, oValue) {
                    var $divClone = $("#divClone").children().clone();

                    $divClone.find(".div-estado").html(oValue.estado);
                    $divClone.find(".h-detalle").html(oValue.codigo+" - "+oValue.detalle);
                    $divClone.find(".p-tipo").html(oValue.tipo);
                    $divClone.find(".alert").removeClass('alert-danger');
                    $divClone.find(".alert").removeClass('alert-success');
                    $divClone.attr('id',oValue.codigo);
                    $divContent.append($divClone);

                    oMap.aData.aSitios[oValue.id_central] = oMap.getMarker(
                        oValue.latitud*1,
                        oValue.longitud*1,
                        oValue.nombre+" - "+ oValue.ubicacion,
                        oMap.aData.image
                    );
                    oMap.setMarker(oMap.aData.aSitios[oValue.id_central]);

                    oPage.refreshData(oValue.codigo);
                    //TODO: aqui historial
                    //oPage.refreshDataAsignacion(oValue.codigo);
                });

                //oPage.initializeMap();
                console.log(oMap.aData.aSitios);
            });
        },
        refreshData:function(key){
            setInterval(function(){
                $.getJSON("{{ url('sensor/mostrar') }}/"+key,{},function (response) {
                    if(!(response.response===undefined && response.response.data.valor===undefined)){
                        var oValue= response.response.data;
                        //oPage.aData.aDataSensorGrafico[response.response.data.codigo] = response.response.data.valor *1;
                        var $obj =$("#"+oValue.codigo);
                        $obj.find(".div-estado").html(oValue.estado);
                        $obj.find(".h-detalle").html(oValue.codigo+" - "+oValue.detalle);
                        $obj.find(".p-tipo").html(oValue.tipo);
                        $obj.find(".alert").removeClass('alert-danger');
                        $obj.find(".alert").removeClass('alert-success');

                        if(oValue.estado!=oPage.aData.estadoAlerta){
                            $obj.find(".alert").addClass('alert-success');
                        }else{
                            $obj.find(".alert").addClass('alert-danger');
                        }
                        oPage.controlAlerta(oValue);
                    }
                });
            }, oPage.aData.frecuenciaMS);
        },
        controlAlerta:function (data) {
            if(data.estado==oPage.aData.estadoAlerta){
                if(!$('#mAlerta').hasClass('in') && !oPage.aData.alarmaActivada){
                    oAudio.play(oAudio.aData.alarmaDefecto);
                    $('#mAlerta').modal({backdrop: 'static', keyboard: false});
                    $(".p-alerta-detalle").html(data.codigo+" "+data.detalle);
                    $(".p-alerta-tipo").html(data.tipo);
                    oPage.aData.alarmaActivada=true;
                }
            }else{
                //oAudio.stop();
            }
        },
        apagarAlerta:function () {
            oAudio.stop();
            //oPage.aData.alarmaActivada=false;
        },
        refreshDataAsignacion:function(key){
            setInterval(function(){
                $.getJSON("{{ url('sensor/mostrar/') }}"+"?codigo="+key+"&limit=5",{},function (response) {
                    if(!(response.response===undefined && response.response.data.valor===undefined)){
                        var $divContent = $(".ul-asignacion-"+key);
                        $divContent.html("");

                        $.each( response.response.data, function(key, oValue) {
                            var $obj = $("#divCloneLi").children().clone();
                            var sVehiculo = oValue.id_vehiculo!=null? oValue.importador:"Sin asignar";
                            $obj.find(".title").html(sVehiculo);

                            var sSensor =oValue.codigo+" - "+oValue.detalle;
                            $obj.find(".p-detalle").html(sSensor);
                            var sDescripcion = oValue.id_salida!=null? oValue.hora_abierto+" - "+oValue.hora_cerrado:oValue.hora_abierto;
                            $obj.find(".s-descripcion").html(sDescripcion);
                            $obj.find(".title").attr("onclick","oPage.showModal('"+sSensor+"',"+oValue.id +")");


                            var objIcono = $obj.find(".fa-car");
                            objIcono.removeClass('red');
                            objIcono.removeClass('green');
                            if(oValue.estado=='ABIERTO'){
                                objIcono.addClass('green');
                            }else{
                                objIcono.addClass('red');
                            }
                            $divContent.append($obj);
                        });
                    }
                });
            }, oPage.aData.frecuenciaMS);
        },
        showModal:function (sensor, pkAsignacion) {
            var $form = $("#formAsignacion");
            $form.find("input[name='pk']").val(pkAsignacion);
            $form.find(".div-nombre-sensor").html(sensor);
            $('#mAsignacion').modal('show');
        }

    };
    $(document).ready(function(){
        <?php if(session('rol')!='CLI'){?>
        oPage.init();
        <?php }?>
    });
</script>
