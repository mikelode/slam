<?php

namespace Logistica\Http\Controllers\logistica;

use Illuminate\Http\Request;
use  Barryvdh\DomPDF;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use PhpParser\Node\Expr\Array_;

class controllerReq extends Controller
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
    public  function fnGetViewReq()
    {
        return view ('logistica.Adq.vwAdqReq');
    }
    public function spLogGetDatos(Request $request)
    {
        $qry ="";
        if($request->tipo=="COD" || $request->tipo=="CID" )  {  $qry = " where cast ( cod  as int) = " . $request->valor; }
        if($request->tipo=="DSC")  {  $qry = " where dsc like  '%" . $request->valor."%' "; }
        //$result = \DB::select(' select dbo.fnLogGetGrlDat (?,?,?) as Dsc',array ('DEP',$request->valor,'0'));
        $result = \DB::connection('dblogistica')-> select(' exec spLogGetDatos ?,?,?,? ',array ($request->obj,$request->tipo,'2015',$qry));
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
    public function spLogSetReqD(Request $request)
    {
        $codReq = $request["datos"]["reqID"];
        $varReturn["Flg"]="1";
        $qry = \DB::select('exec spLogSetReqD ?,?,?,?,?  ,?,?,?,?,? ',
        array( $request["lista"]["OPE"] , $request["lista"]["ID"]  ,$codReq  , $request["lista"]["prodID"],   $request["lista"]["prodUndID"],$request["lista"]["prodClasfID"],$request["lista"]["prodCant"],$request["lista"]["prodPrecioUnt"],$request["lista"]["prodEspf"],$request["datos"]["reqUsr"] ));
        if ($qry[0]->Error=="0") { $varReturn["Flg"]="0";}
        $result = \DB::select('exec spLogGetReqD ?',array( $codReq));
        $varReturn["ReqDll"] =  view ('logistica.Partials.logReqDll',compact( 'result'))->render();
        return  $varReturn;
    }

    public function spLogGetReqBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select(' select dbo.fnLogGetCodRq( dbo.fnLogGetRqKy(?) ) as Codigo',   array($request->Anio));
        return  $result;
    }

    public function spLogSetReqBusy(Request $request )
    {
        $result = \DB::connection('dblogistica')-> select('exec spLogSetReqBusy ?,?',   array($request->Anio,$request->Usr));
       return  $result;
    }

    public function spLogSetReq(Request $request)
    {
        sleep(1);
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
                '01'
            ,   $request["datos"]["reqLugarEnt"],
                'AD',
                $request["datos"]["reqTipoGto"],
                $request["datos"]["reqObsv"],
                $request["datos"]["reqUsr"],
                $request["datos"]["reqObj"]
            ));

        if( $request["datos"]["reqOPE"]=="ADD")
        {
            $idReq= $result[0]->ReqNo ;
            $ErrorDtll=array();
            if($idReq=="NN") { return response()->json($result); ; }
            foreach ($request["lista"] as $key => $valor)
            {
                 $resultDetalles = \DB::select('exec spLogSetReqD ?,?,?,?,?  ,?,?,?,?,? ',
                   array( 'ADD', 0  ,$idReq  , $valor["prod"], $valor["und"],$valor["clasf"],$valor["cant"],$valor["precioUnt"],$valor["espf"],$request["datos"]["reqUsr"] ));
                    if ($resultDetalles[0]->ReqNo == "NN")
                    {
                        array_push($ErrorDtll, array('ReqNo' => $resultDetalles[0]->ReqNo, 'Error' => '1', 'Mensaje' => ' NO se registro : ' . $valor["prod"]));
                    }
            }
            if (count($ErrorDtll) > 0) {    return response()->json($ErrorDtll);      }
        }
        return  response()->json ($result );
    }

    public function spLogGetReq(Request $request)
    {
        sleep(1);
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  $request->prRows, $request->prAnio, $request->prQry ));
        $result = \DB::select('exec spLogGetReqD ?',array(  $ReturnData["Req"][0]->reqID));      //  dd($dll);
        $ReturnData["ReqDll"] =   view ('logistica.Partials.logReqDll',compact('result'))->render();
        return  $ReturnData ;
    }
    public function spLogGetReqTmp(Request $request)
    {
        sleep(1);
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ','2015', '' ));
        $ReturnData["ReqDll"] = \DB::select('exec spLogGetReqD ?',array( $ReturnData["Req"][0]->reqID));      //  dd($dll);
        return  $ReturnData ;
    }
    public function spLogGetReqPrint($id )
    {
        $ReturnData["Req"] = \DB::select('exec spLogGetReq ?,?,?', array(  ' top 1 ','2015', " where reqid = '".$id."' " ));
        $ReturnData["ReqDll"] = \DB::select('exec spLogGetReqD ?',array(  $id ));
        $ReturnData["ReqAbsClasf"] = \DB::select('exec spLogGetReqAbsClasf ?',array(  $id ));
        $v = view("logistica.rptAdqReq",compact('ReturnData'))->render();
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($v)->setPaper('a4')->setOrientation('horizontal')->setWarnings(false);
        return $pdf->stream();
    }



  /*  public function spLogGetReqD($idReq)
    {
       $result = \DB::select('exec spLogGetReqD ?', $idReq);
        RETURN view ('logistica.Partials.logReqDll',compact('result'))->render();
    }
*/












    //return  response()->json ($result );
    /*  $html= '' ;
      $html.= '<table    id="tbProdBienes" class="suggest-element table table-striped table-hover" style="font-size:11px; padding=0px; margin-top:-15px; line-height:12px; border-spacing: 0px; " cellpadding="0px" cellspacing="0px">   ';
      $html.= '             <thead align="center">  ';
      $html.= '              <tr>  ';
      $html.= '                 <th WIDTH="0px" style="display: none" ></th>  ';
      $html.= '                 <th WIDTH="55px"  align="center"   valign="center">Cant</th>  ';
      $html.= '            <th WIDTH="80px"  align="center"   valign="center">Clasificador</th> ';
      $html.= '           <th WIDTH="600px" align="left"     valign="center">Descripcion</th>';
      $html.= '            <th WIDTH="60px"  align="center"   valign="center">Unidad</th> ';
      $html.= '                         <th WIDTH="400px" align="left"     valign="center">Especificaciones</th> ';
      $html.= '                         <th WIDTH="100px" align="center"    valign="center">Precio   </th> ';
      $html.= '                         <th WIDTH="100px" align="right"    valign="center">Total</th> ';
      $html.= '                         <th valign="right" >Editar</th> ';
      $html.= '                         <th align="right">Borrar</th> ';
      $html.= '                      </tr>';
      $html.= '                     </thead>';

      $html.= '<tr class="fila-Hide"> ';
      $html.= '  <td name="tdID"  style="display: none" >1</td> ';
      $html.= '  <td name="tdCant"  align="center" >2</td> ';
      $html.= '  <td name="tdClasf" align="center" >3</td> ';
      $html.= '  <td name="tdProd"  align="left"   >4</td> ';
      $html.= '  <td name="tdUnd"  align="center"  >5</td> ';
      $html.= '  <td name="tdEspf"  align="left"   >6</td> ';
      $html.= '  <td name="tdPrecio" align="center">7</td> ';
      $html.= '  <td name="tdTotal"  align="center">8</td> ';
      $html.= '  <td BGCOLOR="#d9edf7"><button id="btnLogItemEDIT" class="btn btn-warning editRow" style="width:   45Px  ;height: 25px ; padding=0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td> ';
      $html.= '  <td BGCOLOR="#d9edf7" ><button id="btnLogItemDEL" class="btn btn-danger deleteRow" style="width: 30px  ;height: 25px ; padding=0; font-size:10px;  " type="button">X</button> </td> ';
      $html.= '</tr> ';

      foreach($result as $nom) {
          $html .= '<tr > ';
          $html .= '  <td name="tdID"  style="display: none" >' . $nom->dllID . '</td> ';
          $html .= '  <td name="tdCant"  align="center" >' . $nom->dllCant . '</td> ';
          $html .= '  <td name="tdClasf" align="center" codID="' . $nom->dllClasfID . '" >' . $nom->dllClasfCod . '</td> ';
          $html .= '  <td name="tdProd"  align="left"  codID="' . $nom->dllProdID . '"  >' . $nom->dllProdDsc . '</td> ';
          $html .= '  <td name="tdUnd"  align="center" codID="' . $nom->dllUndID . '"  >' . $nom->dllUndAbrv . '</td> ';
          $html .= '  <td name="tdEspf"  align="left"   >' . $nom->dllProdEspf . '</td> ';
          $html .= '  <td name="tdPrecio" align="center">' . $nom->dllPrecio . '</td> ';
          $html .= '  <td name="tdTotal"  align="center">' . $nom->dllTotal . '</td> ';
          $html .= '  <td BGCOLOR="#d9edf7"><button id="btnLogItemEDIT" class="btn btn-warning editRow" style="width:   45Px  ;height: 25px ; padding=0; padding-left: -10px; font-size:9px;  " type="button">EDIT</button> </td> ';
          $html .= '  <td BGCOLOR="#d9edf7" ><button id="btnLogItemDEL" class="btn btn-danger deleteRow" style="width: 30px  ;height: 25px ; padding=0; font-size:10px;  " type="button">X</button> </td> ';
          $html .= '</tr> ';
      }
      $html .= ' ';
      return $html ;*/

}
