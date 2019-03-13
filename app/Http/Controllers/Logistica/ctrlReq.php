<?php

namespace Logistica\Http\Controllers\Logistica;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Logistica\Almacen\almTLogReq;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\User;
use Exception;
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
        try{

            $result = null;

            $exception = DB::transaction(function () use($request, &$result){

                $varOpe = $request["datos"]["reqOPE"];
                $ErrorDtll=array();
                $idU = Auth::user()->usrID;
                $flg = false;
                if( !($varOpe=="TRH" || $varOpe=="DEL" )) {
                    foreach ($request["lista"] as $key => $valor) {    $flg = true;    }
                    if (!$flg) {
                        array_push($ErrorDtll, array('ReqNo' => 'NN', 'Error' => '1', 'Mensaje' => ' Falta los Detalles del Requerimiento'));
                        throw new Exception("Faltan los detalles del Requerimiento");
                        //return response()->json($ErrorDtll);
                    }
                }


                /* obtenemos la data del req que se esta editando */
                if( $varOpe == 'UPD' ){

                    $reqCurrent = almTLogReq::find($request["datos"]["reqID"]);
                    $flagUpdateRbs = 0;
                    $flagUpdateSfs = 0;

                    if($reqCurrent->reqRubro != $request["datos"]["reqRubro"]){
                        $flagUpdateRbs = 1;
                    }

                    if($reqCurrent->reqSecFun != $request["datos"]["reqSecFun"]){
                        $flagUpdateSfs = 1;
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
                    throw new Exception($idMsg);
                    //return response()->json($Validar);
                }

                if( $varOpe=="ADD")
                {
                    $idReq = $result[0]->ReqNo ;
                    $ErrorDtll =array();
                    if($idReq=="NN") {
                        //return response()->json($result);
                        throw new Exception("No se realizo la operación correctamente");
                    }
                    foreach ($request["lista"] as $key => $valor)
                    {
                        $dllSecfun = substr($request["datos"]["reqSecFun"],-1) == 'M' ? $valor['secfun'] : $request["datos"]["reqSecFun"];
                        $dllRubro = substr($request["datos"]["reqSecFun"],-1) == 'M' ? $valor['rubro'] : $request["datos"]["reqRubro"];

                        $resultDetalles = \DB::select('exec spLogSetReqD ?,?,?,?,?  ,?,?,?,?,? ,?,?',
                            array(
                                $varOpe,
                                0  ,
                                $idReq  ,
                                $valor["prod"],
                                $valor["und"],
                                $valor["clasf"],
                                $valor["cant"],
                                $valor["precioUnt"],
                                $valor["espf"],
                                Auth::user()->usrID,
                                $dllSecfun,
                                $dllRubro
                            ));
                        if ($resultDetalles[0]->ReqNo == "NN")
                        {
                            array_push($ErrorDtll, array('ReqNo' => $resultDetalles[0]->ReqNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                        }
                    }
                    if (count($ErrorDtll) > 0){
                        throw new Exception("Atención: " . implode(", ", $ErrorDtll));
                        //return response()->json($ErrorDtll);
                    }
                }

                if($varOpe == "UPD"){

                    if($flagUpdateRbs){

                        DB::table('TLogReqD')
                            ->where('rdtCodReq',$request["datos"]["reqID"])
                            ->update(['rdtRubro' => $request["datos"]["reqRubro"]]);

                    }

                    if($flagUpdateSfs){

                        if(substr($request["datos"]["reqSecFun"],-1) != 'M'){
                            DB::table('TLogReqD')
                                ->where('rdtCodReq',$request["datos"]["reqID"])
                                ->update(['rdtSecFun' => $request["datos"]["reqSecFun"]]);
                        }
                    }

                }

            });

            if(is_null($exception)){
                $msg = "OK";
                $msgId = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $result = null;
        }


        return  response()->json(compact('msg','msgId','result'));
    }
    public function spLogSetReqD(Request $request)  // USE
    {
        $idU = Auth::user()->usrID;

        try{

            $varReturn = null;

            $exception = DB::transaction(function () use($request, &$varReturn){

                $dllSecfun = substr($request["datos"]["reqSecFun"],-1) == 'M' ? $request["lista"]["prodSfID"] : $request["datos"]["reqSecFun"];
                $dllRubro = substr($request["datos"]["reqSecFun"],-1) == 'M' ? $request["lista"]["prodRubroID"] : $request["datos"]["reqRubro"];

                $codReq = $request["datos"]["reqID"];
                $varReturn["Msg"] = \DB::select('exec spLogSetReqD ?,?,?,?,?  ,?,?,?,?,? ,?,?',
                    array(
                        $request["lista"]["OPE"] ,
                        $request["lista"]["ID"]  ,
                        $codReq  ,
                        $request["lista"]["prodID"],
                        $request["lista"]["prodUndID"],
                        $request["lista"]["prodClasfID"],
                        $request["lista"]["prodCant"],
                        $request["lista"]["prodPrecioUnt"],
                        $request["lista"]["prodEspf"],
                        Auth::user()->usrID,
                        $dllSecfun,
                        $dllRubro
                    ));

                $result = \DB::select('exec spLogGetReqD ?',array( $codReq));
                $secfun = $request["datos"]["reqSecFun"];
                $varReturn["ReqDll"] =  view ('logistica.Partials.logReqDll',compact( 'result','secfun'))->render();

            });

            if(is_null($exception)){
                $msg = "OK";
                $msgId = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $varReturn = null;
        }

        return response()->json(compact('msg','msgId','varReturn'));
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
            $secfun = $ReturnData["Req"][0]->reqSecFunCod;
            $ReturnData["ReqDll"] = view('logistica.Partials.logReqDll', compact('result','secfun'))->render();
        }

        return  $ReturnData ;
    }

     public function spLogGetReqTmpII(Request $request) /* USE */
    {
        try{

            $ReturnData["Req"] = \DB::select('exec spLogGetReqTmp ?,?,?', array(  $request->prRows, $request->prAnio, $request->prQry ));
            if(isset ($ReturnData["Req"][0]->reqID)) {
                $result = \DB::select('exec spLogGetReqD ?', array($ReturnData["Req"][0]->reqID));      //  dd($dll);
                $secfun = $ReturnData["Req"][0]->reqSecFunCod;
                $ReturnData["ReqDll"] = view('logistica.Partials.logReqDll', compact('result','secfun'))->render();
            }
            else{
                throw new Exception("No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo");
            }

            $msg = 'OK';
            $msgId = 200;
        }catch (Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $ReturnData = null;
        }

        return response()->json(compact('msg','msgId','ReturnData'));
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
    public function spLogGetReqLR(Request $request) /* USE */
    {
        try{

            $ReturnData = \DB::select('exec spLogGetReqLR ?,?,?', array(  $request->prAnio, $request->prPosition, $request->prCodReq ));
            $msgId = 200;
            $msg = 'OK';

            if($ReturnData[0]->ID == 'NN'){
                throw new Exception("No se encontro ningun registro con el valor ingresado <br> Vuelva a intentarlo ");
            }

        }catch(Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $ReturnData = null;
        }

        return response()->json(compact('msgId','msg','ReturnData'));
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