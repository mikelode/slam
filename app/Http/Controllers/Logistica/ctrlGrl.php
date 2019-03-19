<?php

namespace Logistica\Http\Controllers\Logistica;
/*use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\Almacen\almAlmacen;
use TCPDF;*/

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Logistica\Almacen\almAlmacen;
use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almTPreSF;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\Almacen\logTbNotif;
use Logistica\User;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;



class ctrlGrl extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');

    }

/********* FN DEPENCENCIAS ********************************************/
    public  function fnGetViewDepNew()
    {
        return view ('logistica.Partials.logDepAdd');
    }

    public  function fnGetViewDep()
    {
        return view ('logistica.Adq.vwAdqDep');
    }

    public  function spLogGetDep( Request $request  )
    {       
      //  $result  = \DB::connection('dblogistica')-> select(' exec spLogGetDep ?,? ' , array('2015' , $request->prQry));
         $result = \DB::select(' exec spLogGetDep ?,? ', array ($request->prAnio,$request->prQry));
        return view ('logistica.Partials.logDepDll',compact('result'))->render();      
        //return view ('logistica.Partials.logDepDll')->render();      
    }

      public function spLogSetDep(Request $request)
    {
        $Access = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_DEP'  ));
        if( isset ($Access[0]->NEW ))
        {
            if( $Access[0]->NEW =="1") {
                $varReturn["Result"]= \DB::select('exec spLogSetDep ?,?,?,?,?', array(
                    $request->txDep_OPE,
                    $request->txDep_OPE == 'ADD' ? '' : $request->txDep_Id,
                    $request->txDep_Anio,
                    $request->txDep_Dsc  ,
                    Auth::user()->usrID
                ));
                $result = \DB::select(' exec spLogGetDep ?,? ', array ($request->txDep_Anio,''));
                $varReturn["vwDep"]= view ('logistica.Partials.logDepDll',compact('result'))->render();
                $varReturn["Flag"]= "0";
                if($request->txDep_OPE=="ADD") sleep(1);
                return $varReturn ;
            }
            else  {
                $varReturn["Flag"]= "1";
                $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
               
                return $varReturn;
            }
        }
        else   {       $varReturn["Flag"]= "1";
            $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
            //$varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
            return $varReturn;
        }
    }






