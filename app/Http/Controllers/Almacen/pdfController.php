<?php

namespace Logistica\Http\Controllers\Almacen;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almNeaInternamiento;
use Logistica\Almacen\almProcesoInternamiento;
use Logistica\Almacen\almProcesoInternamientoB;
use Logistica\Almacen\almProcesoSalida;
use Logistica\Almacen\almProcesoSalidaB;
use Logistica\Almacen\almTLogOC;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

class pdfController extends Controller
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

    public function getPdfGuiaSheet($gi, $pi, Request $request)
    {
        $guia = almInternamiento::find($gi);
        $proceso = almProcesoInternamiento::where('cod_giu',$gi)->get();
        $bienes = almProcesoInternamientoB::where('pintp_cpi',$pi)->get();
        $oc = almTLogOC::find($guia->oc_cod);

        /* PARA FORMATO ESPECIAL PARA CONVENIO MARCO PRIMEROS REGISTROS */
      //  $checkCMarco = array('OC1600044','OC1600040','OC1600030','OC1600035','OC1600034','OC1600042','OC1600033','OC1600032','OC1600036','OC1600045','OC1600039','OC1600041','OC1600043','OC1600031');
 $checkCMarco = array(      'OC1600030',
'OC1600030',
'OC1600031',
'OC1600032',
'OC1600033',
'OC1600034',
'OC1600035',
'OC1600036',
'OC1600038',
'OC1600039',
'OC1600040',
'OC1600041',
'OC1600042',
'OC1600043',
'OC1600044',
'OC1600045',
'OC1600068',
'OC1600084',
'OC1600104',
'OC1600105',
'OC1600106',
'OC1600107',
'OC1600108',
'OC1600109',
'OC1600110',
'OC1600111',
'OC1600112',
'OC1600113',
'OC1600114',
'OC1600115',
'OC1600116',
'OC1600117',
'OC1600118',
'OC1600119',
'OC1600120',
'OC1600121',
'OC1600156',
'OC1600157',
'OC1600158',
'OC1600159',
'OC1600160',
'OC1600161',
'OC1600162',
'OC1600163',
'OC1600164',
'OC1600165',
'OC1600166',
'OC1600167',
'OC1600168',
'OC1600169',
'OC1600170',
'OC1600171',
'OC1600172',
'OC1600173',
'OC1600174',
'OC1600177',
'OC1600247',
'OC1600249',
'OC1600250',
'OC1600251',
'OC1600287',
'OC1600288',
'OC1600289',
'OC1600290',
'OC1600291',
'OC1600292',
'OC1600293',
'OC1600294',
'OC1600295',
'OC1600296',
'OC1600297',
'OC1600298',
'OC1600300',
'OC1600305',
'OC1600306',
'OC1600307',
'OC1600308',
'OC1600321',
'OC1600322',
'OC1600323',
'OC1600324',
'OC1600325',
'OC1600335',
'OC1600336',
'OC1600337',
'OC1600338',
'OC1600339',
'OC1600340',
'OC1600342',
'OC1600345',
'OC1600346',
'OC1600347',
'OC1600348',
'OC1600349',
'OC1600350',
'OC1600360',
'OC1600361',
'OC1600362',
'OC1600367',
'OC1600379',
'OC1600380',
'OC1600381',
'OC1600382',
'OC1600386',
'OC1600387',
'OC1600388',
'OC1600389',
'OC1600390',
'OC1600391',
'OC1600392',
'OC1600393',
'OC1600416',
'OC1600426',
'OC1600443',
'OC1600444',
'OC1600455',
'OC1600456',
'OC1600466',
'OC1600468',
'OC1600511',
'OC1600523',
'OC1600524',
'OC1600539',
'OC1600540',
'OC1600541',
'OC1600547',
'OC1600548',
'OC1600549',
'OC1600553',
'OC1600554',
'OC1600555',
'OC1600556',
'OC1600557',
'OC1600558',
'OC1600559',
'OC1600560',
'OC1600570',
'OC1600571',
'OC1600572',
'OC1600578',
'OC1600591',
'OC1600599',
'OC1600602',
'OC1600611',
'OC1600612',
'OC1600617',
'OC1600618',
'OC1600624',
'OC1600625',
'OC1600664',


);

        $orc = null;
        if(in_array(trim($guia->oc_cod),$checkCMarco))
        {
            $orc = almTLogOC::find($guia->oc_cod);
        }

        if($guia->oc_tipoProceso == '009'  )
        {
            $orc = almTLogOC::find($guia->oc_cod);
        }
       else
        {
            if($oc != null && $oc->orcIGV == 'SI')
            {
                $orc = almTLogOC::find($guia->oc_cod);
            }
        }

        /******************************************************************/

        $view = view('almacen.pdf.pdfGi',['guia'=>$guia, 'proceso'=>$proceso, 'bienes'=>$bienes, 'orden'=>$orc]);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('letter','landscape');
        return $pdf->stream('gi.pdf');
    }

    public function getPdfPecosaSheet($ps)
    {
        /*$guia = almInternamiento::find($gi);*/
        $proceso = almProcesoSalida::with('productos_distribuidos')
                    ->select('*')
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('DEP', psal_dependencia_solic, '') AS dependencia_solic"))
                    ->where('psal_pecosa',$ps)
                    ->get();

        $guia = almInternamiento::with('inventario')
                    ->where('ing_giu',$proceso[0]->ing_giu)
                    ->get();

        $oc = almTLogOC::find($guia[0]->oc_cod);

        /* PARA FORMATO ESPECIAL PARA CONVENIO MARCO PRIMEROS REGISTROS */
  //      $checkCMarco = array('OC1600044','OC1600040','OC1600030','OC1600035','OC1600034','OC1600042','OC1600033','OC1600032','OC1600036','OC1600045','OC1600039','OC1600041','OC1600043','OC1600031');


        $orc = null;
        /*if(in_array(trim($guia[0]->oc_cod),$checkCMarco))
        {
            $orc = almTLogOC::find($guia[0]->oc_cod);
        }*/

        if($guia[0]->oc_tipoProceso == '009' && ltrim( $oc->orcIGV) == 'SI')
        {
            $orc = almTLogOC::find($guia[0]->oc_cod);
        }

         if ( $oc->orcID== 'OC1601275')
        {
             $orc = almTLogOC::find($data[0]->oc_cod);
        }
        
        /*else
        {
            if($oc != null && $oc->orcIGV == 'SI')
            {
                $orc = almTLogOC::find($guia[0]->oc_cod);
            }
        }
*/
        /******************************************************************/
        $orc = null;

        $resClasificador = \DB::connection('dblogistica')->select('exec spLogGetOCAbsClasf ?',array(  $oc->orcID ));
        $resCuenta = \DB::connection('dblogistica')->select('exec spLogGetOCAbsCta ?', array($oc->orcID));

        $view = view('almacen.pdf.pdfPs',['guia'=>$guia, 'proceso'=>$proceso, 'orden'=>$orc, 'resClasificador' => $resClasificador, 'resCuenta' => $resCuenta]);
        $pdf = App::make('dompdf.wrapper'); 
         

        $pdf->loadHTML($view)->setPaper('letter')->setOrientation('landscape');
        //$pdf->loadHTML($view)->setPaper('letter')->setOrientation('portrait');

        return $pdf->stream('ps.pdf');

        /*
        $optionsHeader = array('header-html' => 'http://localhost/slam/public/header');
        $optionsFooter = array('footer-html' => 'Holaaa', 'footer-line' => true);
        $optionsPage = array('margin-top'=>10,'margin-bottom'=>20,'margin-left'=>10,'margin-right'=>10);

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->setOptions($optionsHeader);
        $pdf->setOptions($optionsPage);
        $pdf->setOptions($optionsFooter);
        $pdf->loadHTML($view)->setPaper('a4')->setOrientation('landscape');

        return $pdf->stream();*/
    }

    public function getPdfActaPreview($gi,$cpi,Request $request)
    {
        $data = almInternamiento::with('inventario')
                    ->with('ingresos')
                    ->join('Almacen','id','=','ing_almacen')
                    ->where('ing_giu',$gi)
                    ->get();

        $applicant = almTLogOC::select('reqSolicitante','perNombres','perAPaterno','perAMaterno','orcReq','orcIGV')
                    ->join('TLogReq','orcReq','=','reqID')
                    ->join('TPerPrs','reqSolicitante','=','perID')
                    ->where('orcID',$data[0]->oc_cod)
                    ->get();

        $oc = almTLogOC::find($data[0]->oc_cod);

        $proceso = almProcesoInternamiento::find($cpi);
        $bienes = almProcesoInternamientoB::where('pintp_cpi',$cpi)->get();

        /* PARA FORMATO ESPECIAL PARA CONVENIO MARCO PRIMEROS REGISTROS */
 //       $checkCMarco = array('OC1600044','OC1600040','OC1600030','OC1600035','OC1600034','OC1600042','OC1600033','OC1600032','OC1600036','OC1600045','OC1600039','OC1600041','OC1600043','OC1600031');


        $orc = null;
        //if(in_array(trim($data[0]->oc_cod),$checkCMarco))
        if($data[0]->oc_tipoProceso == '009' && $oc->orcIGV == 'SI'  )
        {
            $orc = almTLogOC::find($data[0]->oc_cod);
        }
        if ( $oc->orcID== 'OC1601275')
        {
             $orc = almTLogOC::find($data[0]->oc_cod);
        }
      /*  else
        {
            if($oc->orcIGV == 'SI')
            {
                $orc = almTLogOC::find($data[0]->oc_cod);
            }
        }
*/
        $view = view('almacen.pdf.pdfActa',['data'=>$data, 'applicant'=>$applicant, 'proceso'=>$proceso, 'bienes'=>$bienes, 'orden'=>$orc]);
        return $view;
    }

    public function getPdfNeaSheet($nea, Request $request)
    {
        $data = almInternamiento::with('inventario')
            ->with('ingresos')
            ->join('Almacen','id','=','ing_almacen')
            ->where('ing_giu',$nea)
            ->get();

        $nea = almNeaInternamiento::where('ing_nea',$nea)->get();

        $view = view('almacen.pdf.pdfNota',['data'=>$data,'nea'=>$nea]);
        return $view;
    }
}
