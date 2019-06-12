<?php

namespace App\Http\Controllers;

use App\Person;
use App\Rol;
use App\User;
use App\UserXRol;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Mockery\CountValidator\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->initData();
        return view('admin.user.list',$data);
    }

    public function initData()
    {
        $oPerson = new Person();
        $oUser = new User();
        $oRol = new Rol();
        $oRolUser = new UserXRol();
        $aUser = $oUser::join('person', function ($join) {
            $join->on('person.id', '=', 'users.id_person');
            $join->where('person.status', '=','ACTIVO');
        })->orderBy('users.created_at', 'desc')
            ->select('person.id', 'users.id_person', 'users.id as id_user', 'username', 'email',  'last_access', 'users.status', 'first_name', 'second_name', 'first_lastname', 'second_lastname', 'ci', 'complement_ci', 'extencion_ci', 'gender')
            ->get()->toArray();
        $aUser = array_reduce($aUser,function($carray, $oValue){
            $oValue['nombre_formal'] = $oValue['first_name'] .' '.(isset($oValue['second_name'])?$oValue['second_name']:'').' '.(isset($oValue['first_lastname'])?$oValue['first_lastname']:'').' '.(isset($oValue['second_lastname'])?$oValue['second_lastname']:'');
            $carray[$oValue['id_person']][] = $oValue;
            return $carray;
        });

        $aPerson =$oPerson::where("status", 'ACTIVO')->get()->toArray();
        $aPersonUser = $oPerson::join('users','users.id_person','=','person.id')
            ->where("users.status", 'ACTIVO')
            ->select("first_name", "second_name", "first_lastname", "first_lastname","person.id")
            ->groupBy("person.id", "first_name", "second_name", "first_lastname", "first_lastname")
            ->get()->toArray();

        $aRolUser = $oRolUser::where('status','=','ACTIVO')->get()->toArray();
        $aDataRolUser = array();
        foreach ($aRolUser as $oRolUser){
            $aDataRolUser[$oRolUser['id_user']][] = $oRolUser['id_rol'];
            //$aDataRolUser[$oRolUser['id_user']] = $oRolUser['id_rol'];
        }
        $aData = array(
            'aUser' => ($aUser),
            'aRolUser' => $aDataRolUser,
            'aRol' => $oRol::where('status','=','ACTIVO')->get()->toArray(),
            'aPerson' => $this->parseAPerson($aPerson),
            'aPersonUser' => $this->parseAPerson($aPersonUser)
        );
        return $aData;
    }

    public function parseAPerson($aList){
        $aList = array_reduce($aList,function($carray, $oValue){
            $oValue['nombre_formal'] = $oValue['first_name'] .' '.(isset($oValue['second_name'])?$oValue['second_name']:'').' '.(isset($oValue['first_lastname'])?$oValue['first_lastname']:'').' '.(isset($oValue['second_lastname'])?$oValue['second_lastname']:'');
            $carray[$oValue['id']] =$oValue;
            return $carray;
        });
        return $aList;
    }

    public function getRolUsers(){
        $oRol = new Rol();
        $oUser = new User();
        $aRolUser = $oRol::leftJoin('user_x_rol', function ($join) {
            $join->on('user_x_rol.id_rol', '=', 'rol.id');
            $join->where('user_x_rol.status', '=', 'ACTIVO');
        })->join('users', function ($join) {
            $join->on('users.id', '=', 'user_x_rol.id_user');
        })->where('rol.status','=','ACTIVO')->orderBy('id_person','id_user','id_rol')->get()->toArray();
        $aRolUser = array_reduce($aRolUser,function($carray, $oValue){
            $carray['*'.$oValue['id_person']]['*'.$oValue['id_user']]['*'.$oValue['id_rol']] = $oValue;
            return $carray;
        });
        $aUser = $oUser::all()->toArray();
        $aUser = array_reduce($aUser,function($carray, $oValue){
            $carray['*'.$oValue['id']]= $oValue;
            return $carray;
        });
        return response()->json([
            'success' => true,
            'aPerson' => $aRolUser,
            'aUser' => $aUser,
            'aRol' => $oRol::where('status','=','ACTIVO')->orderBy('id')->get()->toArray()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            $aData = $request->all();
            $aData['password'] = Hash::make($aData['password']);
            $oUserSession = Auth::user();

            if (isset($aData['pk'])) {
                $oUser = User::find($aData['pk']);

            } else {
                $oUser = new User();

                $oUser->id_person = $aData['id_person'];
                $aData['created_by'] = $oUserSession->id;
            }
            $oPerson = Person::find($oUser->id_person);
            $aData['name']=$oPerson->first_name." ".$oPerson->first_lastname;
            $oUser->fill($aData);
            $oUser->save();
            if(!isset($aData['pk'])){
                $oRolUser =new UserXRol();
            }
        }catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect()->route('user.index');
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
    public function destroy($id)
    {
        //
    }

    public function updateRol(Request $request){
        $aData = $request->all();

        $oUserRol = new UserXRol();
        $oUserRol = $oUserRol::where('id_user', $aData['idUser'])
            ->where('id_rol', $aData['idRol'])->get()->toArray();
        //update(['status' => $aData?'ACTIVO':'INACTIVO']);

        if(sizeof($oUserRol)>0){
            $pk = $oUserRol[0]['id'];
            $oUserRol = UserXRol::find($oUserRol[0]['id']);
            $oUserRol->status= $aData['checked']==1?'ACTIVO':'INACTIVO';
        }else{
            $oUserRol = new UserXRol();
            $oUserRol->id_user = $aData['idUser'];
            $oUserRol->id_rol = $aData['idRol'];
            $oUserRol->created_by = Auth::user()->id;
            $oUserRol->status = $aData['checked']==1?'ACTIVO':'INACTIVO';
        }
        $oUserRol->save();
        $swSuccess = is_object($oUserRol);
        return response()->json([
            'success' => $swSuccess,
            'oUserRol' => $oUserRol
        ]);
    }

    public function getEdit(Request $request)
    {
        $aData = $request->toArray();
        $oUser = User::find($request->id)->toArray();
        return response()->json([
            'success' => true, 'oUser' => $oUser]);

    }
}
