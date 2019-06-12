<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class Controller extends BaseController
{
    const DELETE = "DELETE";
    const ACTIVE = "ACTIVO";

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct() {
        if (Auth::guest()) {
//            return redirect()->guest('login');
            //$this->getRol();
            return redirect()->route('home');
        }
    }

    public function getRol(){
        $oUser = new User();
        $oUserSession = Auth::user();
        $aRol = null;
        if(is_object($oUserSession)){
            $oRol = $oUser::join('user_x_rol', function ($join){
                $join->on('user_x_rol.id_user', '=', 'users.id');
                $join->where('user_x_rol.status', '=', $this::ACTIVE);
            })->join('rol', function ($join){
                $join->on('user_x_rol.id_rol', '=', 'rol.id');
            })->where('users.id','=',$oUserSession->id)
                ->get()->toArray();
            if(sizeof($oRol)>0){
                $aRol= array_reduce($oRol,function($carray, $oValue){
                    $carray[$oValue['code']] = $oValue;
                    session(['rol' => $oValue['code']]);
                    return $carray;
                });
                $suser = session('name.usuario');
                $rol = session('rol');
                session(['name.usuario' => $oUserSession->name]);
            }else{
                return redirect()->guest('login');
            }

        }

        return $aRol;
    }
    public static function isAdmin(){
        return config('rol') =='ADM';
    }
    public static function isSuperUsuario(){
        return config('rol') =='SUP';
    }
    public static function isUsuario(){
        return config('rol') =='CLI';
    }

    public function desactivar($obj){
        if(method_exists($obj,'save')){
            $obj->status = $this::DELETE;
            $obj->save();
        }
    }
}