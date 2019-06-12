<?php

namespace App\Http\Controllers;

use App\Asignacion;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $aData = $request->toArray();

        $oVehiculo = Vehiculo::find($aData['id_vehiculo']);

        $oVehiculo = new Vehiculo();
        $aVehiculo = $oVehiculo::join('users', function ($join) {
            $join->on('users.id', '=', 'vehiculo.id_importador');
        })->where("vehiculo.id",'=', $aData['id_vehiculo'])
            ->select('vehiculo.id', 'users.name', 'vehiculo.status', 'chasis',
                'marca', 'modelo', 'color', 'descripcion', 'observacion')
            ->get()->toArray();

        if(is_array($aVehiculo) && sizeof($aVehiculo)>0){
            $aVehiculo = $aVehiculo[0];
            $oUser = Auth::user();
            $aDataFill = array();
            $aDataFill['id_vehiculo']=$aVehiculo['id'];
            $aDataFill['detalle']=$aVehiculo['name'];
            $aDataFill['observacion']=$aVehiculo['chasis']." - ".$aVehiculo['marca'];
            if(isset($aData['pk'])){
                $oAsignacion = Asignacion::find($aData['pk']);
                $aDataFill['updated_by'] = $oUser->id;
                /*print_r($aData);
                print_r($oAsignacion);
                print_r($aDataFill);exit;*/
                $oAsignacion->fill($aDataFill);
                $oAsignacion->save();
            }

        }
        return redirect()->route('home');
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
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignacion $asignacion)
    {
        //
    }

    public function getList($isJson =true){
        $oSensor = new Sensor();
        $aSensor = $oSensor::where("status",'<>', $this::DELETE)
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
        if($isJson){
            return response()->json([
                'data' => $aSensor,
                'success' => true]);
        }
        return $aSensor;
    }
}
