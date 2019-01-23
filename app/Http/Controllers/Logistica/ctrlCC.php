<?php

namespace Logistica\Http\Controllers\Logistica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

class ctrlCC extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
    public  function fnGetViewCC()
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_CC'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                return view ('logistica.Adq.vwAdqCdr');
            }
            else  {
                return view('logistica.Adq.vwPermission');
            }
        }
        else   {
            return view('logistica.Adq.vwPermission');
        }
    }
    public  function fnGetViewCCRucAdd(Request $prRqsFte)    {

        if($prRqsFte->varCond=="SI") {
            $ReturnData["Ruc"] = \DB::select('exec spLogGetFte ?,?,?,?', array($prRqsFte->varCond, $prRqsFte->varFteID, $prRqsFte->varCtzID, 'P'));
            $ReturnData["vwRuc"]=view('logistica.Partials.logCdrRucAdd', compact('RUC'))->render();
            //return view('logistica.Partials.logCdrRucAdd', compact('RUC'));
            return $ReturnData;
        }
        else
        {
            $ReturnData["Ruc"]=null;
            $ReturnData["vwRuc"]=view('logistica.Partials.logCdrRucAdd')->render();
            return $ReturnData ;
        }
    }

 
    public  function spLogGetFte(Request $prRqsFte)    {
        $result = \DB::select('exec spLogGetFte ?,?,?,?',array( $prRqsFte->varCond, $prRqsFte->varFteID, $prRqsFte->varCtzID,'P'));
        return  view ('logistica.Partials.logCdrRucList',compact( 'result'));
    }
    public  function spLogGetFteD(Request $prRqsFte)    {
        $Doc = "Fte";
        $result = \DB::select('exec spLogGetFteD ?',array( $prRqsFte->varFteID));
        return  view ('logistica.Partials.logCdrDll',compact( 'result','Doc'))->render();
    }
    public function spLogSetFte(Request $prRqsFte)    {
        $qry = \DB::select('exec spLogSetFte ?,?,?,?,?  ,?,?,?,?,? ',
            array( $prRqsFte["varFte"]["fteOPE"] ,
                $prRqsFte["varFte"]["fteID"],
                $prRqsFte["varFte"]["fteRuc"],
                $prRqsFte["varFte"]["fteAnio"],
                $prRqsFte["varFte"]["ftePlazo"],
                $prRqsFte["varFte"]["fteIGV"],
                $prRqsFte["varFte"]["fteGarantia"],
                $prRqsFte["varFte"]["fteObsv"],
                $prRqsFte["varFte"]["fteCdrID"],
               // $prRqsFte["varFte"]["fteUsrID"]));
                Auth::user()->usrID));
        $varReturn["Result"]=$qry ;
        $result = \DB::select('exec spLogGetFte ?,?,?,?',array( 'NO', $prRqsFte["varFte"]["fteID"],$prRqsFte["varFte"]["fteCdrID"],'P'));
        $varReturn["Fte"] =  view ('logistica.Partials.logCdrRucList',compact( 'result'))->render();
        return  $varReturn;
    }

    public function spLogSetFteD(Request $prRqsFte)    {
        $Doc = "Fte";
        $qry = \DB::select('exec spLogSetFteD ?,?,?,?,?  ,?,?,?,?,?  ,?',
            array( $prRqsFte["varBns"]["dllOPE"] ,
                $prRqsFte["varBns"]["dllID"],
                $prRqsFte["varBns"]["dllFteID"],
                $prRqsFte["varBns"]["dllCant"],
                $prRqsFte["varBns"]["dllUndID"],
                $prRqsFte["varBns"]["dllClasfID"],
                $prRqsFte["varBns"]["dllProdID"],
                $prRqsFte["varBns"]["dllEspf"],
                $prRqsFte["varBns"]["dllPrecio"],
                $prRqsFte["varBns"]["dllMarca"],
                //$prRqsFte["varBns"]["dllUsrID"]));
                Auth::user()->usrID));
        $varReturn["varReturns"]=$qry ;
        $result = \DB::select('exec spLogGetFteD ?',array( $prRqsFte["varBns"]["dllFteID"]));
        $varReturn["FteDll"]=  view ('logistica.Partials.logCdrDll',compact( 'result','Doc'))->render();
        return  $varReturn;
    }

