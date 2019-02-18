<?php

namespace Logistica\Http\Controllers\Logistica;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Logistica\Almacen\almTLogCtz;
use Logistica\Almacen\almTLogReq;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use PhpParser\Node\Expr\Array_;
use  Barryvdh\DomPDF;

class ctrlCtz extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
    public  function fnGetViewCtz()
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_CZ'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                return view ('logistica.Adq.vwAdqCtz');
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
    public function spLogSetCtz(Request $prRqsCtz)
    {
        try{

            $dbResult = [];

            $exception = DB::transaction(function () use($prRqsCtz, &$dbResult){

                $dbResult = \DB::select('exec spLogSetCtz ?,?,?,?,?  ,?,?,?,?,?  ,?,?,?',
                    array(
                        $prRqsCtz["varCtz"]["ctzOPE"],
                        $prRqsCtz["varCtz"]["ctzAnio"],
                        $prRqsCtz["varCtz"]["ctzFecha"],
                        $prRqsCtz["varCtz"]["ctzID"],
                        $prRqsCtz["varCtz"]["ctzReqID"],
                        $prRqsCtz["varCtz"]["ctzDep"],
                        $prRqsCtz["varCtz"]["ctzSecFun"],
                        $prRqsCtz["varCtz"]["ctzGlosa"],
                        $prRqsCtz["varCtz"]["ctzLugarEnt"],
                        $prRqsCtz["varCtz"]["ctzOrgDoc"],
                        $prRqsCtz["varCtz"]["ctzRef"],
                        $prRqsCtz["varCtz"]["ctzObsv"],
                        Auth::user()->usrID
                    ));

                $idCtz= $dbResult[0]->CtzNo ;
                $ErrorDtll=array();
                if($idCtz=="NN") {
                    throw new Exception($dbResult[0]->Mensaje);
                    //return response()->json($dbResult);
                }

                if(  $prRqsCtz["varCtz"]["ctzOPE"]=="ADD" || $prRqsCtz["varCtz"]["ctzOPE"]=="UPD" )
                {
                    foreach ($prRqsCtz["varCtzDll"] as $key => $valor)
                    {
                        $dbResultDll = \DB::select('exec spLogSetCtzD ?,?,?,?,?  ,?,?,?,?,? ,?,?',
                            array(
                                'ADD',
                                $prRqsCtz["varCtz"]["ctzReqID"],
                                $valor["czItm"] , $valor["rqItm"]  ,
                                $idCtz  ,
                                $valor["prod"],
                                $valor["und"],
                                $valor["cant"],
                                $valor["espf"],
                                Auth::user()->usrID,
                                $valor['secfun'],
                                $valor['rubro']
                            ));

                        if ($dbResultDll[0]->CtzNo == "NN"){
                            array_push($ErrorDtll, array('CtzNo' => $dbResultDll[0]->CtzNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                        }
                    }
                    if (count($ErrorDtll) > 0) {
                        throw new Exception(implode(", ", $ErrorDtll));
                        //return response()->json($ErrorDtll);
                    }
                }
            });

            if(is_null($exception)){
                $dbResult[0]->msg = "Registrado correctamente la cotización";
                $dbResult[0]->msgId = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $dbResult[0]->msg = "Error: " . $e->getMessage();
            $dbResult[0]->msgId = 500;
        }

        return  response()->json($dbResult);
    }
    public function spLogSetCtzD(Request $prRqsCtz)
    {
        try{

            $varReturn = [];

            $exception = DB::transaction(function() use($prRqsCtz, &$varReturn){

                $codCtz = $prRqsCtz["varCtz"]["ctzID"];
                $varReturn["Flg"]="1";
                $qry = \DB::select('exec spLogSetCtzD ?,?,?,?,?  ,?,?,?,?,? ,?,?',
                    array(
                        $prRqsCtz["varCtzDll"]["OPE"] ,
                        $prRqsCtz["varCtz"]["ctzReqID"] ,
                        $prRqsCtz["varCtzDll"]["czItm"] ,
                        $prRqsCtz["varCtzDll"]["rqItm"]  ,
                        $codCtz  ,
                        $prRqsCtz["varCtzDll"]["prodID"],
                        $prRqsCtz["varCtzDll"]["prodUndID"],
                        $prRqsCtz["varCtzDll"]["prodCant"],
                        $prRqsCtz["varCtzDll"]["prodEspf"],
                        Auth::user()->usrID,
                        $prRqsCtz["varCtzDll"]["prodSecfun"],
                        $prRqsCtz["varCtzDll"]["prodRubro"]
                    ));
                if ($qry[0]->Error=="0") { $varReturn["Flg"]=$qry[0]->Mensaje;}
                $result = \DB::select('exec spLogGetCtzD ?',array( $codCtz));
                $varReturn["CtzDll"] =  view ('logistica.Partials.logCtzDll',compact( 'result'))->render();

            });

            if(is_null($exception)){
                $varReturn['msg'] = "Producto de la cotización registrada correctamente";
                $varReturn['msgId'] = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $varReturn['msg'] = "Error: " . $e->getMessage();
            $varReturn['msgId'] = 500;
        }

        return  $varReturn;
    }
    public function spLogGetCtzReq(Request $request)
    {
        $reqID = 'RQ' . substr($request->prAnio, 2,2) . substr('0000000' . $request->val,-7);

        $ctz = almTLogCtz::where('ctzCodReq',$reqID)->get();

        if($request->attempt == 0){
            if($ctz->count() > 0){
                $msg = 'ATENCIÓN: EL REQUERIMIENTO YA TIENE COTIZACIÓN NRO: ' .substr($ctz[0]->ctzID, -5) ;
                $msgId = '500';
                return response()->json(compact('msg','msgId'));
            }
        }

        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  $request->prRows, $request->prAnio, $request->prQry ));
        $result = \DB::select('exec spLogGetReqD ?',array(  $ReturnData["Req"][0]->reqID));      //  dd($dll);
        $ReturnData["ReqDll"] =   view ('logistica.Partials.logCtzDll',compact('result'))->render();
        return  $ReturnData ;
    }

   /* public function spLogGetCtz (Request $prRqsCtz)
    {
        $ReturnData["Ctz"] = \DB::select('exec spLogGetCtz ?,?,?', array(  $prRqsCtz->prRows, $prRqsCtz->prAnio, $prRqsCtz->prQry ));
        $result = \DB::select('exec spLogGetCtzD ?',array(  $ReturnData["Ctz"][0]->ctzID));      //  dd($dll);
        $ReturnData["CtzDll"] =   view ('logistica.Partials.logCtzDll',compact('result'))->render();
        return  $ReturnData ;
    }*/

   /* public function spLogGetCtz (Request $prRqsCtz)
    {
        $ReturnData["Ctz"] = \DB::select('exec spLogGetCtz ?,?,?', array(  $prRqsCtz->prRows, $prRqsCtz->prAnio, $prRqsCtz->prQry ));
        //$result = \DB::select('exec spLogGetCtzD ?',array(  $ReturnData["Ctz"][0]->ctzID));      //  dd($dll);
        //$ReturnData["CtzDll"] =   view ('logistica.Partials.logCtzDll',compact('result'))->render();
        return  $ReturnData;
    }
*/
    public function spLogGetCtz (Request $prRqsCtz)
    {
        $ReturnData["Ctz"] = \DB::select('exec spLogGetCtz ?,?,?', array(  $prRqsCtz->prRows, $prRqsCtz->prAnio, $prRqsCtz->prQry ));
        if(isset ($ReturnData["Ctz"][0]->ctzID)) {
            $result = \DB::select('exec spLogGetCtzD ?', array($ReturnData["Ctz"][0]->ctzID));
            $ReturnData["CtzDll"] = view('logistica.Partials.logCtzDll', compact('result'))->render();
        }
        return  $ReturnData ;
    }

    public function spLogGetCtzPrint($id , $anio )
    {
        $ReturnData["Usr"]=Auth::user()->usrID ;
        $ReturnData["Ctz"] = \DB::select('exec spLogGetCtz ?,?,?', array(  ' top 1 ',$anio, " and ctzid = '".$id."' " ));
        $ReturnData["CtzDll"] = \DB::select('exec spLogGetCtzD ?',array(  $id ));
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ',$anio, " AND reqid = '". $ReturnData["Ctz"][0]->ctzReqID."' " ));
        $ReturnData["ReqAbsClasf"] = \DB::select('exec spLogGetReqAbsClasf ?',array(  $ReturnData["Ctz"][0]->ctzReqID ));
        $v = view("logistica.rptAdqCtz",compact('ReturnData'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('horizontal')->setWarnings(false);
        return $pdf->stream();
    }

    public function spLogGetCtzLR(Request $request)
    {
        $ReturnData = \DB::select('exec spLogGetCtzLR ?,?,?', array(  $request->prAnio, $request->prPosition, $request->prCodCtz ));
        return  $ReturnData ;
    }
    public function spLogGetCtzSearch(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetCtzSearch ?,? ',   array("2016"," order by ctzID desc "));
        return   view ('logistica.Partials.logCtzSearch',compact( 'result'))->render();;
    }
    public function spLogSetCtzBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select('exec spLogSetCtzBusy ?,?',   array($request->Anio, Auth::user()->usrID));
        return  $result;
    }
}
