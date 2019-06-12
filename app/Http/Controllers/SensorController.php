<?php

namespace App\Http\Controllers;

use App\Asignacion;
use App\Central;
use App\Sensor;
use App\SensorDato;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Auth;
use DB;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->initData();
        return view('param.sensor.list',$data);
    }

    public function initData(){
        $oUser = Auth::user();
        $oSensor = new Sensor();
        $oCentral = new Central();
        $aSensor = $this->getList(false);
        $aCentral = $oCentral::where("status",'<>', $this::DELETE)
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
        $aData = array(
            'aSensor' => $aSensor,
            'aCentral' => $aCentral,
            'user' => $oUser->id,
            'eTipo' => $oSensor->getEnum(),
        );
        return $aData;
    }
    public function getList($isJson =true){
        $oSensor = new Sensor();
        $oCentral = new Central();
        $aSensor = $oSensor::join('central', function ($join){
                $join->on('central.id', '=', 'sensor.id_central');
            })->where("central.status",'<>', $this::DELETE)
            ->orderBy('sensor.codigo', 'desc')
            ->get()->toArray();
        if($isJson){
            return response()->json([
                'data' => $aSensor,
                'success' => true]);
        }
        return $aSensor;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $oUser = Auth::user();
        $aData = $request->toArray();
        if(isset($aData['pk'])){
            $oSensor = Sensor::find($aData['pk']);
            $aData['updated_by'] = $oUser->id;
        }else{
            $oSensor = new Sensor();
            $aData['created_by'] = $oUser->id;
        }
        $oSensor->fill($aData);
        $saveItem = $oSensor->save();

        return redirect()->route('sensor.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sensor $sensor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sensor $sensor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sensor $sensor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $aData = $request->toArray();
        $oItem = Sensor::find($aData['id']);
        $this->desactivar($oItem);
        return response()->json([
            'success' => $this->errorBag()]);
    }

    public function validar(Request $request)
    {
        $result = array(
            'success'=>true,
            'status'=>''
        );

        $aData = $request->all();
        if ($request->isMethod('get')){
            //$oUser = Auth::user();
            $aData = $request->all();

            if(isset($aData['codigo'])){
                $sensor = new Sensor();
                $oSensor = $sensor::where('codigo','=',$aData['codigo'])
                    ->get()->toArray();
                $oSensorDato = new SensorDato();
                $aSensorDatoUltimo = null;
                if(is_array($oSensor) && sizeof($oSensor)>=0){
                    $aSensorDatoUltimo = $oSensorDato::where('id_sensor','=',$oSensor[0]['id'])
//                        ->latest();
                        ->orderBy('id', 'desc')->limit(1)->get()->toArray();
                }
                if(isset($oSensor[0]) && isset($oSensor[0]['id']) && is_numeric($oSensor[0]['id'])){
                    $aData['id_sensor'] =$oSensor[0]['id'];
                    $oSensorDato = new SensorDato();
                    $aData['created_by'] = 1;
                    $oSensorDato->fill($aData);
//                    print_r($aSensorDatoUltimo);exit;
                    if(is_array($aSensorDatoUltimo) && sizeof($aSensorDatoUltimo)>0 ){
                        $aSensorDatoUltimo = $aSensorDatoUltimo[0];
                        if($aSensorDatoUltimo['estado'] != $aData['estado'] ){
                            try {
                                $oSensorDato->save();
                                $result['status']='Registrado';
                                $result['success']=true;
                                //$this->newAsigancion($oSensorDato);
                            } catch (\Exception $e) {
                                $request['status']= $e->getMessage();
                            }
                        }
                    }else{
                        try {
                            $oSensorDato->save();
                            $result['status']='Registrado';
                            $result['success']=true;
                            //$this->newAsigancion($oSensorDato);
                        } catch (\Exception $e) {
                            $request['status']= $e->getMessage();
                        }
                    }


                }
            }

        }
        return response()->json(['response' => $result]);
    }

    /**
     * Creacion o Edicion de nueva asignacion.
     *
     * @param  \App\SensorDato  $oSensorDato
     * @return \App\Asignacion  $oAsignacion
     */
    public function newAsigancion($oSensorDato){
        $oAsignacion = new Asignacion();
        $aData = array();
        $aData['id_sensor'] = $oSensorDato['id_sensor'];
        //try {
        if($oSensorDato->estado ==SensorDato::CERRADO){
            $oAsignacion = new Asignacion();
            $aData['id_entrada'] = $oSensorDato['id'];
            $aData['estado'] = Asignacion::CERRADO;

        }else{
            $aData['id_salida'] = $oSensorDato['id'];
            $aData['estado'] = Asignacion::ABIERTO;
            $aAsignacion = $oAsignacion::where('id_sensor','=',$oSensorDato['id_sensor'])
                ->where('id_sensor','=',$oSensorDato['id_sensor'])
                ->orderBy('id','desc')
                ->get()->toArray();
            if(is_array($aAsignacion) && sizeof($aAsignacion)>0){
                $oAsignacion = Asignacion::find($aAsignacion[0]['id']);
            }
        }
        $aData['created_by'] = 1;
        $oAsignacion->fill($aData);
        $oAsignacion->save();
        //} catch (\Exception $e) {
        //    return $e->getMessage();
        //}
        return $oAsignacion;
    }

    public function mostrar(Request $request)
    {
        $result = array(
            'success'=>false,
            'status'=>'',
            'data'=>array()
        );
        $aData = $request->all();
        if ($request->isMethod('get')){
            //try{
                if(!is_null($request->route('codigo'))) {
                    $codigo = $request->route('codigo');
                    $limit = is_null($request->route('limit'))?1:$request->route('limit');
                    $oSensorDato =new SensorDato();
                    $oCentral =new Central();
                    $aSensorDato=$oSensorDato::join('sensor', function ($join){
                        $join->on('sensor_dato.id_sensor', '=', 'sensor.id');
                    })->join('par_dominio', function ($join){
                        $join->on('par_dominio.codigo', '=', 'sensor_dato.tipo');
                    })->join('central', function ($join){
                        $join->on('central.id', '=', 'sensor.id_central');
                    })->where('sensor.codigo', '=', $codigo)
                        ->where('sensor.status', '<>', $this::DELETE)
                        ->where('par_dominio.dominio', '=', SensorDato::TIPO_ALERTA)
                        ->limit($limit)->orderBy('sensor_dato.id', 'desc')
                        ->select('sensor_dato.id','sensor.codigo',
                            'sensor.detalle','par_dominio.detalle as tipo',
                            'sensor_dato.estado','central.id as id_central',
                            'central.ubicacion','central.latitud','central.longitud',
                            'sensor_dato.created_at as ultima_fecha')
                        ->get()->toArray();
                    $result['success']=true;
                    if(sizeof($aSensorDato)>0 && is_null($request->route('limit'))){
                        $result['data'] = $aSensorDato[0];
                    }elseif (sizeof($aSensorDato)>0 && !is_null($request->route('limit'))){
                        $result['data'] = $aSensorDato;
                    }
                }
            //}catch (Exception $exceptione){
            //    $result['status']=$exceptione->getCode();
            //}
        }
        return response()->json(['response' => $result]);
    }
}