/*
    public function spLogSetCC(Request $prRqsCC)    {
        $qry = \DB::select('exec spLogSetCC ?,?,?,?,?  ,?,?,?,?,?  ',
            array(
                $prRqsCC["varCC"]["cdrAnio"],
                $prRqsCC["varCC"]["cdrOPE"] ,
                $prRqsCC["varCC"]["cdrID"],
                $prRqsCC["varCC"]["cdrFecha"],
                $prRqsCC["varCC"]["cdrCtzID"],
                $prRqsCC["varCC"]["cdrObsv"],
                $prRqsCC["varCC"]["cdrFteID"],
                $prRqsCC["varCC"]["cdrJustf"],
                $prRqsCC["varCC"]["cdrLugarEnt"],
               // $prRqsCC["varCC"]["cdrUsrID"]));
                Auth::user()->usrID ));
        $varReturn["Result"]=$qry ;
        $result = \DB::select('exec spLogGetFte ?,?,?,?',array( 'NO', $prRqsCC["varCC"]["cdrFteID"],$prRqsCC["varCC"]["cdrCtzID"],'P'));
        if($varReturn["Result"][0]->Error==0) {

            $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array(' top 1', '', " where cdrID='" . $varReturn["Result"][0]->CCNo . "'"));
            $Ftes["Fte"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $varReturn["CC"][0]->cdrOrg, $varReturn["CC"][0]->cdrCtzID , 'P'));
            $varReturn["Fts"] =  view ('logistica.Partials.logCdrRucList',compact( 'result'))->render();
            $varReturn["Adj"] =  view ('logistica.Partials.logCdrRucAdj',["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();

        }

        return $varReturn;

    }

    public function spLogGetCC(Request $prRqsCC)    {
        $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array($prRqsCC->prRows, $prRqsCC->prAnio, $prRqsCC->prQry));
        if(  count( $varReturn["CC"])>0) {
            $result = \DB::select('exec spLogGetFte ?,?,?,?', array('NO', '', $varReturn["CC"][0]->cdrCtzID, 'P'));
            $Ftes["Fte"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $varReturn["CC"][0]->cdrOrg, $varReturn["CC"][0]->cdrCtzID, 'P'));
            $varReturn["Fts"] = view('logistica.Partials.logCdrRucList', compact('result'))->render();
            $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', '2015', " where reqCtzID='".$varReturn["CC"][0]->cdrCtzID."'"  ));

            if(isset( $Ftes["Fte"][0]->fteID))
                $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj', ["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();
            else
                $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj',compact('result') )->render();

            $varReturn["AdjDll"] =$Ftes["Fte"];

            $result = \DB::select('exec spLogGetFteD ?',array( $varReturn["CC"][0]->cdrOrg));
            $varReturn["BnsDll"] = view ('logistica.Partials.logCdrDll',compact( 'result'))->render();
            $varReturn["Ref"]  = \DB::connection('dblogistica')-> select(' exec spLogGetReqSg ?,?,?,?,?,?',   array('REQ','2016', '','',''," and RQ.reqID ='".$varReturn["Req"][0]->reqID."'"));
        }
        else{  $varReturn["Fts"]= null ;$varReturn["Adj"]= null;}
        return $varReturn;
    }
*/
    public function spLogSetCC(Request $prRqsCC)    {
        $varOpe = $prRqsCC["varCdr"]["cdrOPE"];

        $qry = \DB::select('exec spLogSetCC ?,?,?,?,?  ,?,?,?,?,?  ,? ,?,?,?',
            array(
                $prRqsCC["varCdr"]["cdrAnio"],
                $prRqsCC["varCdr"]["cdrOPE"] ,
                $prRqsCC["varCdr"]["cdrID"],
                $prRqsCC["varCdr"]["cdrFecha"],
                $prRqsCC["varCdr"]["cdrOrgID"],
                $prRqsCC["varCdr"]["cdrObsv"],
                $prRqsCC["varCdr"]["cdrFteID"],
                $prRqsCC["varCdr"]["cdrJustf"],
                $prRqsCC["varCdr"]["cdrEje"],
                $prRqsCC["varCdr"]["cdrEnt"],                
                $prRqsCC["varCdr"]["cdrLugarEnt"],
                $prRqsCC["varCdr"]["cdrOrgDoc"],
                $prRqsCC["varCdr"]["cdrOrgRef"],
               // $prRqsCC["varCC"]["cdrUsrID"]));
                Auth::user()->usrID ));
                 $varReturn["Result"]=$qry ;

       
            $idCdr = $qry[0]->CCNo ;
            $ErrorDtll =array();
            if($idCdr=="NN") { return response()->json($qry);}
            if( $varOpe=="ADD" )
             {   
                foreach ($prRqsCC["varCdrDll"] as $key => $valor)
                {
                    $resultDetalles = \DB::select('exec spLogSetCCD ?,?,?,?,?  ,?,?,?,?,? ,? ',
                        array( $varOpe,$idCdr , 0, $valor["czItm"], $valor["rqItm"]  , $valor["prod"], $valor["und"],$valor["cant"],$valor["clasf"],$valor["espf"], Auth::user()->usrID ));
                    if ($resultDetalles[0]->CCNo == "NN")
                    {
                        array_push($ErrorDtll, array('CCNo' => $resultDetalles[0]->ReqNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                    }
                }
                if (count($ErrorDtll) > 0) {    return response()->json($ErrorDtll);      }
            }

            if( $varOpe=="UPD" || $varOpe=="DEL" )
            {

                $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array(' top 1', $prRqsCC["varCdr"]["cdrAnio"]  , " AND cdrID='" . $varReturn["Result"][0]->CCNo . "'"));
                $result = \DB::select('exec spLogGetFte ?,?,?,?', array('NO', '', $varReturn["CC"][0]->cdrID, 'P'));          
                $Ftes["Fte"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $varReturn["CC"][0]->cdrOrg, $varReturn["CC"][0]->cdrOrgID , 'P'));
                $varReturn["Fts"] =  view ('logistica.Partials.logCdrRucList',compact( 'result'))->render();
                $varReturn["Adj"] =  view ('logistica.Partials.logCdrRucAdj',["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'Eje'=>$varReturn["CC"][0]->cdrEjecucion,'Ent'=>$varReturn["CC"][0]->cdrEntrega, 'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();
            }
      
        return $varReturn;
    }

    public function spLogSetCCCz(Request $prRqsCC)    {
       
        $qry = \DB::select('exec spLogSetCCCz ?,?,?,?,?', array( $prRqsCC->prCdrID, $prRqsCC->prOrgID, $prRqsCC->prOrgDoc,  $prRqsCC->prOrgRef,Auth::user()->usrID ));
        
         foreach ($prRqsCC["varCdrDll"] as $key => $valor)
            {
                $resultDetalles = \DB::select('exec spLogSetCCD ?,?,?,?,?  ,?,?,?,?,? ,? ',
                    array( "ADD",$prRqsCC->prCdrID , 0, $valor["czItm"], $valor["rqItm"]  , $valor["prod"], $valor["und"],$valor["cant"],$valor["clasf"],$valor["espf"], Auth::user()->usrID ));
                if ($resultDetalles[0]->CCNo == "NN")  {   array_push($ErrorDtll, array('CCNo' => $resultDetalles[0]->ReqNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));                 }
            }
         
        $Doc="Cdr";       
        $result = \DB::select('exec spLogGetCCD ?',array( $prRqsCC->prCdrID));
        $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array($prRqsCC->prRows, $prRqsCC->prAnio, $prRqsCC->prQry));
        $varReturn["CdrDll"]=  view ('logistica.Partials.logCdrDll',compact( 'result','Doc'))->render();
        return  $varReturn;
    }

      public function spLogSetCCD(Request $prRqsCC)    {
       
        $Doc="Cdr";
        $idCdr = $prRqsCC["varCdr"]["cdrID"];
        $varOpe = $prRqsCC["varCdrDll"]["OPE"];
        $qry = \DB::select('exec spLogSetCCD ?,?,?,?,?  ,?,?,?,?,? ,? ',
        array( $varOpe,$idCdr , $prRqsCC["varCdrDll"]["cdItm"], $prRqsCC["varCdrDll"]["czItm"], $prRqsCC["varCdrDll"]["rqItm"]  , $prRqsCC["varCdrDll"]["prodID"], $prRqsCC["varCdrDll"]["prodUndID"],$prRqsCC["varCdrDll"]["prodCant"],$prRqsCC["varCdrDll"]["prodClasfID"],$prRqsCC["varCdrDll"]["prodEspf"], Auth::user()->usrID ));
        $result = \DB::select('exec spLogGetCCD ?',array( $idCdr));
        
        $varReturn["CdrDll"]=  view ('logistica.Partials.logCdrDll',compact( 'result','Doc'))->render();
        return  $varReturn;
    }

    public function spLogGetCC(Request $prRqsCC)    {
        $varReturn["CC"] = \DB::select('exec spLogGetCC ?,?,?', array($prRqsCC->prRows, $prRqsCC->prAnio, $prRqsCC->prQry));
        if(  count( $varReturn["CC"])>0) {
             $Doc="Cdr";
             $result = \DB::select('exec spLogGetCCD ?',array( $varReturn["CC"][0]->cdrID));
             $varReturn["CdrDll"] = view('logistica.Partials.logCdrDll', compact('result','Doc'))->render();           
             $result = \DB::select('exec spLogGetFte ?,?,?,?', array('NO', '', $varReturn["CC"][0]->cdrID, 'P'));          
             $varReturn["Fts"] = view('logistica.Partials.logCdrRucList', compact('result'))->render();
             $Ftes["Fte"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $varReturn["CC"][0]->cdrOrg, $varReturn["CC"][0]->cdrOrgID, 'P'));

             if(isset( $Ftes["Fte"][0]->fteID))
                $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj', ["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'Eje'=>$varReturn["CC"][0]->cdrEjecucion,'Ent'=>$varReturn["CC"][0]->cdrEntrega,'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();
             else
                $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj',compact('result') )->render();

             $varReturn["AdjDll"] =$Ftes["Fte"];

          //  $varReturn["Req"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ', $prRqsCC->prAnio, " and reqCtzID='".$varReturn["CC"][0]->cdrCtzID."'"  ));

         /*   if(isset( $Ftes["Fte"][0]->fteID))
                $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj', ["Ftes"=>$Ftes,'Just'=>$varReturn["CC"][0]->cdrJustf,'Eje'=>$varReturn["CC"][0]->cdrEjecucion,'Ent'=>$varReturn["CC"][0]->cdrEntrega,'LugarEnt'=>$varReturn["CC"][0]->cdrLugarEnt ])->render();
            else
                $varReturn["Adj"] = view('logistica.Partials.logCdrRucAdj',compact('result') )->render();

            $varReturn["AdjDll"] =$Ftes["Fte"];

            $result = \DB::select('exec spLogGetFteD ?',array( $varReturn["CC"][0]->cdrOrg));
            $varReturn["BnsDll"] = view ('logistica.Partials.logCdrDll',compact( 'result'))->render();
            $varReturn["Ref"]  = \DB::connection('dblogistica')-> select(' exec spLogGetReqSg ?,?,?,?,?,?',   array('REQ',$prRqsCC->prAnio, '','',''," and RQ.reqID ='".$varReturn["Req"][0]->reqID."'"));
            */
        }
        else{  $varReturn["Fts"]= null ;$varReturn["Adj"]= null;}
        return $varReturn;
    }


     public function spLogGetCCPrint($anio,$id )
    {
            $ReturnData["Usr"]=Auth::user()->usrID ;
            $ReturnData["CC"] = \DB::select('exec spLogGetCC ?,?,?', array(  ' top 1 ',$anio, " and cdrid = '".$id."' " ));
            $ReturnData["CCDll"] = \DB::select('exec spLogGetCCD_Print ?',array(  $id ));
            $ReturnData["CCAdj"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $ReturnData["CC"][0]->cdrFteID  ,  $id, 'P'));
            $ReturnData["CCReq"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ',$anio," and reqctzid='".$ReturnData["CC"][0]->cdrOrgID."'"));
            $ReturnData["FteAbsClasf"] = \DB::select('exec spLogGetFteAbsClasf ?, ?',array(  $id, $ReturnData["CC"][0]->cdrFteID ));
            $v = view("logistica.rptAdqCC",compact('ReturnData'))->render();
            $pdf=\App::make('dompdf.wrapper');
            $pdf->loadHTML($v)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            return $pdf->stream();
    }


