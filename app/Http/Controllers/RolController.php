<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->initData();
        return view('admin.rol.list',$data);
    }

    public function initData(){
        $oRol = new Rol();
        $oBranch = new Branch();
        $oPerson = new Person();
        $aBell = $oRol::orderBy('created_at', 'desc')->where("status",'<>', 'DELETE')->get()->toArray();
        $aData = array(
            'aBranch' => $oBranch::where('status','=','ACTIVO')->get()->toArray(),
            'aBell' => $aBell,
            'eScope' => $oRol->getScope(),
            'jsonScope' => response()->json($oRol->getScope(), 200)
        );
        return $aData;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $aData = $request->toArray();
        $oUser = Auth::user();

        if(isset($aData['pk'])){
            $oBell = Bell::find($aData['pk']);
        }else{
            $oBell = new Bell();
            $oBell->id_branch = $oUser->id_branch;
            $oBell->created_by = $oUser->id;
        }
        $oBell->name = $request->name;
        $oBell->status = $request->status;
        $oBell->scope = $request->scope;
        $oBell->date_start = $request->date_start;
        $oBell->discount_type = $request->discount_type;
        $oBell->discount = $request->discount;
        $oBell->date_end = $request->date_end;
        $oBell->description = $request->description;

        $oBell->save();
        DB::table('bell_detail')
            ->where('id_bell', $oBell->id)
            ->update(['status' => 'INACTIVO']);
        if(isset($aData['idTabla'])){
            $aTabla = $request->idTabla;
            $aTipo = $request->idScope;
            $aNombre = $request->nombre;
            $aPk = $request->pkDetail;

            foreach ($aData['idTabla'] as $iDetail => $idDetail){
                if($aPk[$iDetail]>0){
                    $oDataDetail = BellDetail::find($aPk[$iDetail]);
                    $oDataDetail->status = 'ACTIVO';
                }else{
                    $oDataDetail = new BellDetail();
                    $oDataDetail->created_by = $oUser->id;
                }
                $oDataDetail->name =$aNombre[$iDetail];
                $oDataDetail->id_bell =$oBell->id;
                $oDataDetail->id_tabla =$aTabla[$iDetail];
                $oDataDetail->type =$aTipo[$iDetail];
                $oDataDetail->save();
            }
        }
        if(isset($aData['id_branch'])){
            DB::table('bell_branch')
                ->where('id_bell', $oBell->id)
                ->update(['status' => 'INACTIVO']);
            $aIdBranch = $request->id_branch;
            foreach ($aIdBranch as $iDetail => $idBranch){
                $oBellBranch = new BellBranch();
                $oBellBranch->created_by = $oUser->id;
                $oBellBranch->id_bell = $oBell->id;
                $oBellBranch->id_branch = $idBranch;
                $oBellBranch->save();
            }
        }
        return redirect()->route('bell.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $aData = $request->toArray();
        $oItem = Bell::find($aData['id']);
        $this->desactivar($oItem);
        return response()->json([
            'success' => $this->errorBag()]);
    }
}
