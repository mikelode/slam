<?php

namespace Logistica\Http\Controllers\Logistica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

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
    public function spLogGetOS (Request $prRqsOS)
    {
        $Doc = "Ods";
        $ReturnData["OS"] = \DB::select('exec spLogGetOS ?,?,?', array(  $prRqsOS->prRows, $prRqsOS->prAnio, $prRqsOS->prQry ));
        if(isset ($ReturnData["OS"][0]->osID)) {
            $result = \DB::select('exec spLogGetOSD ?', array($ReturnData["OS"][0]->osID));
            $ReturnData["OSDll"] = view('logistica.Partials.logOSDll', compact('result','Doc'))->render();
        }
        $ReturnData["Exp"] = \DB::select('exec spLogGetCSExpRow ?', array($ReturnData["OS"][0]->osID));
        return  $ReturnData ;
    }
    public function spLogSetOS(Request $prRqsOS)
    {
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
        if($idos=="NN") { return response()->json($dbResult);  }
        if(  $prRqsOS["varOS"]["osOPE"]=="ADD" || $prRqsOS["varOS"]["FlgADD"]=="ADD"  )
        {
            foreach ($prRqsOS["varOSDll"] as $key => $valor)
            {
                $dbResultDll = \DB::select('exec spLogSetOSD ?,?,?,?,?  ,?,?,?,?,?  ,?  ,?,?,?', array( 'ADD',$idos , $valor["prod"], $valor["und"], $valor["clasf"],$valor["cant"],$valor["precio"],$valor["marca"],$valor["espf"],$valor["osItm"],$valor["cdItm"],$valor["czItm"],$valor["rqItm"] ,Auth::user()->usrID));
                if ($dbResultDll[0]->OSNo == "NN")    {    array_push($ErrorDtll, array('OSNo' => $dbResultDll[0]->osNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"])); }
            }
            if (count($ErrorDtll) > 0) {    return response()->json($ErrorDtll);      }
        }
        //  }
        //  return  response()->json ($dbResult );
        return $dbResult;
    }

    public function spLogSetOSD(Request $prRqsOS)
    {
        $Doc = "Ods";
        $varReturn["varReturns"] = \DB::select('exec spLogSetOSD ?,?,?,?,?  ,?,?,?,?,? ,? ,?,?,? ',
            array( $prRqsOS["varBns"]["OPE"] , $prRqsOS["varBns"]["osID"] , $prRqsOS["varBns"]["prodID"]  ,  $prRqsOS["varBns"]["prodUndID"],  $prRqsOS["varBns"]["prodClasfID"],$prRqsOS["varBns"]["prodCant"],$prRqsOS["varBns"]["prodPrecio"],$prRqsOS["varBns"]["prodMarca"],$prRqsOS["varBns"]["prodEspf"],$prRqsOS["varBns"]["osItm"], $prRqsOS["varBns"]["cdItm"], $prRqsOS["varBns"]["czItm"], $prRqsOS["varBns"]["rqItm"] ,Auth::user()->usrID ));
        $result = \DB::select('exec spLogGetOSD ?',array( $prRqsOS["varBns"]["osID"]));
        $varReturn["vwDll"] =  view ('logistica.Partials.logOSDll',compact( 'result','Doc'))->render();
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
            $v = view("logistica.rptAdqOSrv",compact('ReturnData'))->render();
        }

        $pdf=\App::make('dompdf.wrapper');        
        $pdf->loadHTML($v)->setPaper('letter')->setOrientation('portrait');
        return $pdf->stream();

        //$pdf->loadHTML($v)->setPaper('a4')->setOrientation('horizontal')->setWarnings(false);
        //$pdf->loadHTML($v)->setPaper('letter')->setOrientation('landscape');
    }

    public function spLogGetReq(Request $prRqsOS)    {
        $Doc="Req";
        $ReturnData["Req"] = \DB::select('exec spLogGetReqTmp ?,?,?', array(  $prRqsOS->prRows, $prRqsOS->prAnio, $prRqsOS->prQry ));
        
         if(isset ($ReturnData["Req"][0]->reqID)) {
        $result = \DB::select('exec spLogGetReqD ?',array(  $ReturnData["Req"][0]->reqID));      //  dd($dll);
        $ReturnData["OsDll"] =   view ('logistica.Partials.logOSDll',compact('result','Doc'))->render();
        }     
        return $ReturnData;
    }
    public function spLogGetOSLR(Request $request)
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
    public  function fnGetViewTableOSNull(Request $prRqsOS)
    { 
        $Doc = "Null";
        $result="";
        return view ('logistica.Partials.logOSDll',compact('result', 'Doc'))->render();       
    }

    public function spLogSetOSDDel(Request $prRqsOS)
    {
        $Doc = "Ods";
        $varReturn["varReturns"] = \DB::select('exec spLogSetOsDDel ?',  array( $prRqsOS->osID));
       
        $result = \DB::select('exec spLogGetOSD ?',array( $prRqsOS->osID));
        $varReturn["OsDll"] =  view ('logistica.Partials.logOSDll',compact( 'result','Doc'))->render();
        return  $varReturn;
    }

    /******/

      public function spLogGetOS_CCVal(Request $prRqsCC)    {
            $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array($prRqsCC->prRows, $prRqsCC->prAnio, $prRqsCC->prQry));
            if(  count( $varReturn["CC"])>0) {
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
             if (  $varReturn["CC"][0]->cdrOrgDoc =="CZ") {  $tmpQry=" and reqCtzID =  '".$varReturn["CC"][0]->cdrOrgID."'" ; 
                $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, $tmpQry  ));
            }
             else if (  $varReturn["CC"][0]->cdrOrgDoc =="RQ") { 
              $tmpQry=" and reqID =   '".$varReturn["CC"][0]->cdrOrgID."'" ; 
              $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, $tmpQry  ));}
             else {   $varReturn["Req"]=null ;}    

              $result = \DB::select('exec spLogGetFteD ?',array( $varReturn["CC"][0]->cdrOrg));
              $varReturn["OsDll"] = view ('logistica.Partials.logOSDll',compact( 'result','Doc'))->render();       

        }
        else{  $varReturn["Fts"]= null ;$varReturn["Adj"]= null;}
        return $varReturn;
    }


}