/*
    public function spLogGetCCPrint($id )
    {
        $ReturnData["Usr"]=Auth::user()->usrID ;
        $ReturnData["CC"] = \DB::select('exec spLogGetCC ?,?,?', array(  ' top 1 ','2015', " where cdrid = '".$id."' " ));
        $ReturnData["CCDll"] = \DB::select('exec spLogGetCCD ?',array(  $ReturnData["CC"][0]->cdrCtzID  ));
        $ReturnData["CCAdj"] = \DB::select('exec spLogGetFte ?,?,?,?', array('SI', $ReturnData["CC"][0]->cdrOrg, $ReturnData["CC"][0]->cdrCtzID, 'P'));
        $ReturnData["CCReq"] =\DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ','2015'," where reqctzid='".$ReturnData["CC"][0]->cdrCtzID."'"));
        //$ReturnData["ReqAbsClasf"] = \DB::select('exec spLogGetReqAbsClasf ?',array(  $id ));
        $v = view("logistica.rptAdqCC",compact('ReturnData'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
        return $pdf->stream();
    }*/

    public function spLogGetCCLR(Request $request)
    {
        $ReturnData = \DB::select('exec spLogGetCCLR ?,?,?', array(  $request->prAnio, $request->prPosition, $request->prCodCC ));
        return  $ReturnData ;
    }

    public function spLogGetCCSearch(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetCCSearch ?,? ',   array("2016"," order by cdrID desc "));
        return   view ('logistica.Partials.logCdrSearch',compact( 'result'))->render();;
    }

    public function spLogSetCCBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select('exec spLogSetCCBusy ?,?',   array($request->Anio, Auth::user()->usrID));
        return  $result;
    }

    public function spLogGetCC_Ctz (Request $prRqsCtz)
    {
        $Doc="Ctz";
        $ReturnData["Ctz"] = \DB::select('exec spLogGetCtz ?,?,?', array(  $prRqsCtz->prRows, $prRqsCtz->prAnio, $prRqsCtz->prQry ));
        if(isset ($ReturnData["Ctz"][0]->ctzID)) {
            $result = \DB::select('exec spLogGetCtzD ?', array($ReturnData["Ctz"][0]->ctzID));
            $ReturnData["CdrDll"] = view('logistica.Partials.logCdrDll', compact('result','Doc'))->render();
        }
        return  $ReturnData ;
    }
     public function spLogGetCC_Req(Request $prRqsReq)
    {
         $Doc="Req";
        $ReturnData["Req"] = \DB::select('exec spLogGetReqTmp ?,?,?', array(  $prRqsReq->prRows, $prRqsReq->prAnio, $prRqsReq->prQry ));
        if(isset ($ReturnData["Req"][0]->reqID)) {
            $result = \DB::select('exec spLogGetReqD ?', array($ReturnData["Req"][0]->reqID));      //  dd($dll);
            $ReturnData["CdrDll"] = view('logistica.Partials.logCdrDll', compact('result','Doc'))->render();
        }
        return  $ReturnData ;
    }

  


}
