<?php

namespace Logistica\Http\Controllers\Logistica;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\User;
use PhpParser\Node\Expr\Array_;
use  Barryvdh\DomPDF;
class ctrlReq extends Controller
{
 
  /* if(!($request["datos"]["reqUsr"]==$idU )) {
     $Validar = array();
     array_push($Validar, array('ReqNo' => "NN", 'Error' => '1', 'Mensaje' => ' El requerimiento solo puede ser modificada por el usuario :' . $request["datos"]["reqUsr"]));
     return response()->json($Validar);
  }*/

    public function _construct()
    {
        $this->middleware('auth');

    }

    public  function fnGetViewReq()
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_RQ'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                return view('logistica.Adq.vwAdqReq');
            }
            else {
                return view('logistica.Adq.vwPermission');
            }
        }
        else {
            return view('logistica.Adq.vwPermission');
        }
    }
    public function spLogSetReq(Request $request)
    {
        $varOpe = $request["datos"]["reqOPE"];
        $ErrorDtll=array();        
        $idU = Auth::user()->usrID;
        $flg = false;
        if( !($varOpe=="TRH" || $varOpe=="DEL" )) {
            foreach ($request["lista"] as $key => $valor) {    $flg = true;    }
            if (!$flg) {
                array_push($ErrorDtll, array('ReqNo' => 'NN', 'Error' => '1', 'Mensaje' => ' Falta los Detalles del Requerimiento'));
                return response()->json($ErrorDtll);
            }
        }

        $result = \DB::select('exec spLogSetReq ?,?,?,?,?  ,?,?,?,?,?  ,?,?,?,?,?   ,?,?,?,?',
            array(
                $request["datos"]["reqOPE"],
                $request["datos"]["reqID"],
                $request["datos"]["reqTipoReq"],
                $request["datos"]["reqAnio"],
                $request["datos"]["reqFecha"],
                $request["datos"]["reqDep"],
                $request["datos"]["reqRubro"],
                $request["datos"]["reqSecFun"],//$request->txCodSecFun,
                $request["datos"]["reqSubSec"],
                $request["datos"]["reqDNI"],//$request->txDNI,
                $request["datos"]["reqCondicion"],
                $request["datos"]["reqGlosa"],
                '01',
                $request["datos"]["reqLugarEnt"],
                'AD',
                $request["datos"]["reqTipoGto"],
                $request["datos"]["reqObsv"],                
                $idU,  //Auth::user()->usrID
                $request["datos"]["reqObj"]
            ));
        
        $idError = $result[0]->Error ;
        $idMsg   = $result[0]->Mensaje ;
        if($idError!=0) {
              $Validar = array();
              array_push($Validar, array('ReqNo' => "NN", 'Error' => '1', 'Mensaje' => ' **** ' . $idMsg ));
              return response()->json($Validar);
        }

        if( $varOpe=="ADD")
        {
            $idReq = $result[0]->ReqNo ;
            $ErrorDtll =array();
            if($idReq=="NN") { return response()->json($result); ; }
            foreach ($request["lista"] as $key => $valor)
            {
                $resultDetalles = \DB::select('exec spLogSetReqD ?,?,?,?,?  ,?,?,?,?,? ',
                    array( $varOpe, 0  ,$idReq  , $valor["prod"], $valor["und"],$valor["clasf"],$valor["cant"],$valor["precioUnt"],$valor["espf"], Auth::user()->usrID ));
                if ($resultDetalles[0]->ReqNo == "NN")
                {
                    array_push($ErrorDtll, array('ReqNo' => $resultDetalles[0]->ReqNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                }
            }
            if (count($ErrorDtll) > 0) {    return response()->json($ErrorDtll);      }
        }
        return  response()->json ($result );
    }
    public function spLogSetReqD(Request $request)
    {
        $idU = Auth::user()->usrID;
        $codReq = $request["datos"]["reqID"];                
        $varReturn["Msg"] = \DB::select('exec spLogSetReqD ?,?,?,?,?  ,?,?,?,?,? ',    array( $request["lista"]["OPE"] , $request["lista"]["ID"]  ,$codReq  , $request["lista"]["prodID"],   $request["lista"]["prodUndID"],$request["lista"]["prodClasfID"],$request["lista"]["prodCant"],$request["lista"]["prodPrecioUnt"],$request["lista"]["prodEspf"], Auth::user()->usrID ));
        $result = \DB::select('exec spLogGetReqD ?',array( $codReq));
        $varReturn["ReqDll"] =  view ('logistica.Partials.logReqDll',compact( 'result'))->render();
        return  $varReturn;
    }
    public function spLogSetReqBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select('exec spLogSetReqBusy ?,?',   array($request->Anio, Auth::user()->usrID));
        return  $result;
    }
    public function spLogGetReqBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' select dbo.fnLogGetCodRq( dbo.fnLogGetRqKy(?) ) as Codigo',   array($request->Anio));
        return  $result;
    }

    public function spLogGetReq(Request $request)
    {
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  $request->prRows, $request->prAnio, $request->prQry ));
        if(isset ($ReturnData["Req"][0]->reqID)) {
            $result = \DB::select('exec spLogGetReqD ?', array($ReturnData["Req"][0]->reqID));      //  dd($dll);
            $ReturnData["ReqDll"] = view('logistica.Partials.logReqDll', compact('result'))->render();
        }
        return  $ReturnData ;
    }

     public function spLogGetReqTmpII(Request $request)
    {
        $ReturnData["Req"] = \DB::select('exec spLogGetReqTmp ?,?,?', array(  $request->prRows, $request->prAnio, $request->prQry ));
        if(isset ($ReturnData["Req"][0]->reqID)) {
            $result = \DB::select('exec spLogGetReqD ?', array($ReturnData["Req"][0]->reqID));      //  dd($dll);
            $ReturnData["ReqDll"] = view('logistica.Partials.logReqDll', compact('result'))->render();
        }
        return  $ReturnData ;
    }

   /* public function spLogGetReqTmp(Request $request)
    {

        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $request->prAnio, '' ));
        $ReturnData["ReqDll"] = \DB::select('exec spLogGetReqD ?',array( $ReturnData["Req"][0]->reqID));      //  dd($dll);
        return  $ReturnData ;
    }
    */
    public function spLogGetReqPrint($id,$anio )
    {
        $ReturnData["Usr"]=Auth::user()->usrID ;
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ',$anio, "  and reqid = '".$id."' " ));
        $ReturnData["ReqDll"] = \DB::select('exec spLogGetReqD ?',array(  $id ));
        $ReturnData["ReqAbsClasf"] = \DB::select('exec spLogGetReqAbsClasf ?',array(  $id ));
        $v = view("logistica.rptAdqReq",compact('ReturnData'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('horizontal')->setWarnings(false);
        return $pdf->stream();

    }
    public function spLogGetReqLR(Request $request)
    {
        $ReturnData = \DB::select('exec spLogGetReqLR ?,?,?', array(  $request->prAnio, $request->prPosition, $request->prCodReq ));
        return  $ReturnData ;
    }

    public function spLogSetPrePto(Request $request)
    {
        $idU = Auth::user()->usrID;
        $codReq = $request["datos"]["reqID"];                
        $varReturn["Msg"] = \DB::select('exec spLogGetPtoClasf ?,?,?,?,? ',    array( '2016' , $request["datos"]["reqSecFun"] , $request["datos"]["reqRubro"]  ,$request["lista"]["prodClasfCod"],$request["lista"]["prodTotal"]));
        return  $varReturn;
    }

}


/* if($request["datos"]["reqOPE"]=="UPD" || $request["datos"]["reqOPE"]=="DEL" || $request["datos"]["reqOPE"]=="TRH" )
        {
            if(!($request["datos"]["reqUsr"]==$idU )) {
                $Validar = array();
                array_push($Validar, array('ReqNo' => "NN", 'Error' => '1', 'Mensaje' => ' El requerimiento solo puede ser modificada por el usuario :' . $request["datos"]["reqUsr"]));
                return response()->json($Validar);
            }
        }*/