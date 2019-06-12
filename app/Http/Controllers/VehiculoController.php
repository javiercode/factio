<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use App\VehiculoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use PDF;

class VehiculoController extends Controller
{
    private $oUser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->oUser = Auth::user();
        $data = $this->initData();
        return view('control.vehiculo.list',$data);
    }

    public function initData(){
        $oVehiculo = new Vehiculo();
        $oVehiculoDetail = new VehiculoDetalle();
        $aVehiculo = $oVehiculo::join('users', function ($join) {
            $join->on('users.id', '=', 'vehiculo.id_importador');
        })->where("id_importador",'=', $this->oUser->id)
            ->where("vehiculo.status",'<>', $this::DELETE)
            ->orderBy('vehiculo.created_at', 'desc')
            ->select('vehiculo.id', 'users.name', 'vehiculo.status', 'chasis',
                'marca', 'modelo', 'color', 'descripcion', 'observacion')
            ->groupBy('vehiculo.id')
            ->get()->toArray();
        $aVehiculoDetail = $oVehiculoDetail::where("status",'<>', $this::DELETE)
            ->orderBy('created_at', 'desc')
            ->get()->toArray();
        //print_r($aVehiculo);exit;

        $aResult = array_reduce($aVehiculoDetail,function ($carray, $oValue){
            $carray[$oValue['id_vehiculo']][]=$oValue;
            return $carray;
        });

        $aData = array(
            'aVehiculo' => $aVehiculo,
            'aVehiculoDetail' => $aResult,
            'importador' => $this->oUser,
            'aTipoEnum' => $oVehiculo->getEnum(),
        );

        return $aData;
    }

    public function getPdf(Request $request)
    {
        $pk = $request->route('id');
        $aData =$request->all();
        //$pk =$aData['id'];
        $data = $this->getDataPdf($pk);
//        QrCode::format('png')->size(399)->color(40,40,40)->generate('Transfórmame en un QrCode!');
        $date = date('d/m/Y');
        $view =  \View::make('control.vehiculo.documento', compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
//        return $pdf->download('salida');
    }

    public function getDataPdf($pk)
    {
        $oUser = Auth::user();
        $oVehiculo = new Vehiculo();
        $oVehiculoDetail = new VehiculoDetalle();
        $aVehiculoDetail = array();

        $aVehiculo = $oVehiculo::join('users', function ($join) {
            $join->on('users.id', '=', 'vehiculo.id_importador');
        })->where("id_importador",'=', $oUser->id)
            ->where("vehiculo.status",'<>', $this::DELETE)
            ->where("vehiculo.id",'=', $pk)
            ->orderBy('vehiculo.created_at', 'desc')
            ->select('vehiculo.id', 'users.name as importador', 'vehiculo.status', 'chasis',
                'marca', 'modelo', 'color', 'descripcion', 'observacion')
            ->get()->toArray();

        if(is_array($aVehiculo) && sizeof($aVehiculo)==1){
            $aVehiculo = $aVehiculo[0];
            $aVehiculoDetail = $oVehiculoDetail::where("status",'<>', $this::DELETE)
                ->where("id_vehiculo",'=', $aVehiculo['id'])
                ->orderBy('tipo', 'asc')
                ->get()->toArray();
        }


        $data =  [
            'oVehiculo' => $aVehiculo,
            'aDetail' => $aVehiculoDetail,
        ];
        return $data;
    }

    public function getScope(Request $request){
        $aData = $request->all();
        $oCatalogItem = new CatalogItem();
        $oItem = new Item();
        $term = $aData['term']['term'];
        $aResult=array();
        if(isset($aData['term']) && isset($aData['term']['term'])){
            switch ($aData['type']){
                case'PART_CATEGORY':
                    $aResult = $oCatalogItem::where('status', '=', 'ACTIVO')
                        ->where('type', '=', 'PART_CATEGORY')
                        ->where(function($query) use ($term){
                            $query->where('label', 'like', '%'.$term.'%');
                            $query->orWhere('value', 'like', '%'.$term.'%');
                            $query->orWhere('code', 'like', '%'.$term.'%');
                        })
                        ->orderBy("value","code","label")
                        ->limit(50)
                        ->get()->toArray();
                    $aResult = array_reduce($aResult,function($carray, $oValue){
                        $carray[]=array(
                            'id'=>$oValue['id'],
                            'text'=>"(".$oValue['value'].") ".$oValue['code']." - ".$oValue['label'],
                        );
                        return $carray;
                    });
                    break;
                case'PRODUCT_GROUP':
                    $aResult = $oCatalogItem::where('status', '=', 'ACTIVO')
                        ->where('type', '=', 'PRODUCT_GROUP')
                        ->where(function($query) use ($term){
                            $query->where('label', 'like', '%'.$term.'%');
                            $query->orWhere('value', 'like', '%'.$term.'%');
                        })
                        ->orderBy("value","label")
                        ->limit(50)
                        ->get()->toArray();
                    $aResult = array_reduce($aResult,function($carray, $oValue){
                        $carray[]=array(
                            'id'=>$oValue['id'],
                            'text'=>$oValue['value']." - ".$oValue['label'],
                        );
                        return $carray;
                    });
                    break;
                case'PART_NRO':
                    $aResult = $oItem::where('status','=','ACTIVO')
                        ->where(function($query) use ($term){
                            $query->where('part_nro', 'like', '%'.$term.'%');
                            $query->orWhere('name', 'like', '%'.$term.'%');
                        })
                        ->orderBy("part_nro","name")->limit(50)->get()->toArray();
                    $aResult = array_reduce($aResult,function($carray, $oValue){
                        $carray[]=array(
                            'id'=>$oValue['id'],
                            'text'=>$oValue['part_nro']." - ".$oValue['name'],
                        );
                        return $carray;
                    });
                    break;
            }
        }

        return response()->json([
            'success' => true, 'aResult'=> array_reverse($aResult)]);
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
        $aData['id_importador']=$oUser->id;
        if(isset($aData['pk'])){
            $oVehiculo = Vehiculo::find($aData['pk']);
            $aData['updated_by'] = $oUser->id;
        }else{
            $oVehiculo = new Vehiculo();
            $aData['created_by'] = $oUser->id;
        }
        $oVehiculo->fill($aData);
        $oVehiculo->save();

        DB::table('vehiculo_detalle')
            ->where('id_vehiculo', $oVehiculo->id)
            ->update(['status' => 'INACTIVO']);
        if(isset($aData['pkDetail'])){
            $aTipo = $request->tipo;
            $aDetalle = $request->detalle;
            $aPk = $request->pkDetail;
            foreach ($aPk as $iDetail => $idDetail){
                if($aPk[$iDetail]>0){
                    $oDataDetail = VehiculoDetalle::find($aPk[$iDetail]);
                    $oDataDetail->status = 'ACTIVO';
                }else{
                    $oDataDetail = new VehiculoDetalle();
                    $oDataDetail->created_by = $oUser->id;
                }
                $oDataDetail->detalle =$aDetalle[$iDetail];
                $oDataDetail->tipo =$aTipo[$iDetail];
                $oDataDetail->id_vehiculo =$oVehiculo->id;
                $oDataDetail->save();
            }
        }
        return redirect()->route('vehiculo.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $oBell = Bell::find($request->id);
        $aDetilBell = BellDetail::where('status', '=', 'ACTIVO')
            ->where('id_bell', '=', $request->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $oBell = Bell::find($request->id);
        $aDetilBell = BellDetail::where('status', '=', 'ACTIVO')
            ->where('id_bell', '=', $request->id)->get();
        print_r($oBell);exit;
    }

    public function getEdit(Request $request)
    {
        $aData = $request->toArray();
        $aDetilBell = BellDetail::where('status', '=', 'ACTIVO')
            ->where('id_bell', '=', $request->id)->get();
        $aBell = Vehiculo::find($request->id)->toArray();
        $oBell = new Bell();

        $oBellBranch = new BellBranch();
        $aBellBranch = array();
        if(is_array($aBell) && sizeof($aBell)>1){
            $aBell['date_start'] = date_format(date_create($aBell['date_start']),"d/m/Y");
            $aBell['date_end'] = date_format(date_create($aBell['date_end']),"d/m/Y");
            $aBell['periodo'] = $aBell['date_start']." - ".$aBell['date_end'];
            $aBellBranch = $oBellBranch::where('status','=','ACTIVO')->where('id_bell','=',$request->id)->get()->toArray();
            $aBellBranch = array_reduce($aBellBranch,function ($carray, $oValue){
                $carray['*'.$oValue['id_branch']]=$oValue;
                return $carray;
            });
        }
        return response()->json([
            'success' => true,
            'oBell' => $aBell,
            'aDetilBell' => $aDetilBell->toArray(),
            'aBellBranch' =>$aBellBranch ,
            'aScope' => $oBell->getScope()]);

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
        $oItem = Vehiculo::find($aData['id']);
        $this->desactivar($oItem);
        return response()->json([
            'success' => $this->errorBag()]);
    }

    public function getBell($id_branch){
        $today = date('d/m/Y');
        $aBell =Bell::where([
            ['bell.status', '=', 'ACTIVO'],
            ['date_start', '<=', $today],
            ['date_end', '>=', $today],
        ])->join('bell_detail', function ($join) {
            $join->on('bell.id', '=', 'bell_detail.id_bell');
            $join->where('bell_detail.status', '=','ACTIVO');
        })->join('bell_branch', function ($join) use($id_branch) {
            $join->on('bell.id', '=', 'bell_branch.id_bell');
            $join->where('bell_branch.status', '=','ACTIVO');
            $join->where('bell_branch.id_branch', '=', $id_branch);
        })
            ->select('bell.discount_type','bell.discount', 'bell.name', 'bell_detail.type', 'bell_detail.type', 'bell_detail.id_tabla')
            ->get()->toArray();
        $result = array_reduce($aBell,function ($carray, $oValue){
            $carray[$oValue['type']][$oValue['id_tabla']][]=[
                'type'=>$oValue['discount_type'],
                'discount'=>$oValue['discount'],
                'name'=>$oValue['name'],
            ];
            return $carray;
        });
        $aResult = [];
        if(isset($result['PART_NRO'])){
            $idPartNro = array_keys($result['PART_NRO']);
            $aItem =Item::where('item.status', '=', 'ACTIVO')
                ->select( 'id','price')
                ->get()->toArray();
            $aItem= array_reduce($aItem,function ($carray, $oValue){
                $carray[$oValue['id']]=$oValue;
                return $carray;
            });
            $aPartNro = $result['PART_NRO'];
            $aResult = array_reduce($aItem,function ($carray, $oValue) use($aPartNro) {
                $price = $oValue['price'];
                $discount = [];
                $name = [];
                if(isset($aPartNro[$oValue['id']])){
                    foreach ($aPartNro[$oValue['id']] as $oPartNro){
                        switch ($oPartNro['type']){
                            case 'PORCENTAJE':
                                $discount []= (($price*$oPartNro['discount'])/100);
                                $price -= (($price*$oPartNro['discount'])/100);
                                break;
                            case 'PRECIO':
                                $discount []= $oPartNro['discount'];
                                $price -= $oPartNro['discount'];
                                break;
                        }
                        $name[]=$oPartNro['name'];
                    }
                    $carray['*'.$oValue['id']]=['price'=>$price,'discount'=>$discount,'name'=>$name];
                }
                return $carray;
            });
        }

        if(isset($result['PRODUCT_GROUP'])){
            $aResultPG = $this->getDataDsicount('product_group',$result['PRODUCT_GROUP']);
            $aResult= array_merge_recursive($aResult,$aResultPG);
        }
        if(isset($result['PART_CATEGORY'])){
            $aResultPC = $this->getDataDsicount('part_category',$result['PART_CATEGORY']);
            $aResult= array_merge_recursive($aResult,$aResultPC);
        }
        return $aResult;
    }

    public function getDataDsicount($param,$aDescount){
        $aResult = [];
        $idProductGroup = array_keys($aDescount);
        $aProductGroup = CatalogItem::whereIn("id",$idProductGroup)->select('id','value')->get()->toArray();
        $aProductGroup = array_reduce($aProductGroup,function ($carray, $oValue){
            $carray[$oValue['id']]=$oValue['value'];
            return $carray;
        });

        $aItem = Item::where('item.status', '=', 'ACTIVO');
        $aItem = $aItem->whereIn($param, $aProductGroup);
        $aItem = $aItem->orderby('id')->get()->toArray();
        $aItem = ($aItem && sizeof($aItem)>0)? $this->formatItem($aItem):[];
        $aResult = ($aItem && sizeof($aItem)>0)? $this->formatItemDescount($aItem,$aDescount,$aProductGroup, $param):[];
        return $aResult;
    }

    public function formatItemDescount($aItem, $aParam,$aIdParam, $param){
        $aIdParam =array_flip($aIdParam);
        $aResult = array_reduce($aItem,function ($carray, $oValue) use($aParam,$aIdParam,$param){
            $price = $oValue['price'];
            $aList = $aParam[$aIdParam[$oValue[$param]]];
            $discount = [];
            $name = [];
            foreach ($aParam[$aIdParam[$oValue[$param]]] as $oPartNro){
                switch ($oPartNro['type']){
                    case 'PORCENTAJE':
                        $discount []=(($price*$oPartNro['discount'])/100);
                        $price -= (($price*$oPartNro['discount'])/100);
                        break;
                    case 'PRECIO':
                        $discount []= $oPartNro['discount'];
                        $price -= $oPartNro['discount'];
                        break;
                }
                $name[]=$oPartNro['name'];
            }
            $carray['*'.$oValue['id']]=['price'=>$price,'discount'=>$discount,'name'=>$name];
            return $carray;
        });
        return $aResult;
    }

    public function formatItem($aItem){
        $aItem= array_reduce($aItem,function ($carray, $oValue){
            $carray[$oValue['id']]=$oValue;
            return $carray;
        });
        return $aItem;
    }
}
