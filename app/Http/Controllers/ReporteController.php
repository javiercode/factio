<?php

namespace App\Http\Controllers;

use App\Central;
use App\ParDominio;
use App\SensorDato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;


class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$aData =$request->all();
        $data = $this->initData();
        print_r($data);exit;*/
        $data = $this->initData(array());
        return view('report.reporte.list',$data);
    }

    public function initData($aData){
        $oUser = Auth::user();
        $oSensorDato = new SensorDato();
        $oCentral = new Central();
        $oParDominio = new ParDominio();
        $aSensorDato = $oSensorDato::join('sensor', function ($join){
                $join->on('sensor.id', '=', 'sensor_dato.id_sensor');
                $join->where('sensor.status', '<>', $this::DELETE);
            })->join('central', function ($join){
                $join->on('central.id', '=', 'sensor.id_central');
                $join->where('central.status', '<>', $this::DELETE);
            })->join('par_dominio', function ($join){
                $join->on('par_dominio.codigo', '=', 'sensor_dato.tipo');
                $join->where('par_dominio.dominio', '=', SensorDato::TIPO_ALERTA);
            })
            ->where('sensor_dato.status', '<>', $this::DELETE)
            ->select('sensor_dato.id','sensor_dato.estado','sensor_dato.fecha','par_dominio.detalle as tipo','central.nombre as central',
                'sensor.codigo','sensor.detalle','sensor.tipo as tipoSensor','sensor.descripcion',
                'central.ubicacion','central.latitud','central.longitud');
        if(isset($aData['idCentralFilter']) && is_numeric($aData['idCentralFilter'])){
            $aSensorDato = $aSensorDato->where('central.id', '=', $aData['id_central']);
        }
        if(isset($aData['fechaInicioFilter']) && isset($aData['fechaFinFilter'])){
            $fechaInicio = DateTime::createFromFormat('d/m/Y', $aData['fechaInicioFilter'])->format('Y-m-d');
            $fechaFin = DateTime::createFromFormat('d/m/Y', $aData['fechaFinFilter'])->format('Y-m-d');
            $aSensorDato = $aSensorDato->where([
                ['sensor_dato.fecha', '>=', $fechaInicio.' 00:00:00'],
                ['sensor_dato.fecha', '<=', $fechaFin.' 23:59:59'],
            ]);
        }
        if(isset($aData['tipoFilter'])){
            $aSensorDato = $aSensorDato->where('par_dominio.codigo', '=', $aData['tipoFilter']);
        }
        $aSensorDato = $aSensorDato->orderBy('sensor_dato.fecha', 'desc')->get()->toArray();

        $aCentral= $oCentral::where('status','<>',$this::DELETE)->get()->toArray();
        $aTipo= $oParDominio::where('status','<>',$this::DELETE)
            ->where('dominio','=',SensorDato::TIPO_ALERTA)
            ->get()->toArray();
        $aData = array(
            'aSensorDato' => $aSensorDato,
            'aCentral' => $aCentral,
            'aTipo' => $aTipo,
        );
        return $aData;
    }

    public function getList(Request $request){
        $aData = $request->toArray();
        $aResult = $this->initData($aData);
        return response()->json($aResult);
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
            $oItem = ItemBranch::find($aData['pk']);
        }else{
            $oItem = new ItemBranch();
            $oItem->created_by = Auth::user()->id;
            $oItem->id_branch = $oUser->id_branch;
        }
        $oItem->stock_minium = $request->stock_minium;
        $oItem->id_item = $request->id_item;
        $oItem->observation = $request->observation;
        $saveItem = $oItem->save();
        return redirect()->route('itemBranchAdm.index');
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
    public function getItem(Request $request){
        $oItemBranch = ItemBranch::find($request->id);
        return response()->json([
            'success' => true,
            'oItemBranch' => $oItemBranch]);
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
//        print_r($aBell);exit;

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
