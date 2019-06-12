<?php

namespace App\Http\Controllers;

use App\Central;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->initData();
        return view('param.central.list',$data);
    }

    public function initData(){
        $oUser = Auth::user();
        $oCentral = new Central();
        $aCentral = $this->getList(false);
        $aData = array(
            'aCentral' => $aCentral,
            'user' => $oUser->id
        );
        return $aData;
    }
    public function getList($isJson =true){
        $oCentral = new Central();
        $aCentral = $oCentral::where("status",'<>', $this::DELETE)
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
        if($isJson){
            return response()->json([
                'data' => $aCentral,
                'success' => true]);
        }
        return $aCentral;
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
            $oCentral = Central::find($aData['pk']);
            $aData['updated_by'] = $oUser->id;
        }else{
            $oCentral = new Central();
            $aData['created_by'] = $oUser->id;
        }
        $oCentral->fill($aData);
        $saveItem = $oCentral->save();

        return redirect()->route('central.index');
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
        $oItem = Central::find($aData['id']);
        $this->desactivar($oItem);
        return response()->json([
            'success' => $this->errorBag()]);
    }
}
