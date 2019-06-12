<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->initData();
        return view('admin.person.list',$data);
    }

    public function initData(){
        $oUser = Auth::user();
        $oPerson = new Person();
        $aPerson = $this->getList(false);
        $aData = array(
            'aPerson' => $aPerson,
            'user' => $oUser->id
        );
        return $aData;
    }

    public function getList($isJson =true){
        $oPerson = new Person();
        $aPerson = $oPerson::where("status",'<>', $this::DELETE)
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
        if($isJson){
            return response()->json([
                'data' => $aPerson,
                'success' => true]);
        }
        return $aPerson;
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
            $oPerson = Person::find($aData['pk']);
            $aData['updated_by'] = $oUser->id;
        }else{
            $oPerson = new Person();
            $aData['created_by'] = $oUser->id;
        }
        $oPerson->fill($aData);
        $saveItem = $oPerson->save();

        return redirect()->route('person.index');
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
        $oPerson = Person::find($aData['id']);
        $oPerson->delete();
        return response()->json([
            'success' => $this->errorBag()]);
    }
}
