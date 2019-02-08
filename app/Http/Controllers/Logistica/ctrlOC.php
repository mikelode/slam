<?php

namespace Logistica\Http\Controllers\Logistica;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

class ctrlOC extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
    public  function fnGetViewOC()
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_OC'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                return view ('logistica.Adq.vwAdqOCom');
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
    public function spLogGetOC (Request $prRqsOC)
    {  $Doc = "Odc";
        $ReturnData["OC"] = \DB::select('exec spLogGetOC ?,?,?', array(  $prRqsOC->prRows, $prRqsOC->prAnio, $prRqsOC->prQry ));
        if(isset ($ReturnData["OC"][0]->ocID)) {
            $result = \DB::select('exec spLogGetOCD ?', array($ReturnData["OC"][0]->ocID));
            $ReturnData["OCDll"] = view('logistica.Partials.logOCDll', compact('result',"Doc"))->render();
        }
         $ReturnData["Exp"] = \DB::select('exec spLogGetCSExpRow ?', array($ReturnData["OC"][0]->ocID));
        return  $ReturnData ;
    }

     public function spLogGetOCTmp (Request $prRqsOC)
    {  $Doc = "Odc";
        $ReturnData["OC"] = \DB::select('exec spLogGetOCTmp ?,?,?', array(  $prRqsOC->prRows, $prRqsOC->prAnio, $prRqsOC->prQry ));
        if(isset ($ReturnData["OC"][0]->ocID)) {
            $result = \DB::select('exec spLogGetOCD ?', array($ReturnData["OC"][0]->ocID));
            $ReturnData["OCDll"] = view('logistica.Partials.logOCDll', compact('result',"Doc"))->render();
        }
         $ReturnData["Exp"] = \DB::select('exec spLogGetCSExpRow ?', array($ReturnData["OC"][0]->ocID));
        return  $ReturnData ;
    }


    public function spLogSetOC(Request $prRqsOC)
    {
        //sleep(1);
        try{

            $dbResult = null;

            $exception = DB::transaction(function() use($prRqsOC, &$dbResult){

                $dbResult = \DB::select('exec spLogSetOC ?,?,?,?,?  ,?,?,?,?,?  ,?,?,?,?,? ,?,?,?,?,?  ,?   ,?,?,?,?',
                    array(
                        $prRqsOC["varOC"]["ocOPE"],
                        $prRqsOC["varOC"]["ocID"],
                        $prRqsOC["varOC"]["ocAnio"],
                        $prRqsOC["varOC"]["ocFecha"],
                        $prRqsOC["varOC"]["ocTipoProcID"],
                        $prRqsOC["varOC"]["ocDepID"],
                        $prRqsOC["varOC"]["ocRubroID"],
                        $prRqsOC["varOC"]["ocSecFunID"],
                        $prRqsOC["varOC"]["ocRuc"],
                        $prRqsOC["varOC"]["ocPlazo"],
                        $prRqsOC["varOC"]["ocGarantia"],
                        $prRqsOC["varOC"]["ocIGV"],
                        $prRqsOC["varOC"]["ocGlosa"],
                        $prRqsOC["varOC"]["ocLugar"],
                        $prRqsOC["varOC"]["ocRef"],
                        $prRqsOC["varOC"]["ocObsv"],
                        $prRqsOC["varOC"]["ocCondicion"],

                        $prRqsOC["varOC"]["ocSubTotal"],
                        $prRqsOC["varOC"]["ocDescuento"],
                        $prRqsOC["varOC"]["ocEnvio"],
                        $prRqsOC["varOC"]["ocTotal"],

                        $prRqsOC["varOC"]["ocReqID"],
                        $prRqsOC["varOC"]["ocCtzID"],
                        $prRqsOC["varOC"]["ocCdrID"],
                        //$prRqsOC["varOC"]["ocUsrID"]
                        Auth::user()->usrID
                    ));


                // if( $prRqsOC["varOC"]["ocOPE"]=="ADD")
                // {
                // dd($prRqsOC["varOCDll"]);
                $idOC= $dbResult[0]->OCNo ;
                $ErrorDtll=array();
                if($idOC=="NN") {
                    throw new Exception('Error al intentar registrar datos de la OC');
                    //return response()->json($dbResult);
                }
                if(  $prRqsOC["varOC"]["ocOPE"]=="ADD" || $prRqsOC["varOC"]["FlgADD"]=="ADD"  )
                {
                    foreach ($prRqsOC["varOCDll"] as $key => $valor)
                    {
                        $dbResultDll = \DB::select('exec spLogSetOCD ?,?,?,?,?  ,?,?,?,?,?  ,?,?,?,?,? ,?,?,? ', array( 'ADD',$idOC , $valor["prod"], $valor["und"], $valor["clasf"],$valor["cant"],$valor["precio"],$valor["marca"],$valor["espf"],$valor["ocItm"], $valor["cdItm"]  ,$valor["czItm"],$valor["rqItm"],  Auth::user()->usrID , $valor["envio"]  ,$valor["secFun"], $valor['secfund'], $valor['rubro'] ));
                        if ($dbResultDll[0]->OCNo == "NN")
                        {
                            throw new Exception(' NO se registro : ' . $valor["prod"]);
                            array_push($ErrorDtll, array('OCNo' => $dbResultDll[0]->OCNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                        }
                    }
                    if (count($ErrorDtll) > 0) {
                        throw new Exception('Error al registrar los productos');
                        //return response()->json($ErrorDtll);
                    }
                }
                // }
                //        return  response()->json ($dbResult );

            });

            if(!is_null($exception))
                throw new Exception($exception);

        }catch(Exception $e){

            $dbResult[0] = array('OCNo' => 'NN', 'Error' => '1', 'Mensaje' => ' Error al intentar guardar la OC : ' . $e->getMessage());

        }

        return $dbResult;
    }
    public function spLogSetOCD(Request $prRqsOC)
    {
        $Doc = "Odc" ;
        $varReturn["varReturns"] = \DB::select('exec spLogSetOCD ?,?,?,?,?  ,?,?,?,?,? ,?,?,?,?,? ,?,?,? ',
            array(
                $prRqsOC["varBns"]["OPE"] ,
                $prRqsOC["varBns"]["OCID"] ,
                $prRqsOC["varBns"]["prodID"]  ,
                $prRqsOC["varBns"]["prodUndID"],
                $prRqsOC["varBns"]["prodClasfID"],
                $prRqsOC["varBns"]["prodCant"],
                $prRqsOC["varBns"]["prodPrecio"],
                $prRqsOC["varBns"]["prodMarca"],
                $prRqsOC["varBns"]["prodEspf"],
                $prRqsOC["varBns"]["ocItm"],
                $prRqsOC["varBns"]["cdItm"],
                $prRqsOC["varBns"]["czItm"],
                $prRqsOC["varBns"]["rqItm"],
                Auth::user()->usrID ,
                0,
                $prRqsOC["varBns"]["prodSecFun"],
                $prRqsOC["varBns"]["prodsf"],
                $prRqsOC["varBns"]["prodrubro"]
            ));
        $result = \DB::select('exec spLogGetOCD ?',array( $prRqsOC["varBns"]["OCID"]));
        $varReturn["vwDll"] =  view ('logistica.Partials.logOCDll',compact( 'result','Doc'))->render();
        return  $varReturn;
    }
	
	 public function spLogSetOCDDel(Request $prRqsOC)
    {
        $Doc = "Odc" ;
        $varReturn["varReturns"] = \DB::select('exec spLogSetOCDDel ?',  array( $prRqsOC->ocID));        
        $result = \DB::select('exec spLogGetOCD ?',array( $prRqsOC->ocID));
        $varReturn["vwDll"] =  view ('logistica.Partials.logOCDll',compact( 'result', 'Doc'))->render();
        return  $varReturn;
    }


    public function spLogGetOCPrint($anio,$id )
    {
        $ReturnData["Usr"]=Auth::user()->usrID ;
        $ReturnData["OC"] = \DB::select('exec spLogGetOC ?,?,?', array(  ' top 1 ',$anio, " and ocid = '".$id."' " ));

        $txtcondicion = trim(str_replace('</p>', '</p>|',$ReturnData["OC"][0]->ocCondicion));

        if (count(explode('|',$txtcondicion)) == 1){
            $txtcondicion = trim(str_replace('<br>', '<br>|',$ReturnData["OC"][0]->ocCondicion));
        }
        $txtcondicion = explode('|',$txtcondicion);

//        dd($txtcondicion);
        
        if($ReturnData["OC"][0]->ocEtapa =="RESERVADO")
        {
            $v = view("logistica.rptAdqOComRv",compact('ReturnData'))->render();
        }
        else
        {
            $ReturnData["OCDll"] = \DB::select('exec spLogGetOCD ?',array(  $id ));

            $ReturnData["prCant"] = \DB::select('exec spLogGetOCSub  ?,?',array('CANT',  $id ));
                if ($ReturnData["prCant"][0]->Cant>1)
                {
                    $ReturnData["prSum"] = \DB::select('exec spLogGetOCSub  ?,?',array('SUM',  $id ));
                    $ReturnData["prSecFun"] = \DB::select('exec spLogGetOCSub  ?,?',array('SFUN',  $id ));
                }

            $ReturnData["OCAbsClasf"] = \DB::select('exec spLogGetOCAbsClasf ?',array(  $id ));
            $ReturnData["RUC"] = \DB::select('exec spLogGetRuc ?',array(  " where ruc='".$ReturnData["OC"][0]->ocRUC ."'" ));
            $ReturnData["SIAF"] = \DB::select('exec spLogGetCSExp ?',array($id));

            $v = view("logistica.rptAdqOCom",compact('ReturnData','txtcondicion'))->render();
        }

        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('portrait')->setWarnings(false);
        return $pdf->stream();
    }

    /*public function spLogGetReq(Request $prRqsOC)    {
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  $prRqsOC->prRows, $prRqsOC->prAnio, $prRqsOC->prQry ));
        $req = \DB::select('exec spLogGetReqD ?',array(  $ReturnData["Req"][0]->reqID));      //  dd($dll);
		
        $ReturnData["vwDll"] =   view ('logistica.Partials.logOCDll',compact('req'))->render();
        $ReturnData["Ref"]  = \DB::connection('dblogistica') -> select(' exec spLogGetReqSg ?,?,?,?,?,?',   array('','','','',''," and  RQ.reqID ='".$ReturnData["Req"][0]->reqID."'"));
        return $ReturnData;
    }
    */

     public function spLogGetReq(Request $prRqsOC)
    {
        $Doc = "Req";
        $ReturnData["Req"] = \DB::select('exec spLogGetReqTmp ?,?,?', array(   $prRqsOC->prRows, $prRqsOC->prAnio, $prRqsOC->prQry ));
        if(isset ($ReturnData["Req"][0]->reqID)) {
            $result = \DB::select('exec spLogGetReqD ?', array($ReturnData["Req"][0]->reqID));      //  dd($dll);
            $reqTmpID=$ReturnData["Req"][0]->reqSecFunID ;
            $ReturnData["vwDll"] = view('logistica.Partials.logOCDll', compact('result',"Doc",'reqTmpID'))->render();
        }
        return  $ReturnData ;
    }

    public function spPrueba($id )
    {


        $v = view("logistica.rpt",compact('id'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('horizontal')->setWarnings(false);
        return $pdf->stream();
    }


    public function spLogGetOCLR(Request $request)
    {
        $ReturnData = \DB::select('exec spLogGetOCLR ?,?,?', array(  $request->prAnio, $request->prPosition, $request->prCodOC ));
        return  $ReturnData ;
    }

    public function spLogGetOCSearch(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetOCSearch ?,? ',   array("2016"," order by ocID desc "));
        return   view ('logistica.Partials.logOCSearch',compact( 'result'))->render();;
    }
    public function spLogSetOCBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select('exec spLogSetOCBusy ?,?',   array($request->Anio, Auth::user()->usrID));
        return  $result;
    }
	
	 public  function fnGetViewCatalogoOC()
    {

        return view ('logistica.Partials.logCatalogo');
    }

	 public function spLogSetOcDClear(Request $prRqsOC)
    {
        $dbResult = \DB::select('exec spLogSetOcDClear ?,?',
            array(
                $prRqsOC["varOC"]["ocID"],                             
                Auth::user()->usrID
            ));
      
        $ErrorDtll=array();
        
        foreach ($prRqsOC["varOCDll"] as $key => $valor)
        {
            $dbResultDll = \DB::select('exec spLogSetOCD ?,?,?,?,?  ,?,?,?,?,?  ,? ,?', array( 'ADD',$idOC , $valor["prod"], $valor["und"], $valor["clasf"],$valor["cant"],$valor["precio"],$valor["marca"],$valor["espf"],$valor["ID"],  Auth::user()->usrID ));
            if ($dbResultDll[0]->OCNo == "NN")    {    array_push($ErrorDtll, array('OCNo' => $dbResultDll[0]->OCNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"])); }
        }
        if (count($ErrorDtll) > 0) {    return response()->json($ErrorDtll);      }
        
		$result = \DB::select('exec spLogGetOCD ?',array( $prRqsOC["varBns"]["OCID"]));	
		$ReturnData["OCDll"] = view('logistica.Partials.logOCDll', compact('result'))->render();
        return $$ReturnData;
    }
	
	public  function fnGetViewTableNull(Request $prRqsOC)
    { 
	   
       $Doc = "Null";
	   $result="";
	   return view ('logistica.Partials.logOCDll',compact('result','Doc'))->render();	  
    }
	
	 public function spLogSetOCIgv(Request $prRqsOC)
    {
        $result = \DB::select('exec spLogSetOCIgv ?',array( $prRqsOC->varOC));	
		//$result = \DB::select('exec spLogGetOCD ?',array( $prRqsOC->varOC));	
		$ReturnData["vwDll"] = view('logistica.Partials.logOCDll', compact('result'))->render();
        return  $ReturnData;
    }
	

     public function spLogGetOC_CCVal(Request $prRqsCC)    {
            $reqTmpID="";
            $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array($prRqsCC->prRows, $prRqsCC->prAnio, $prRqsCC->prQry));
            if(  count( $varReturn["CC"])>0) 
            {
                 $Doc="Cdr";                 
                 $result = \DB::select('exec spLogGetFte ?,?,?,?', array('NO', '', $varReturn["CC"][0]->cdrID, 'P'));          
                 $varReturn["Fts"] = view('logistica.Partials.logCdrRucList', compact('result'))->render();
                 $Ftes["Fte"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $varReturn["CC"][0]->cdrOrg, $varReturn["CC"][0]->cdrOrgID, 'P'));

                 if(isset( $Ftes["Fte"][0]->fteID))
                    $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj', ["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'Eje'=>$varReturn["CC"][0]->cdrEjecucion,'Ent'=>$varReturn["CC"][0]->cdrEntrega,'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();
                 else
                    $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj',compact('result') )->render();

                 $varReturn["AdjDll"] =$Ftes["Fte"];
                 $tmpQry="";
                 if (  $varReturn["CC"][0]->cdrOrgDoc =="CZ") 
                 {  
                    $tmpQry=" and reqCtzID =  '".$varReturn["CC"][0]->cdrOrgID."'" ; 
                    $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, $tmpQry  ));
                    $reqTmpID=$varReturn["Req"][0]->reqSecFunID ;
                 }
                 else if (  $varReturn["CC"][0]->cdrOrgDoc =="RQ") 
                { 
                    $tmpQry=" and reqID =   '".$varReturn["CC"][0]->cdrOrgID."'" ; 
                    $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, $tmpQry  ));
                    $reqTmpID=$varReturn["Req"][0]->reqSecFunID ;
                }
                else {   $varReturn["Req"]=null ;}    

              $result = \DB::select('exec spLogGetFteD ?',array( $varReturn["CC"][0]->cdrOrg));
              $varReturn["OcDll"] = view ('logistica.Partials.logOCDll',compact( 'result','Doc', 'reqTmpID'))->render();       

        }
        else{  $varReturn["Fts"]= null ;$varReturn["Adj"]= null;}
        return $varReturn;
    }


      public function spLogGetOC_Expediente(Request $prRqsExp)    {
      $result["Dll"] = \DB::select('exec spLogGetCSExp ?', array($prRqsExp->prID));   
      return view ('logistica.Partials.logCSExp',compact('result'))->render();
    }

     public function spLogSetOC_Expediente(Request $prRqsExp)
    {        
        $result["Dll"] = \DB::select('exec spLogSetCSExp ?,?,?,?,? ', array($prRqsExp->prTipo,$prRqsExp->prItem , $prRqsExp->prID, $prRqsExp->prAnio, $prRqsExp->prExp ));
        return view ('logistica.Partials.logCSExp',compact('result'))->render();
    }
    public function spLogGetOC_ExpedienteRow(Request $prRqsExp)
    { 
        $ReturnData["Exp"] = \DB::select('exec spLogGetCSExpRow ?', array($prRqsExp->prID));
        return  $ReturnData ;
     }
	
	
}

  