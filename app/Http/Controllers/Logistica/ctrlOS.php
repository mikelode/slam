<?php

namespace Logistica\Http\Controllers\Logistica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Exception;

class ctrlOS extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
    public  function fnGetViewOS()
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_OS'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                return view ('logistica.Adq.vwAdqOServ');
            }
            else
            {
                return view('logistica.Adq.vwPermission');
            }
        }
        else
        {
            return view('logistica.Adq.vwPermission');
        }


    }
    public function spLogGetOS (Request $prRqsOS) // use
    {
        try{

            $Doc = "Ods";
            $ReturnData["OS"] = \DB::select('exec spLogGetOS ?,?,?', array(  $prRqsOS->prRows, $prRqsOS->prAnio, $prRqsOS->prQry ));
            if(isset ($ReturnData["OS"][0]->osID)) {
                $result = \DB::select('exec spLogGetOSD ?', array($ReturnData["OS"][0]->osID));
                $ReturnData["OSDll"] = view('logistica.Partials.logOSDll', compact('result','Doc'))->render();
            }
            else{
                throw new Exception("El número de la Orden de Servicio ingresado no existe");
            }
            $ReturnData["Exp"] = \DB::select('exec spLogGetCSExpRow ?', array($ReturnData["OS"][0]->osID));
            $ReturnData["msg"] = 'OK encontrado OS';
            $ReturnData["msgId"] = 200;

        }catch (Exception $e){
            $ReturnData["msg"] = $e->getMessage();
            $ReturnData["msgId"] = 500;
        }

        return  $ReturnData ;
    }
    public function spLogSetOS(Request $prRqsOS)
    {
        try{

            $dbResult = null;
            $exception = DB::transaction(function () use($prRqsOS, &$dbResult){

                $dbResult = \DB::select('exec spLogSetOS ?,?,?,?,?  ,?,?,?,?,?  ,?,?,?,?,? ,?,?,?,?,? ,?,?',
                    array(
                        $prRqsOS["varOS"]["osOPE"],
                        $prRqsOS["varOS"]["osID"],
                        $prRqsOS["varOS"]["osAnio"],
                        $prRqsOS["varOS"]["osFecha"],
                        $prRqsOS["varOS"]["osTipoSrvID"],
                        $prRqsOS["varOS"]["osTipoProcID"],
                        $prRqsOS["varOS"]["osDepID"],
                        $prRqsOS["varOS"]["osRubroID"],
                        $prRqsOS["varOS"]["osSecFunID"],
                        $prRqsOS["varOS"]["osRuc"],
                        $prRqsOS["varOS"]["osPlazo"],
                        $prRqsOS["varOS"]["osGarantia"],
                        $prRqsOS["varOS"]["osIGV"],
                        $prRqsOS["varOS"]["osGlosa"],
                        $prRqsOS["varOS"]["osLugar"],
                        $prRqsOS["varOS"]["osRef"],
                        $prRqsOS["varOS"]["osObsv"],
                        $prRqsOS["varOS"]["osCondicion"],
                        $prRqsOS["varOS"]["osReqID"],
                        $prRqsOS["varOS"]["osCtzID"],
                        $prRqsOS["varOS"]["osCdrID"],
                        // $prRqsOS["varOS"]["osUsrID"]
                        Auth::user()->usrID
                    ));

                // if( $prRqsOS["varOS"]["osOPE"]=="ADD")
                // {
                $idos= $dbResult[0]->OSNo ;
                $ErrorDtll=array();

                if($idos=="NN") {
                    throw new Exception('Error al intentar registrar datos de la OC');
                    //return response()->json($dbResult);
                }
                if(  $prRqsOS["varOS"]["osOPE"]=="ADD" || $prRqsOS["varOS"]["FlgADD"]=="ADD"  )
                {
                    foreach ($prRqsOS["varOSDll"] as $key => $valor)
                    {
                        if($valor['rubro'] == 'NN' || $valor['secfun'] == 'NN')
                            throw new Exception("Debe ingresar el rubro o secuencia funcional del producto y validarlo con la tecla ENTER");

                        $dbResultDll = \DB::select('exec spLogSetOSD ?,?,?,?,?  ,?,?,?,?,?  ,?,?,?,?,?  ,?', array(
                            'ADD',
                            $idos ,
                            $valor["prod"],
                            $valor["und"],
                            $valor["clasf"],
                            $valor["cant"],
                            $valor["precio"],
                            $valor["marca"],
                            $valor["espf"],
                            $valor["osItm"],
                            $valor["cdItm"],
                            $valor["czItm"],
                            $valor["rqItm"] ,
                            Auth::user()->usrID,
                            $valor['secfun'],
                            $valor['rubro']
                        ));

                        if ($dbResultDll[0]->OSNo == "NN"){
                            array_push($ErrorDtll, array('OSNo' => $dbResultDll[0]->osNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                        }
                    }
                    if (count($ErrorDtll) > 0) {
                        throw new Exception(implode(', ', $ErrorDtll));
                        //return response()->json($ErrorDtll);
                    }
                }
                //  }
                //  return  response()->json ($dbResult );

            });

            if(is_null($exception)){
                $dbResult["msg"] = 'Registrado OK';
                $dbResult["msgId"] = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $dbResult["msg"] = $e->getMessage();
            $dbResult["msgId"] = 500;
        }

        return $dbResult;
    }

    public function spLogSetOSD(Request $prRqsOS) // use
    {
        try{
            $varReturn = null;
            $exception = DB::transaction(function () use($prRqsOS, &$varReturn){
                $Doc = "Ods";

                if($prRqsOS["varBns"]['prodSecfun'] == 'NN' || $prRqsOS['varBns']['prodRubro'] == 'NN')
                    throw new Exception("Debe ingresar el rubro o secuencia funcional del producto y validarlo con la tecla ENTER");

                $varReturn["varReturns"] = \DB::select('exec spLogSetOSD ?,?,?,?,?  ,?,?,?,?,? ,?,?,?,?,?  ,? ',array(
                    $prRqsOS["varBns"]["OPE"] ,
                    $prRqsOS["varBns"]["osID"] ,
                    $prRqsOS["varBns"]["prodID"]  ,
                    $prRqsOS["varBns"]["prodUndID"],
                    $prRqsOS["varBns"]["prodClasfID"],
                    $prRqsOS["varBns"]["prodCant"],
                    $prRqsOS["varBns"]["prodPrecio"],
                    $prRqsOS["varBns"]["prodMarca"],
                    $prRqsOS["varBns"]["prodEspf"],
                    $prRqsOS["varBns"]["osItm"],
                    $prRqsOS["varBns"]["cdItm"],
                    $prRqsOS["varBns"]["czItm"],
                    $prRqsOS["varBns"]["rqItm"] ,
                    Auth::user()->usrID,
                    $prRqsOS["varBns"]['prodSecfun'],
                    $prRqsOS['varBns']['prodRubro']
                ));

                $result = \DB::select('exec spLogGetOSD ?',array( $prRqsOS["varBns"]["osID"]));
                $varReturn["vwDll"] =  view ('logistica.Partials.logOSDll',compact( 'result','Doc'))->render();
            });

            if(is_null($exception)){
                $varReturn["msgId"] = 200;
                $varReturn["msg"] = 'OK guardado producto';
            }
            else{
                throw new Exception($exception);
            }
        }catch (Exception $e){
            $varReturn["msgId"] = 500;
            $varReturn["msg"] = $e->getMessage();
        }

        return  $varReturn;
    }
    public function spLogGetOSPrint($anio,$id )
    {
        $ReturnData["Usr"]=Auth::user()->usrID ;
        $ReturnData["OS"] = \DB::select('exec spLogGetOS ?,?,?', array(  ' top 1 ',$anio, " and osid = '".$id."' " ));
       
        if ($ReturnData["OS"][0]->osEtapa =="RESERVADO") 
        {           
            $v = view("logistica.rptAdqOSrvRv",compact('ReturnData'))->render();
         }
        else
        {
             $ReturnData["OSDll"] = \DB::select('exec spLogGetOSD ?',array(  $id ));
        $ReturnData["OSAbsClasf"] = \DB::select('exec spLogGetOSAbsClasf ?',array(  $id ));
        $ReturnData["RUC"] = \DB::select('exec spLogGetRuc ?',array(  " where ruc='".$ReturnData["OS"][0]->osRUC ."'" ));
        $ReturnData["SIAF"] = \DB::select('exec spLogGetCSExp ?',array($id));
            $v = view("logistica.rptAdqOSrv",compact('ReturnData'))->render();
        }

        $pdf=\App::make('dompdf.wrapper');        
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('portrait');
        return $pdf->stream();

        //$pdf->loadHTML($v)->setPaper('a4')->setOrientation('horizontal')->setWarnings(false);
        //$pdf->loadHTML($v)->setPaper('letter')->setOrientation('landscape');
    }

    public function spLogGetReq(Request $prRqsOS)    // use
    {
        try{
            $Doc="Req";
            $ReturnData["Req"] = \DB::select('exec spLogGetReqTmp ?,?,?', array(  $prRqsOS->prRows, $prRqsOS->prAnio, $prRqsOS->prQry ));

            if(isset ($ReturnData["Req"][0]->reqID)) {
                $result = \DB::select('exec spLogGetReqD ?',array(  $ReturnData["Req"][0]->reqID));      //  dd($dll);
                $ReturnData["OsDll"] =   view ('logistica.Partials.logOSDll',compact('result','Doc'))->render();
            }
            else{
                throw new Exception("El número de Requerimiento ingresado no existe");
            }

            $ReturnData["msgId"] = 200;
            $ReturnData["msg"] = 'OK REQ recuperado';
        }catch (Exception $e){
            $ReturnData["msgId"] = 500;
            $ReturnData["msg"] = $e->getMessage();
        }

        return $ReturnData;
    }
    public function spLogGetOSLR(Request $request) // use
    {
        $ReturnData = \DB::select('exec spLogGetOSLR ?,?,?', array(  $request->prAnio, $request->prPosition, $request->prCodOS ));
        return  $ReturnData ;
    }
    public function spLogGetOSSearch(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetOSSearch ?,? ',   array("2016"," order by osID desc "));
        return   view ('logistica.Partials.logOSSearch',compact( 'result'))->render();;
    }
    public function spLogSetOSBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select('exec spLogSetOSBusy ?,?',   array($request->Anio, Auth::user()->usrID));
        return  $result;
    }
    public  function fnGetViewTableOSNull(Request $prRqsOS) // use
    { 
        $Doc = "Null";
        $result="";
        return view ('logistica.Partials.logOSDll',compact('result', 'Doc'))->render();       
    }

    public function spLogSetOSDDel(Request $prRqsOS)
    {
        try{
            $varReturn = null;
            $exception = DB::transaction(function () use ($prRqsOS, &$varReturn){
                $Doc = "Ods";
                $varReturn["varReturns"] = \DB::select('exec spLogSetOsDDel ?',  array( $prRqsOS->osID));

                $result = \DB::select('exec spLogGetOSD ?',array( $prRqsOS->osID));
                $varReturn["OsDll"] =  view ('logistica.Partials.logOSDll',compact( 'result','Doc'))->render();
            });

            if(is_null($exception)){
                $varReturn["msg"] = 'OK DEL';
                $varReturn["msgId"] = 200;
            }
            else{
                throw new Exception($exception);
            }
        }catch (Exception $e){
            $varReturn["msg"] = $e->getMessage();
            $varReturn["msgId"] = 500;
        }

        return  $varReturn;
    }

    /******/

    public function spLogGetOS_CCVal(Request $prRqsCC)    // use
    {
        try{

            $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array($prRqsCC->prRows, $prRqsCC->prAnio, $prRqsCC->prQry));

            if(count( $varReturn["CC"])>0) {
                $Doc="Cdr";

                $result = \DB::select('exec spLogGetFte ?,?,?,?', array('NO', '', $varReturn["CC"][0]->cdrID, 'P'));
                $varReturn["Fts"] = view('logistica.Partials.logCdrRucList', compact('result'))->render();
                $Ftes["Fte"] = \DB::select('exec spLogGetFte ?,?,?,?', array(
                    'SI',
                    $varReturn["CC"][0]->cdrOrg,
                    $varReturn["CC"][0]->cdrOrgID,
                    'P'
                ));

                if(isset( $Ftes["Fte"][0]->fteID))
                    $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj', ["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'Eje'=>$varReturn["CC"][0]->cdrEjecucion,'Ent'=>$varReturn["CC"][0]->cdrEntrega,'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();
                else
                    $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj',compact('result') )->render();

                $varReturn["AdjDll"] =$Ftes["Fte"];

                if(count($varReturn["AdjDll"]) == 0){
                    throw new Exception("No se ha determinado el proveedor con BUENA PRO en el Cuadro Comparativo: ".$varReturn["CC"][0]->cdrID);
                }

                $tmpQry="";

                if (  $varReturn["CC"][0]->cdrOrgDoc =="CZ") {
                    $tmpQry=" and reqCtzID =  '".$varReturn["CC"][0]->cdrOrgID."'" ;
                    $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, $tmpQry  ));
                }
                else if (  $varReturn["CC"][0]->cdrOrgDoc =="RQ") {
                    $tmpQry=" and reqID =   '".$varReturn["CC"][0]->cdrOrgID."'" ;
                    $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, $tmpQry  ));
                }
                else{   $varReturn["Req"]=null ;}

                $result = \DB::select('exec spLogGetFteD ?',array( $varReturn["CC"][0]->cdrOrg));
                $varReturn["OsDll"] = view ('logistica.Partials.logOSDll',compact( 'result','Doc'))->render();

            }
            else{
                $varReturn["Fts"]= null;
                $varReturn["Adj"]= null;
                throw new Exception("No existe el Cuadro Comparativo ingresado");
            }

            $varReturn["msgId"] = 200;
            $varReturn["msg"] = 'OK Cdr Recuperado';

        }catch (Exception $e){

            $varReturn["msgId"] = 500;
            $varReturn["msg"] = $e->getMessage();

        }

        return $varReturn;
    }


}
