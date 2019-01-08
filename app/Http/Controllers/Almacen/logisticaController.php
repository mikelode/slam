<?php

namespace Logistica\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almTLogDep;
use Logistica\Almacen\almTLogOC;
use Logistica\Almacen\almTLogOCD;
use Logistica\Almacen\almTLogProd;
use Logistica\Almacen\almTLogUnidad;
use Logistica\Almacen\almTPerPrs;
use Logistica\Almacen\almTPreSF;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Input;

class logisticaController extends Controller
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

    public function autoFindOc(Request $request)
    {
        $year = substr(trim($request->period), -2);
        $termOc = 'OC'.$year.'%'.$request->term.'%';
        //$termOc = '%'.$request->term.'%';
        $oc = almTLogOC::where('orcID','LIKE',$termOc)
            ->where('orcAnio',$request->period)
            ->orderBy('orcFecha','desc')
            ->get();

        $result = [];

        foreach($oc as $idOc)
        {
            $result[] = array('value' => $idOc->orcID);
        }

        return response()->json($result);
    }

    public function autoFindProd(Request $request)
    {
        $termProd = '%'.$request->term.'%';
        $prod = almTLogProd::where('proDsc','LIKE',$termProd)->get();
        $result = [];

        foreach($prod as $p)
        {
            $result[] = array('value' => $p->proID, 'label' => $p->proDsc);
        }

        return response()->json($result);
    }

    public function autoFindUnidad(Request $request)
    {
        $termUnd = '%'.$request->term.'%';
        $unidad = almTLogUnidad::where('undDsc','LIKE',$termUnd)->get();
        $result = [];

        foreach($unidad as $und)
        {
            $result[] = array('value' => $und->undAbr, 'label' => $und->undDsc);
        }

        return response()->json($result);
    }

    public function autoFindPersona(Request $request)
    {
        $term = '%'.$request->term.'%';

        if($request->tipo == 'dni')
        {
            $persona = almTPerPrs::where('perID','LIKE',$term)->get();
        }
        elseif($request->tipo == 'fname')
        {
            $persona = almTPerPrs::whereRaw('perNombres + \' \' + perAPaterno + \' \' + perAMaterno LIKE \''.$term.'\'')->get();
        }

        $result = array();

        foreach($persona as $per)
        {
            $result[] = array('dni' => $per->perID, 'fullname' => $per->perNombres.' '.$per->perAPaterno.' '.$per->perAMaterno);
        }

        return response()->json($result);
    }

    public function autoFindDependency(Request $request)
    {
        $term = '%'.$request->term.'%';

        $dependencia = almTLogDep::where('depDsc','LIKE',$term)->where('depid', 'like', '18DP%')->get();

        $result = array();

        foreach($dependencia as $dep)
        {
            $result[] = array('id' => $dep->depID, 'dsc' => $dep->depDsc);
        }

        return response()->json($result);
    }

    public function autoFindSecuencia(Request $request)
    {
        $term = '%'.$request->term.'%';

        if($request->tipo == 'code')
        {
            $secuencia = almTPreSF::where('secID','LIKE',$term)->get();
        }
        elseif($request->tipo == 'desc')
        {
            $secuencia = almTPreSF::where('secDsc','LIKE',$term)->get();
        }

        $result = array();

        foreach($secuencia as $sec)
        {
            $result[] = array('idSf' => $sec->secID, 'dscSf' => $sec->secDsc);
        }

        return response()->json($result);
    }


   public function autoFindSecFun(Request $request)
    {
        $anio99 = Input::get('txAnioFinal');
        //.substr($anio,-2).
        $anioFin = 'SF1800%';
        $term = '%'.$request->term.'%';
        $secuencia = almTPreSF::where('secID','LIKE',$term)->where('secID','LIKE',$anioFin)->get();
        $result = array();
        foreach($secuencia as $sec)
        {
            $result[] = array('value' => $sec->secID, 'label' => substr( $sec->secID,-4));
        }

        return response()->json($result);
    }


    public function getDataOc(Request $request)
    {
        $data = DB::connection('dblogistica')->table('TLogOC')
                        ->select('*', DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('DEP',orcDep,'') as ocDepdesc"))
                        ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('RUC',orcRuc,'') as ocProv"))
                        ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',orcProcTip,'') as ocProcTipo"))
                        ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('SECFUN',orcSecFun,'') as ocSecFuncDesc"))
                        ->where('orcID',$request->oc)->get();

        $ct = DB::connection('dblogistica')->table('TLogOCD')
                        ->select(DB::raw("CONVERT(DECIMAL(19,4),SUM(cdtCant * cdtPrecio)) as ocTotalCosto"))
                        ->where('cdtCodOC',$request->oc)->get();

        $view = view('almacen.ingreso.ocDetailData',['data' => $data, 'ct' => $ct]);
        return $view;
    }

    public function getProductsOc(Request $request)
    {
        $products = DB::connection('dblogistica')->table('TLogOCD')
                        ->select('*', DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('PROD',cdtCodProd,'') AS ocdProd"))
                        ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('UNDABRV',cdtCodUnd,'') AS ocdUnd"))
                        ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('CLASF',cdtCodClsf,'') AS ocdClsf"))
                        ->where('cdtCodOC',$request->oc)->get();

        $view = view('almacen.ingreso.ocDetailProducts',compact('products'));
        return $view;
    }

    public function getVerifyExistOc(Request $request)
    {
        /* VERIFICAR SI LA OC NO ESTA REGISTRADA O ESTA ANULADA PARA PODER REGISTRAR */
        $findOc = almInternamiento::where('oc_cod',$request->oc)->count();

        if($findOc == 0)
        {
            return 200;
        }
        else
        {
            $nullOc = almInternamiento::select('*')
                        ->where('oc_cod',$request->oc)
                        ->where('estado_anulacion','SI')
                        ->count();
            if($nullOc == 0)    
                return 500;
            else
                return 501;
        }
    }
}