/*************************************************************************/

   public  function fnGetViewActDoc()   
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_ADO'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {             
                  return view ('logistica.Adq.vwAdqActDoc');
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

   public  function spLogGetActDocDll( Request $request  )
    { 
        $qry="";
        if ($request->prAll=='N')  $qry = " and adCodigo  like '%0".$request->prQry."' ";
        else   $qry = '';
        $result = \DB::select(' exec spLogGetAD ?,?,? ', array ($request->prAnio,$request->prTipo,$qry));
        return view ('logistica.Partials.logADDll',compact('result'))->render();   
    }

    public  function spLogSetActDocDll( Request $request  )
    {        
        $resultRow = \DB::select(' exec spLogSetAD ?,? ', array ($request->prTipo,$request->prID));
        return view ('logistica.Partials.logADDll',compact('resultRow'))->render();   
    }



    public  function fnGetViewActUser()
    {
         $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_ADU'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {             
                 return view ('logistica.Adq.vwAdqActUser');
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

     public  function spLogGetActUserDll( Request $request  )
    { 
        $qry="";
        if ($request->prBsq=='DNI')  $qry = " and adUsuario = '".$request->prQry."' ";
        else if ($request->prBsq=='DOC')  $qry = " and adCodigo like '%0".$request->prQry."' ";
        else   $qry = '';
        $result = \DB::select(' exec spLogGetAU ?,?,? ', array ($request->prAnio,$request->prTipo,$qry));
        return view ('logistica.Partials.logAUDll',compact('result'))->render();   
    }

    public  function spLogSetActUserDll( Request $request  )
    {  
        $resultRow = \DB::select(' exec spLogSetAU ?,? ,? ', array ($request->prTipo,$request->prID,$request->prCodUser));
        return $resultRow; 
    }


   public  function spLogGetUsrPerz( Request $request  )
    {  
       $result = \DB::select(' exec spLogGetUsrPerz ? ', array ($request->prCodUser));
       return view ('logistica.Partials.logUsrPerz',compact('result'))->render(); 
    }
     public  function spLogSetUsrPerz( Request $request  )
    {    
        $result="";
        foreach ($request["varDll"] as $key => $valor)
          $result = \ DB::select('exec spLogSetUsrPerz ?,?,?,?,?,? ,?', array($request->varCodUser  , $valor["iRow"] ,  $valor["iAdd"],$valor["iUpd"] ,$valor["iDel"] ,$valor["iPrint"],$valor["iShow"]));
         return  $result  ;
    }
    public  function spLogGetUsrAcs( Request $request  )
    {  
       $result = \DB::select(' exec spLogGetUsrAcs ? ', array ($request->prCodPerfil));
       return view ('logistica.Partials.logUsrPerz',compact('result'))->render(); 
    }

    public function spLogSetTrsh (Request $prRqsOC)
    {  
        $ReturnData = \DB::select('exec spLogSetTrsh ?,?', array(  $prRqsOC->prTipo , $prRqsOC->prID ));        
        return  $ReturnData ;
    }


     public  function    spSiafAsyn( Request $request  )
        {
            $Doc='SHOW';
            $Anio=$request->prAnio;            
            $file = fopen("sf.txt", "w");
            fwrite($file, trim($Anio) .PHP_EOL);  // DNI a Consultar           
            fclose($file);
            exec("iSiafMet.exe");
            
             $result = \DB::select(' exec spLogGetSF ?,? ', array ($request->prAnio,$request->prQry));
            return view ('logistica.Partials.logSecFunDll',compact('result'))->render();  
        } 



    public  function fnGetViewPriceRef()
    {
        return view ('logistica.Adq.vwAdqPrice');
    }
    public  function spLogGetPriceItem( Request $request  )
    {  
       $result = \DB::select(' exec spLogGetPriceCat ?,? ', array ($request->prAnio , $request->prDsc));
       return view ('logistica.Partials.liqCatDll',compact('result'))->render(); 
    }
     public  function spLogGetPriceAll( Request $request  )
    {  
       $Doc="SHOW";
       $id=date('Y-m-d H:i:s');
       foreach ($request["prCodigo"] as $key => $valor)
         $dbResultDll = \DB::select('exec spLogSetPriceItem ?,?', array( $valor["Codigo"]  ,  $id));              
       
       $result = \DB::select(' exec spLogGetPriceAll ?,? ', array ($request->prAnio , $id));
       return view ('logistica.Partials.liqPriceDll',compact('Doc','result'))->render(); 
    }

      public  function    spLogGetPriceRefExcel(  $prAnio , $prCodigo  )
    {
       $Doc="XLS";
       $result = \DB::select(' exec spLogGetPriceAll ?,? ', array ($prAnio , $prCodigo));
       return view ('logistica.Partials.liqPriceDll',compact('result','Doc')); 
    }




/********* FN SECUENCIAS FUNCIONALES *************************************/
    public  function fnGetViewSecFunNew()
    {
        return view ('logistica.Partials.logSecFunAdd');
    }

    public  function fnGetViewSecFun()
    {
        return view ('logistica.Adq.vwAdqSecFun');
    }

    public  function spLogGetSecFun( Request $request  )
    {       
      //  $result  = \DB::connection('dblogistica')-> select(' exec spLogGetDep ?,? ' , array('2015' , $request->prQry));
         $result = \DB::select(' exec spLogGetSF ?,? ', array ($request->prAnio,$request->prQry));
        return view ('logistica.Partials.logSecFunDll',compact('result'))->render();      
        //return view ('logistica.Partials.logDepDll')->render();      
    }

      public function spLogSetSecFun(Request $request)
    {
        $Access = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_PTO_SF'  ));
        if( isset ($Access[0]->NEW ))
        {
            if( $Access[0]->NEW =="1") {
                $varReturn["Result"]= \DB::select('exec spLogSetSF ?,?,?,?,?  ,?', array(  $request["varRqs"]["secOPE"], $request["varRqs"]["secID"], $request["varRqs"]["secAnio"],  $request["varRqs"]["secNom"] ,  $request["varRqs"]["secFin"]  , Auth::user()->usrID ));
                $result = \DB::select(' exec spLogGetSF ?,? ', array ($request["varRqs"]["secAnio"],''));
                $varReturn["vwSecFun"]= view ('logistica.Partials.logSecFunDll',compact('result'))->render();
                $varReturn["Flag"]= "0";
                if($request["varRqs"]["secOPE"]=="ADD") sleep(1);
                return $varReturn ;
            }
            else  {
                $varReturn["Flag"]= "1";
                $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
               
                return $varReturn;
            }
        }
        else   {       $varReturn["Flag"]= "1";
            $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
            //$varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
            return $varReturn;
        }
    }
    
    public  function fnGetViewRptRanking  ()
    {
          $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_OC'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
               // return view ('logistica.Adq.vwAdqOCom');
                 return view ('logistica.Partials.logRptRanking');
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


    public  function fnGetViewPrice()
    {

         $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_CZ'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                  return view ('logistica.Partials.logRptPrice');
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
    
	public  function fnGetViewRpt()
    {
        return view ('logistica.Adq.vwAdqRpt');
    }
	public  function fnGetViewRptSeace	()
    {
          $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_OC'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
               // return view ('logistica.Adq.vwAdqOCom');
                 return view ('logistica.Partials.logRptSeace');
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
    public  function fnGetViewAnio()
    {

        return view ('logistica.Partials.logGrlAnio');
    }


    public  function fnGetViewCal()
    {
        exec("iLogSiaf.exe");
      //  system("calc.exe");
        // return view ('logistica.Partials.logGrlAnio');
    }
    public  function fnGetViewCat()
    {

        return view ('logistica.Adq.vwAdqProd');
    }
    public  function fnGetViewPass()
    {
       /* $file = fopen("dni.txt", "w");
        fwrite($file, trim('45109762') .PHP_EOL);  // DNI a Consultar
        fclose($file);
        exec("consudni");
        $dato = file_get_contents("data.txt");
          unlink('data.txt');
            unlink('dni.txt');*/
        return view ('logistica.Partials.logUsrPass');
    }

    public  function     autoFindClasf( Request $request  )
    {
        $qry = \DB::connection('dblogistica')-> select(' exec spLogGetDatosTmp ?,?,?,? ',array ('CLASF','','2019'," where replace( cod,'.','')  like '".str_replace ('.','', $request->term )."%' "));
        $result = [];
        foreach($qry as $und) {
            $result[] = array('label' => $und->Cod,'value' => $und->ID );
        }
        return response()->json($result);
    }
    public  function     autoFindProd( Request $request  )
    {
        $qry = \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',array ('BNS','','2015'," where replace( DSC,'  ',' ')  like '%".str_replace ('  ',' ', $request->term )."%' "));
        $result = [];
        foreach($qry as $und) {
            $result[] = array('label' => $und->Dsc,'value' => $und->ID );
        }
        return response()->json($result);
    }
    public  function     autoFindUnd( Request $request  )
    {
        $qry = \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',array ('UND','','2015'," where replace( DSC,' ','')  like '".str_replace (' ','', $request->term )."%' "));
        $result = [];
        foreach($qry as $und) {
            $result[] = array('label' => $und->Dsc,'abrv'=>$und->Cod,'value' => $und->ID );
        }
        return response()->json($result);
    }

     public  function     autoFindReq( Request $request  )
    {
        $qry = \DB::connection('dblogistica')-> select(" select reqid as ID, [dbo].fnLogGetCodRq (reqID) as Cod  from tlogreq where reqid like '%".str_replace (' ','', $request->term )."'");
        $result = [];
        foreach($qry as $und) {
            $result[] = array('label' => $und->Cod,'value' => $und->ID );
        }
        return response()->json($result);
    }

    public  function     spLogGetPrice( Request $request  )
    {
        $qry ="";
      //  if($request->Tipo=="RQ") { $qry =" where RQ.reqAnio='2016' and RQ.reqID like '%".$request->Valor."'";}
      //  else if($request->Tipo=="SF") { $qry =" where RQ.reqAnio='2016' and RQ.reqSecFun like '%".$request->Valor."'";}
      //  else if($request->Tipo=="DP") { $qry =" where RQ.reqAnio='2016' and RQ.reqDep like '%".$request->Valor."'";}
        $result["Dll"]  = \DB::connection('dblogistica')-> select(' exec spLogGetPrice ?',   array($qry));
        return view ('logistica.Partials.logPrice',compact('result'))->render();
    }

    public function  spLogGetPriceProducto(Request $request)
    {
        try{
            $qry =  " WHERE prcProdDsc LIKE '%" . $request->prcProducto . "%' ";

            $productos = DB::connection('dblogistica')->select('exec spLogGetPriceProducto ?, ?, ?, ?', array(
                'GRL',
                $qry,
                $request->prcDocumento,
                $request->prcAnio
            ));

            if(count($productos) > 0){
                $view = view('logistica.Partials.logPriceProduct', compact('productos'))->render();
                $msg = 'Recuperado';
                $msgId = 200;
            }
            else{
                throw new Exception("No existen registro de precios para el producto buscado");
            }

        }catch (Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $view = null;
        }

        return response()->json(compact('msg','msgId','view'));
    }

    public function vwDetailPriceProducto(Request $request)
    {
        try{

            $qry = " WHERE prodCod = '" . $request->producto . "' AND prodUndCod = " . $request->unidad;

            $precios["RQ"] = DB::connection('dblogistica')->select('exec spLogGetPriceProducto ?, ?, ?, ?', array(
                'DLL',
                $qry,
                'RQ',
                $request->anio
            ));

            $precios["CC"] = DB::connection('dblogistica')->select('exec spLogGetPriceProducto ?, ?, ?, ?', array(
                'DLL',
                $qry,
                'CC',
                $request->anio
            ));

            $precios["OC"] = DB::connection('dblogistica')->select('exec spLogGetPriceProducto ?, ?, ?, ?', array(
                'DLL',
                $qry,
                'OC',
                $request->anio
            ));

            $view = view('logistica.partials.logPriceSeg', compact('precios'))->render();
            $msg = 'Recuperado correctamente';
            $msgId = 200;

        }
        catch (Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $view = '';
        }

        return response()->json(compact('msg','msgId','view'));
    }

 
    public  function fnGetViewPassVal( Request $request  )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetUsr ? ',   array(" where ID='".Auth::user()->usrID."'"));

        if(isset($result[0]->ID)) {
        $Flg= $result[0]->Pss;
            dd(\Hash::make($request->Pss));
          if ($Flg==\Hash::make($request->Pss)) {
                return view('logistica.Partials.logUsrPass', compact('Flg'));
            }
         //   else{
         //       return view('logistica.Partials.logUsrPass');
         //   }
        }
       /* else{
            return view('logistica.Partials.logUsrPass');
        }*/
    }

    public  function fnGetViewPassChange()
    {

        return view ('logistica.Partials.logUsrPass',compact('Flg'));
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

    public  function fnGetViewPers()
    {
        return view('logistica.Partials.logPers');
    }
    public  function fnGetViewUsr()
    {
        try{

            /* Solo existira un usuario con privilegio de administrar usuarios */
//            if(Auth::user()->usrID == '12345678'){
                $Usr["PFL"]= \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',   array('PFL','','',''));
                $view = view('logistica.Partials.logUsr',compact( 'Usr'))->render();
                $msg = "Permiso aceptado";
                $msgId = 200;
/*            }
            else{
                throw new Exception("Ud. no está autorizado para acceder a este módulo");
            }*/
        }catch (Exception $e){
            $msg = $e->getMessage();
            $msgId = 500;
            $view = '';
        }

        return response()->json(compact('msg','msgId','view'));

        /*$result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_RQ'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                return view('logistica.Adq.vwAdqReq');
            }
            else
            {
                return view('logistica.Adq.vwPermission');
            }
        }
        else
        {
            return view('logistica.Adq.vwPermission');
        }*/
    }


    public function spLogGetCatalogo(Request $request)
    {
        $qry ="";

        if($request->tipo =="COD" || $request->tipo=="CID" )  {  $qry = " where cast ( RTRIM( lTRIM( cod))  as int) = " . $request->valor; }
        else if($request->tipo == "STR")  {  $qry = " where RTRIM( lTRIM( cod)) = replace ( RTRIM( lTRIM('".$request->valor."')),' ','')"; } //$request->tipo
        else if($request->tipo =="DSC")  {  $qry = " where dsc like  '%" . $request->valor."%' "; }
        else { echo 'Error'; return; }
        //$result = \DB::select(' select dbo.fnLogGetGrlDat (?,?,?) as Dsc',array ('DEP',$request->valor,'0'));
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',array ($request->obj,$request->tipo,'2015',$qry));
        return   view ('logistica.Partials.logProdDll',compact( 'result'))->render();
    }

    public function spLogGetUsr(Request $request )
    {
        $Usr["PFL"]= \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',   array('PFL','','',''));
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetUsr ? ',   array(" where ID='".$request->qry."'"));
        if(isset($result[0]->ID)) {
            $Usr["Usr"] = $result;
            $Usr["UsrVw"]=view('logistica.Partials.logUsr',compact( 'Usr'))->render();
        }
        else{
            $Usr["Prs"] = \DB::connection('dblogistica')-> select(' exec spLogGetPers ? ',   array(" where DNI='".$request->qry."'"));
        }
        return $Usr;
    }

    public function spLogSetUsr(Request $request)
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_USR'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                $varReturn["Result"]= \DB::select('exec spLogSetUsr ?,?,?,?,?  ,?,?,?', array( $request->OPE , $request->DNI  ,\Hash::make($request->Pass) ,$request->Abrv,$request->Est,$request->FecFin,$request->Perfil,Auth::user()->usrID ));
                $varReturn["Flag"]= "0";
                return $varReturn ;
            }
            else  {
                $varReturn["Flag"]= "1";
                $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
                // $varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
                return $varReturn;
            }
        }
        else   {       $varReturn["Flag"]= "1";
            $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
            //$varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
            return $varReturn;
        }
    }

    public function spLogGetPers(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetPers ? ',   array(" where DNI='".$request->qry."'"));
        return  $result;
    }

    public function spLogSetPers(Request $request)
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_PERS'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                $varReturn["Result"]= \DB::select('exec spLogSetPers ?,?,?,?,?  ,?', array( $request->OPE , $request->DNI  ,$request->APaterno,$request->AMaterno,$request->Nombres,Auth::user()->usrID ));
                $varReturn["Flag"]= "0";
                return $varReturn ;
            }
            else  {
                $varReturn["Flag"]= "1";
                $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
                // $varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
                return $varReturn;
            }
        }
        else   {       $varReturn["Flag"]= "1";
            $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
            //$varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
            return $varReturn;
        }
    }

    function getNumRand()
    {
        $url="http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/captcha?accion=random";

        $_followlocation = true;
        $_timeout = 30;
        $_maxRedirects = 4;
        $_noBody = false;
        $_includeHeader = false;
        $_binary = false;
        $_httpheader = array('Expect:');
        $_cookieFileLocation = storage_path('app/cookie.txt');// dirname(__FILE__).'/cookie.txt';
        $_useragent = 'Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:53.0) Gecko/20100101 Firefox/53.0';
        $_referer ="https://www.google.com/";

        $proxy = false;
        $proxy_host = '';
        $proxy_port = '';

        $authentication = false;
        $auth_name      = '';
        $auth_pass      = '';

        $_post = false;

        $s = curl_init();
        curl_setopt($s,CURLOPT_URL,$url);
        curl_setopt($s,CURLOPT_HTTPHEADER,$_httpheader);
        curl_setopt($s,CURLOPT_TIMEOUT,$_timeout);
        curl_setopt($s,CURLOPT_MAXREDIRS,$_maxRedirects);
        curl_setopt($s,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($s,CURLOPT_FOLLOWLOCATION,$_followlocation);
        curl_setopt($s,CURLOPT_COOKIEJAR,$_cookieFileLocation);
        curl_setopt($s,CURLOPT_COOKIEFILE,$_cookieFileLocation);
        curl_setopt($s,CURLOPT_USERAGENT,$_useragent);
        curl_setopt($s,CURLOPT_REFERER,$_referer);
        $_webpage = curl_exec($s);
        $_status = curl_getinfo($s,CURLINFO_HTTP_CODE);
        curl_close($s);

        $numRand = $_webpage;

        return $numRand;
    }

    public function spLogGetRucsunat(Request $request)
    {
        try{

            $ruc = $request->qry;

            $numRand = $this->getNumRand();
            $rtn = array();
            if($ruc != "" && $numRand!=false)
            {
                $data = array(
                    "nroRuc" => $ruc,
                    "accion" => "consPorRuc",
                    "numRnd" => $numRand
                );

                $url = "http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias";

                $_binary = false;
                $_post = true;
                $_postFields = http_build_query($data);
                $_httpheader = array('Expect:');
                $_cookieFileLocation = storage_path('app/cookie.txt'); // dirname(__FILE__).'/cookie.txt';
                $_useragent = 'Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:53.0) Gecko/20100101 Firefox/53.0';
                $_referer ="https://www.google.com/";

                $s = curl_init();
                curl_setopt($s,CURLOPT_URL,$url);
                curl_setopt($s,CURLOPT_HTTPHEADER,$_httpheader);
                curl_setopt($s,CURLOPT_TIMEOUT,30);
                curl_setopt($s,CURLOPT_MAXREDIRS,4);
                curl_setopt($s,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($s,CURLOPT_FOLLOWLOCATION,true);
                curl_setopt($s,CURLOPT_COOKIEJAR,$_cookieFileLocation);
                curl_setopt($s,CURLOPT_COOKIEFILE,$_cookieFileLocation);
                curl_setopt($s,CURLOPT_POST,$_post);
                curl_setopt($s,CURLOPT_POSTFIELDS,$_postFields);
                curl_setopt($s,CURLOPT_USERAGENT,$_useragent);
                curl_setopt($s,CURLOPT_REFERER,$_referer);
                $_webpage = curl_exec($s);
                $_status = curl_getinfo($s,CURLINFO_HTTP_CODE);
                curl_close($s);

                $Page = $_webpage;

                //RazonSocial
                $patron='/<input type="hidden" name="desRuc" value="(.*)">/';
                $output = preg_match_all($patron, $Page, $matches, PREG_SET_ORDER);
                if(isset($matches[0]))
                {
                    $RS = utf8_encode(str_replace('"','', ($matches[0][1])));
                    $rtn = array("RUC"=>$ruc,"RazonSocial"=>trim($RS));
                }

                //Telefono
                $patron='/<td class="bgn" colspan=1>Tel&eacute;fono\(s\):<\/td>[ ]*-->\r\n<!--\t[ ]*<td class="bg" colspan=1>(.*)<\/td>/';
                $output = preg_match_all($patron, $Page, $matches, PREG_SET_ORDER);
                if( isset($matches[0]) )
                {
                    $rtn["Telefono"] = trim($matches[0][1]);
                }

                // Condicion Contribuyente
                $patron='/<td class="bgn"[ ]*colspan=1[ ]*>Condici&oacute;n del Contribuyente:[ ]*<\/td>\r\n[\t]*[ ]+<td class="bg" colspan=[1|3]+>[\r\n\t[ ]+]*(.*)[\r\n\t[ ]+]*<\/td>/';
                $output = preg_match_all($patron, $Page, $matches, PREG_SET_ORDER);
                if( isset($matches[0]) )
                {
                    $rtn["Condicion"] = strip_tags(trim($matches[0][1]));
                }

                $busca=array(
                    "NombreComercial" 		=> "Nombre Comercial",
                    "Tipo" 					=> "Tipo Contribuyente",
                    "Inscripcion" 			=> "Fecha de Inscripci&oacute;n",
                    "Estado" 				=> "Estado del Contribuyente",
                    "Direccion" 			=> "Direcci&oacute;n del Domicilio Fiscal",
                    "SistemaEmision" 		=> "Sistema de Emisi&oacute;n de Comprobante",
                    "ActividadExterior"		=> "Actividad de Comercio Exterior",
                    "SistemaContabilidad" 	=> "Sistema de Contabilidad",
                    "Oficio" 				=> "Profesi&oacute;n u Oficio",
                    "ActividadEconomica" 	=> "Actividad\(es\) Econ&oacute;mica\(s\)",
                    "EmisionElectronica" 	=> "Emisor electr&oacute;nico desde",
                    "PLE" 					=> "Afiliado al PLE desde"
                );
                foreach($busca as $i=>$v)
                {
                    $patron='/<td class="bgn"[ ]*colspan=1[ ]*>'.$v.':[ ]*<\/td>\r\n[\t]*[ ]+<td class="bg" colspan=[1|3]+>(.*)<\/td>/';
                    $output = preg_match_all($patron, $Page, $matches, PREG_SET_ORDER);
                    if(isset($matches[0]))
                    {
                        $rtn[$i] = trim(utf8_encode( preg_replace( "[\s+]"," ", ($matches[0][1]) ) ) );
                    }
                }
            }
            else{
                throw new Exception("No fue posible conseguir el CAPTCHA de la web de SUNAT");
            }

            if( count($rtn) > 2 ){
                $msg = 'OK';
                $msgId = 200;
                $datos = $rtn;
            }
            else{
                throw new Exception("NO SE PUDO RECUPERAR LA INFORMACIÓN SOLICITADA");
            }

            /*$ruc = $request->qry;
            $url = 'https://ruc.com.pe/api/v1/ruc';
            $token = 'd7c910f3-78cb-4a50-bd3e-58659cc63833-e9199ee0-f598-459d-9588-81bcdbc5889e';

            $params = array("token"=>$token,"ruc"=>$ruc);
            $params_json = json_encode($params);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt(
                $curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                )
            );
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS,$params_json);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            //$data = file_get_contents("https://api.sunat.cloud/ruc/".$ruc);
            $data = curl_exec($curl);
            curl_close($curl);

            $info = json_decode($data, true);

            if(isset($info['errors'])){
                throw new Exception("Error: " . $info['errors']);
            }
            else{
                $msg = 'OK';
                $msgId = 200;

                $datos = $info;

                /*if($data==='[]' || $info['fecha_inscripcion']==='--'){
                    $datos = array(0 => 'nn');
                }
                else{
                    $datos = array(
                        0 => $info['ruc'],
                        1 => $info['razon_social'],
                        2 => date("d/m/Y", strtotime($info['fecha_actividad'])),
                        3 => $info['contribuyente_condicion'],
                        4 => $info['contribuyente_tipo'],
                        5 => $info['contribuyente_estado'],
                        6 => date("d/m/Y", strtotime($info['fecha_inscripcion'])),
                        7 => $info['domicilio_fiscal'],
                        8 => date("d/m/Y", strtotime($info['emision_electronica']))
                    );

                }*
            }*/

        }catch(Exception $e){
            $msg = $e->getMessage() . " - " . $e->getLine();
            $msgId = 500;
            $datos = null;
        }

        return response()->json(compact('datos','msg','msgId'));
    }

    public function spLogGetRuc(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetRUC ? ',   array(" where ruc='".$request->qry."'"));
        return  $result;
    }

    public function spLogSetUsrPss(Request $request)
    {
        $varReturn ["Result"]= \DB::select('exec spLogSetUsrPs ? ,? ', array(Auth::user()->usrID,\Hash::make(   $request->Pass)));
        return $varReturn;
    }

    public function spLogSetUsrPssReset(Request $request)
    {
        $varReturn ["Result"]= \DB::select('exec spLogSetUsrPs ? ,? ', array($request->idUser,\Hash::make($request->idUser)));
        return $varReturn;
    }

    public function spLogSetRuc(Request $request)
    {
        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_RUC'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                $varReturn["Result"]= \DB::select('exec spLogSetRUC ?,?,?,?,?,?  ,?,?,?,?', array( $request->OPE , $request->Ruc  ,$request->RSocial,$request->Dir ,$request->Tel,$request->Contacto,$request->EMail,$request->Web,\Hash::make($request->Otros),Auth::user()->usrID ));
                $varReturn["Flag"]= "0";
                return $varReturn ;
            }
            else  {
                $varReturn["Flag"]= "1";
                $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
                // $varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
                return $varReturn;
            }
        }
        else   {       $varReturn["Flag"]= "1";
            $varReturn["Result"]="No Tienes Permisos para realizar esta operacion";
            //$varReturn["Result"]= view('logistica.Adq.vwPermission')->render();
            return $varReturn;
        }
    }


    public function spLogSetCatalogo(Request $request)
    {
        $resultFull = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_CNF_PROD'  ));
        if( isset ($resultFull[0]->NEW ))
        {
            if( $resultFull[0]->NEW =="1") {
                $varReturn["Mensaje"] = \DB::select('exec spLogSetProd ?,?,? ', array( $request->OPE , $request->Cod  ,$request->Dsc ));
                $result= \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',array ('BNS',"",'2015'," where dsc like '%".$request->Dsc."%'"));
                $varReturn["Bns"] = view ('logistica.Partials.logProdDll',compact( 'result'))->render();
                return $varReturn;
            }
            else {
                $varReturn["Mensaje"]= \DB::connection('dblogistica')-> select(" SELECT Error='1',Mensaje='No tienes permisos, para esta operacion'");
                $varReturn["Bns"] = view('logistica.Adq.vwPermission')->render();
                return $varReturn ;
            }
        }
        else {
            $varReturn["Mensaje"]= \DB::connection('dblogistica')-> select(" SELECT Error='1',Mensaje='No tienes permisos, para esta operacion'");
            $varReturn["Bns"] = view('logistica.Adq.vwPermission')->render();
            return $varReturn ;
        }
    }

    public function spLogGetDatos(Request $request)
    {
        $qry ="";

        if($request->tipo =="COD" || $request->tipo=="CID" ){
            if($request->obj == 'SECFUN')
                $qry = " where RTRIM( lTRIM( cod)) = '" . substr('0000'. trim($request->valor),-4) ."'" ;
            else
                $qry = " where CAST( RTRIM( lTRIM( cod)) AS INT) = " . $request->valor;
        }
        else if($request->tipo == "STR")  {  $qry = " where RTRIM( lTRIM( cod)) = replace ( RTRIM( lTRIM('".$request->valor."')),' ','')"; } //$request->tipo
        else if($request->tipo =="DSC")  {  $qry = " where dsc like  '%" . $request->valor."%' "; }
        else { echo 'Error'; return; }
        //$result = \DB::select(' select dbo.fnLogGetGrlDat (?,?,?) as Dsc',array ('DEP',$request->valor,'0'));
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetDatosTmp ?,?,?,? ',array ($request->obj,$request->tipo,$request->anio,$qry));
        if($request->tipo=="DSC" || $request->tipo=="CID" )
        {
            $html= '<table  class="suggest-element table table-striped table-hover " STYLE="font-size: 12px;">' ;
            foreach($result as $nom)
            {$html.= '<tr><td  name = "tdCod" width="90px" align="center"><span style="font-size: 14px;"><strong>'.$nom->Cod.'</strong><span></td><td name = "tdDsc" style ="width:auto;">'.$nom->Dsc.'</td><TD width="40"> <button name = "'.$request->obj.'" codID="'.$nom->ID.'" class="btn btn-success btnItem " data-dismiss="modal" style="width:   35Px  ;height: 25px ; font-size:10px;  " type="button">O::</button></TD></tr>' ;}
            $html.='</table>';
            return $html ;
        }

        return  $result;
    }

    public function spLogGetBusy(Request $request)
    {
        $result = \DB::select(' select dbo.fnLogGetBusyObj (?,?) as Estado',array ($request->obj,$request->codigo));
        return  $result;
    }

    public function spLogGetCodNext(Request $request)
    {
        $result = \DB::select(' exec spLogGetCodNext ?,? ',array ($request->Anio,$request->Tipo));
        return  $result;
    }

    /*********************************************************************************************************************/
    /**** REQ SEGUIMIENTO ************************************************************************************************/
    public  function fnGetViewReqSg()
    {

        return view ('logistica.Adq.vwAdqReqSeg');
    }
    public  function     spLogGetReqSg( Request $request  )
    {
        $qry ="";      
        if($request->Tipo=="RQ") { $qry ="  and RQ.reqID like '%".$request->Valor."'";}
        else if($request->Tipo=="CZ") { $qry = " and CZ.ctzID like '%".$request->Valor."'";}
        else if($request->Tipo=="SF") { $qry =" and RQ.reqSecFun like '%".$request->Valor."'";}
        else if($request->Tipo=="DP") { $qry ="  and RQ.reqDep like '%".$request->Valor."'";}
        $result["Dll"]  = \DB::connection('dblogistica')-> select(' exec spLogGetReqSg ?,?,?,?,?,?',   array('',$request->Anio,'','','',$qry));

        return view ('logistica.Partials.logReqSg',compact('result'))->render();
    }

   public function spLogGetReqSgDll(Request $request)
    {
        $result = \DB::select('exec spLogGetReqD ?',array( $request->reqID));       
		$varReturn =  view ('logistica.Partials.logReqDll2',compact( 'result'));		
		return $varReturn ;
    }
     public  function spLogGetSegExcel($anio,$tipo,$valor)
    {
        $qry ="";      
        if($tipo=="RQ") { $qry =" and  RQ.reqAnio='".$anio."' and RQ.reqID like '%".$valor."'";}
        else if($tipo=="SF") { $qry =" and RQ.reqAnio='".$anio."' and RQ.reqSecFun like '%".$valor."'";}
        else if($tipo=="DP") { $qry =" and RQ.reqAnio='".$anio."' and RQ.reqDep like '%".$valor."'";}
        $result["Dll"]  = \DB::connection('dblogistica')-> select(' exec spLogGetReqSg ?,?,?,?,?,?',   array('',$anio,'','','',$qry));
        $varReturn= view ('logistica.Rpt.logXlsRQSeg',compact('result'));
        return $varReturn ;
    }

     public  function spLogGetSegDllExcel($id)
    {
         $result = \DB::select('exec spLogGetReqD ?',array( $id));       
        $varReturn =  view ('logistica.Rpt.logXlsReqSegDll',compact( 'result'));        
        return $varReturn ;
    }


	
	/*********************************************************************************************************************/
    /**** REPORTES ****** ************************************************************************************************/

   

    public function spRptRankingPdf($Doc,$FecIni,$FecFin)
    {
        $ReturnData["Usr"]=Auth::user()->usrID ;
        $ReturnData["Ranking"] = \DB::select('exec spLogGetRptProv  ?,?',array( '2016', " and  cast (Fecha as date) between '".$FecIni."' and '".$FecFin."' " ));

       $v = view("logistica.rptRptRanking",compact('ReturnData'))->render();
     /*   $pdf=\App::make('dompdf.wrapper');        
        $pdf->loadHTML($v)->setPaper('letter')->setOrientation('portrait');       
        return $pdf->stream();

*/  
           $optionsHeader = array('header-html' => 'http://slam.mdv.net/header', 'header-spacing' => 10);
            $optionsFooter = array('footer-html' => 'http://slam.mdv.net/footer', 'footer-line' => true, 'footer-spacing' => 5);
            $optionsPage = array('margin-top'=>15,'margin-bottom'=>20,'margin-left'=>10,'margin-right'=>10);

            $snappy = App::make('snappy.pdf.wrapper');
            //$snappy->setOptions($optionsHeader);
            $snappy->setOptions($optionsPage);
            $snappy->setOptions($optionsFooter);
            $snappy->loadHTML($v)->setPaper('a4')->setOrientation('portrait');

            return $snappy->stream('reporte.pdf');


    }

    public function spRptRankingExcel($Doc,$FecIni,$FecFin)
    {
        $result["Ranking"] = \DB::select('exec spLogGetRptProv  ?,?',array( '2017', " and  cast (Fecha as date) between '".$FecIni."' and '".$FecFin."' " ));
        $varReturn =  view ('logistica.Rpt.logXlsRanking',compact( 'result'));
        return $varReturn ;
    }


	public function spRptSeaceExcel($Doc,$TipoRpt,$FecIni,$FecFin)
    {
        $result["Seace"] = \DB::select('exec spLogGetOCSeace  ?,?,?',array( $TipoRpt ,'2017', " where  cast (Fecha as date) between '".$FecIni."' and '".$FecFin."' " ));
        $varReturn =  view ('logistica.Rpt.logXlsOCSeace',compact( 'result'));
        return $varReturn ;
    }
    public function spRptPriceExcel($TipoRpt,$FecIni,$FecFin)
    {
        $result["Seace"] = \DB::select('exec spLogGetRptPrice  ?,?',array( $TipoRpt , " where  cast (Fecha as date) between '".$FecIni."' and '".$FecFin."' " ));
        $varReturn =  view ('logistica.Rpt.logXlsPrice',compact( 'result'));
        return $varReturn ;
    }

    


    public function spRptExcel($Anio,$Doc,$TipoRpt,$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc)
    {
      $Doc='XLS';
      if      ($TipoRpt=="RQ")  { $result["RQ"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array( $Anio, $TipoRpt.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' )); }
      else if ($TipoRpt=="RQP"){
          $result["RQP"] = \DB::select('exec spLogGetProcReq ?,?,?', array($Anio,$FecIni,$FecFin));
      }
      else if ($TipoRpt=="CTZ")  { $result["CTZ"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($Anio, $TipoRpt.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' )); }
      else if ($TipoRpt=="CDR")  { $result["CDR"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($Anio, $TipoRpt.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' )); }
      else if ($TipoRpt=="OC")  { $result["OC"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($Anio, $TipoRpt.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' )); }
      else if ($TipoRpt=="OS")  { $result["OS"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($Anio, $TipoRpt.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' )); }
      else if ($TipoRpt=="CS")  {
                                  $result["OC"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($Anio, 'OC'.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' ));
                                  $result["OS"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($Anio, 'OS'.'-'.$Nivel,$FecIni,$FecFin,$SecFun,$Rubro,$TipoProc,$Ruc,'DLL' ));
      }
      if      ($TipoRpt=="OC" && $Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsOC',compact( 'result','Doc'));
      else if ($TipoRpt=="OS" && $Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsOS',compact( 'result','Doc'));
      else if ($TipoRpt=="CDR" && $Nivel=="GRL")      $varReturn =  view ('logistica.Rpt.logXlsCDR',compact( 'result','Doc'));
      else if ($TipoRpt=="CS" && $Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsCS',compact( 'result','Doc'));
      else if ($TipoRpt=="RQ" && $Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsRQ',compact( 'result','Doc'));
      else if ($TipoRpt=="CTZ" && $Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsCTZ',compact( 'result','Doc'));

      else if ($TipoRpt=="OC" && $Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsOCDll',compact( 'result','Doc'));
      else if ($TipoRpt=="OS" && $Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsOSDll',compact( 'result','Doc'));
      else if ($TipoRpt=="CS" && $Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsCSDll',compact( 'result','Doc'));
      else if ($TipoRpt=="CDR" && $Nivel=="DLL")      $varReturn =  view ('logistica.Rpt.logXlsCDRDll',compact( 'result','Doc'));
      else if ($TipoRpt=="RQ" && $Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsRQDll',compact( 'result','Doc'));

      else if($TipoRpt=="RQP") $varReturn = view('logistica.Rpt.logXlsRQProc', compact('result','Doc'));

      return $varReturn ;
    }
    public function spRptView(Request $request)
    {
        $Doc='SHOW';
        if      ($request->TipoRpt=="RQ")  { $result["RQ"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array( $request->Anio,$request->TipoRpt.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' )); }
        else if ($request->TipoRpt=="RQP"){
            $result["RQP"] = \DB::select('exec spLogGetProcReq ?,?,?', array($request->Anio,$request->FecIni,$request->FecFin));
        }
        else if ($request->TipoRpt=="CTZ")  { $result["CTZ"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array( $request->Anio, $request->TipoRpt.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' )); }
        else if ($request->TipoRpt=="CDR")  { $result["CDR"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($request->Anio,  $request->TipoRpt.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' )); }
        else if ($request->TipoRpt=="OC")  { $result["OC"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array($request->Anio,  $request->TipoRpt.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' )); }
        else if ($request->TipoRpt=="OS")  { $result["OS"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,?,? ,?,?,?',array( $request->Anio, $request->TipoRpt.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' )); }
        else if ($request->TipoRpt=="CS")  {
            $result["OC"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,? ,?,?,?',array( $request->Anio, 'OC'.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' ));
            $result["OS"] = \DB::select('exec spLogGetRptGrl  ?,?,?,?,? ,?,?,?',array( $request->Anio, 'OS'.'-'.$request->Nivel,$request->FecIni,$request->FecFin,$request->SecFun,$request->Rubro,$request->TipoProc,$request->Ruc,'DLL' ));
        }

        if      ($request->TipoRpt=="OC" && $request->Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsOC',compact( 'result','Doc'))->render();
        else if ($request->TipoRpt=="OS" && $request->Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsOS',compact( 'result','Doc'));
        else if ($request->TipoRpt=="CS" && $request->Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsCS',compact( 'result','Doc'));
        else if ($request->TipoRpt=="CDR" && $request->Nivel=="GRL")      $varReturn =  view ('logistica.Rpt.logXlsCDR',compact( 'result','Doc'));
        else if ($request->TipoRpt=="CTZ" && $request->Nivel=="GRL")      $varReturn =  view ('logistica.Rpt.logXlsCTZ',compact( 'result','Doc'));
        else if ($request->TipoRpt=="RQ" && $request->Nivel=="GRL")       $varReturn =  view ('logistica.Rpt.logXlsRQ',compact( 'result','Doc'));

        else if ($request->TipoRpt=="OC" && $request->Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsOCDll',compact( 'result','Doc'));
        else if ($request->TipoRpt=="OS" && $request->Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsOSDll',compact( 'result','Doc'));
        else if ($request->TipoRpt=="CS" && $request->Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsCSDll',compact( 'result','Doc'));
        else if ($request->TipoRpt=="CDR" && $request->Nivel=="DLL")      $varReturn =  view ('logistica.Rpt.logXlsCDRDll',compact( 'result','Doc'));
        else if ($request->TipoRpt=="RQ" && $request->Nivel=="DLL")       $varReturn =  view ('logistica.Rpt.logXlsRQDll',compact( 'result','Doc'));

        else if($request->TipoRpt=="RQP") $varReturn = view('logistica.Rpt.logXlsRQProc', compact('result','Doc'));

        return $varReturn ;
    }

    /**************/

    public  function    spLogGetRpt($prAnio, $prTipoRpt,$prFecIni , $prFecFin  , $prSecFun   ,$prTipoProc , $prRubro , $prRuc, $prNivel)
    {        

        $nom = rand(1,999);
        $file = fopen("rpt.txt", "w");
        fwrite($file, trim($prAnio) .PHP_EOL);  
        fwrite($file, trim($prTipoRpt) .PHP_EOL);  
        fwrite($file, trim($prFecIni) . PHP_EOL);       
        fwrite($file, trim($prFecFin) . PHP_EOL);       
        fwrite($file, trim($prSecFun) . PHP_EOL);       
        fwrite($file, trim($prTipoProc) . PHP_EOL);       
        fwrite($file, trim($prRubro) . PHP_EOL);       
        fwrite($file, trim($prRuc) . PHP_EOL);       
        fwrite($file, trim($prNivel) . PHP_EOL);       
        fwrite($file, trim(Auth::user()->usrID.'-'.$nom) . PHP_EOL);              
        fclose($file);
        exec("iRpt.exe");
         $Doc=Auth::user()->usrID.'-'.$nom.'.pdf';       
        $ReturnData = view('logistica.Partials.logRptPdf', compact('Doc'))->render();
        return  $ReturnData ; 
    }

    /*********************************/

 /******************** OTHER  DATABASE  CONNECTIONS  *********************************************/
    /*************************************************************************************************/

     public function spGetSeg(Request $request)
    {
       
        $col = "";
        $cod =  "000000000".$request->Codigo;
        if ($request->Tipo=="RQ") $cod = substr ($cod, -7);
        else $cod = substr ($cod, -5);
        $pref =  $request->Tipo."". substr ($request->Anio,-2)."".$cod;
        if ($request->Tipo=="OC" ) $col  = "orcID" ;
        else if ($request->Tipo=="OS") $col  = "orsID" ;
        else if ($request->Tipo=="CD") $col  = "orcCdr" ;
        else if ($request->Tipo=="CZ") $col  = "orcCtz" ;
        else if ($request->Tipo=="RQ") $col  = "orcReq" ;
        else if ($request->Tipo=="EX") $col  = "expExp" ;

        //$result = \DB::connection('dbConsulta')-> select(' exec spLiqGetSegExp ? ',   array( " where ".$col." like '".$pref."'"));
        $result = \DB::connection('dblogistica')-> select("select * from  vwSegExp  where ".$col." like '".$pref."'");
        
        
        if(strlen ($result[0]->cadExp ) > 5)
        {

            $file = fopen("iSiafSeg.txt", "w");
            // fwrite($file, trim($request->Anio) .PHP_EOL);
            fwrite($file, trim($request->Anio) .PHP_EOL);
            fwrite($file, trim($result[0]->idTmp) .PHP_EOL);
            fwrite($file, trim($result[0]->cadExp) .PHP_EOL);
            fclose($file);
            exec("iSiafSeg.exe");
        }
       

        
       
        $result = \DB::connection('dblogistica')-> select(' exec spLiqGetSegExp ?,? ',   array( $request->Tipo ," where ".$col." like '".$pref."'"));
        return   view ('logistica.Partials.result-consult',compact( 'result'))->render();
    
    }


     public function spLiqGetSecFun(Request $request )
    {
        if($request->prAnio == '2016' || $request->prAnio == '2017' || $request->prAnio == '2018')
        {
//            $result = \DB::connection('dblogistica')-> select("   Select secid as id ,substring(secid,6,4) as cod,  +' ( '+ substring(secid,6,4)+' ) '+ secDsc  as dsc from TPreSF where   '20'+substring(secid,3,2) = "    .$request->prAnio. " and substring (secid,6,4)= ".$request->prCodSecFun);
            $result = \DB::connection('dbCli')-> select("   Select codObra as id, substring (CodObra,7,4) as cod,  ' ( '+substring (CodObra,7,4)+' ) '+   Denominacion as dsc from Proy  where    substring(CodObra,3,4) =" .$request->prAnio. " and substring (CodObra,7,4)= ".$request->prCodSecFun);
        }
        else if($request->prAnio == '2015' ||  $request->prAnio == '2014')
        {
            $result = \DB::connection('dbCli')-> select("   Select codObra as id, substring (CodObra,7,4) as cod,  ' ( '+substring (CodObra,7,4)+' ) '+   Denominacion as dsc from Proy  where    substring(CodObra,3,4) =" .$request->prAnio. " and substring (CodObra,7,4)= ".$request->prCodSecFun);
        }
        else if($request->prAnio == '2013' ||  $request->prAnio == '2012' ||  $request->prAnio == '2011')
        {
            $result = \DB::connection('dbSvl')-> select("   Select meta as id ,  substring (Meta,3,4) as cod,   ' ( '+substring (Meta,3,4)+' ) '+  Descripción as dsc from log_Meta where  '20'+substring(Meta,1,2) = "     .$request->prAnio. " and substring (Meta,3,4)= ".$request->prCodSecFun);
        }
        else 
        {
            $result = null;   
        }
        return  $result;
    }
 


    public  function fnGetViewLiqCS()
    {
        return view ('logistica.Adq.vwLiqCS');
    }



/*****************************/

 public  function    spLiqGetCS( Request $request  )
    {
        $Doc='SHOW';
        $tipoOrd = $request->orden;

         if($request->prAnio == '2016' || $request->prAnio == '2017' || $request->prAnio == '2018')
        {
//            $resultTar = \DB::connection('dblogistica')->select('exec spLiqGetTar ?,?', array(  $request->prTipo,$request->prCodSecFun ));
//             $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSLDll', compact('resultTar','Doc'))->render();
             $resultTar = \DB::connection('dbCli')->select('exec spLiqGetCSSIA ?,?,?', array(  $request->prTipo,$request->prCodSecFun,$tipoOrd ));
             if($request->prTipo =="DLL"){
                 if($tipoOrd == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDll', compact('resultTar','Doc','tipoOrd'))->render();
                 else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDllOS', compact('resultTar','Doc','tipoOrd'))->render();
             }
             else{
                 if($tipoOrd == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSI', compact('resultTar','Doc','tipoOrd'))->render();
                 else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIOS', compact('resultTar','Doc','tipoOrd'))->render();
             }
        }
        else if($request->prAnio == '2015' ||  $request->prAnio == '2014')
        {
             $resultTar = \DB::connection('dbCli')->select('exec spLiqGetCSSIA ?,?,?', array(  $request->prTipo,$request->prCodSecFun,$tipoOrd ));
             if($request->prTipo =="DLL"){
                 if($tipoOrd == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDll', compact('resultTar','Doc','tipoOrd'))->render();
                 else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDllOS', compact('resultTar','Doc','tipoOrd'))->render();
             }
             else{
                 if($tipoOrd == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSI', compact('resultTar','Doc','tipoOrd'))->render();
                 else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIOS', compact('resultTar','Doc','tipoOrd'))->render();
             }
        }
        else if($request->prAnio == '2013' ||  $request->prAnio == '2012'  ||  $request->prAnio == '2011' )
        {
            $resultTar = \DB::connection('dbSvl')->select('exec spLiqGetCSSVL ?,?', array( $request->prTipo ,$request->prCodSecFun ));
            if($request->prTipo =="DLL")   $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSVDll', compact('resultTar','Doc'))->render();
            else                           $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSV', compact('resultTar','Doc'))->render();
        }      
        return  $ReturnData ;
    } 
  

    public  function    spLiqGetCSExcel(  $prAnio , $prCodSecFun , $prTipo, $prOrdn )
    {
        $Doc='XLS';
       
         if($prAnio == '2016' || $prAnio == '2017' || $prAnio == '2018')
        {
//            $resultTar = \DB::connection('dblogistica')->select('exec spLiqGetTar ?,?', array(  $prTipo,$prCodSecFun ));
//            if($prTipo =="DLL")   $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSLDll', compact('resultTar','Doc'))->render();
//            else                  $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSL', compact('resultTar','Doc'))->render();

             $resultTar = \DB::connection('dbCli')->select('exec spLiqGetCSSIA ?,?,?', array(  $prTipo,$prCodSecFun, $prOrdn ));
             if($prTipo =="DLL"){
                 if($prOrdn == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDll', compact('resultTar','Doc'))->render();
                 else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDllOS', compact('resultTar','Doc'))->render();
             }
             else{
                 if($prOrdn == 'oc')
                     $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSI', compact('resultTar','Doc'))->render();
                 else
                     $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIOS', compact('resultTar','Doc'))->render();
             }

        }
        else if($prAnio == '2015' ||  $prAnio == '2014')
        {
             $resultTar = \DB::connection('dbCli')->select('exec spLiqGetCSSIA ?,?,?', array(  $prTipo,$prCodSecFun, $prOrdn ));
              if($prTipo =="DLL"){
                  if($prOrdn == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDll', compact('resultTar','Doc'))->render();
                  else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIDllOS', compact('resultTar','Doc'))->render();
              }
              else{
                  if($prOrdn == 'oc')
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSI', compact('resultTar','Doc'))->render();
                  else
                    $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSIOS', compact('resultTar','Doc'))->render();
              }
        }
        else if($prAnio == '2013' ||  $prAnio == '2012'  ||  $prAnio == '2011' )
        {
            $resultTar = \DB::connection('dbSvl')->select('exec spLiqGetCSSVL ?,?', array( $prTipo ,$prCodSecFun ));
            if($prTipo =="DLL")   $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSVDll', compact('resultTar','Doc'))->render(); 
            else                  $ReturnData["liqCSDll"] = view('logistica.Partials.liqCSSV', compact('resultTar','Doc'))->render(); 
        }     
        return  $ReturnData ["liqCSDll"]  ;
    }

    public function fnGetViewNotify(Request $request){

        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_LOG_NTF'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                $almacen = almAlmacen::all();
                $medios = logTbNotif::all();
                $view = view('logistica.Adq.vwNotify', compact('almacen','medios'));
                return $view;
            }
            else {
                return view('logistica.Adq.vwPermission');
            }
        }
        else {
            return view('logistica.Adq.vwPermission');
        }
    }




}
