<?php

namespace Logistica\Http\Controllers\Almacen;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Logistica\Almacen\almAlmacen;
use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almProcesoSalida;
use Logistica\Almacen\almTLogContPlan;
use Logistica\Almacen\almTPreSF;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;

class reporteController extends Controller
{

    public function _construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

           $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_ALM_RPT'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {

                $cuentas = almTLogContPlan::where('pcgActivo', true)->get();
                $almacen = almAlmacen::all();
                return view('almacen.reporte.panel-reporte',compact('almacen','cuentas'));

            }
            else {
                return view('logistica.Adq.vwPermission');
            }
        }
        else {
            return view('logistica.Adq.vwPermission');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {/*
        $database = \Config::get('database.connections.dbalmacen');
        $output = public_path().'/reports/'.'gi';

        $ext = 'pdf';

        $giu = 'GI1500359';
        $cpi = 'PI00359-001';

        \JasperPHP::process(
            public_path() . '/reports/gi.jasper',
            $output,
            array($ext),
            array("my_giu" => $giu, "my_cpi" => $cpi),
            $database,
            false,
            false
        )->execute();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.'gi.'.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: '.filesize($output.'.'.$ext));
        flush();
        readfile($output.'.'.$ext);
        unlink($output.'.'.$ext);

        return Redirect::to('/reporting');*/
    }

    public function testReport()
    {/*
        $jasper = new JasperPHP();

        $jasper->compile(__DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world.jrxml')->execute();

        $jasper->process(
            __DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world.jasper',
            false,
            array("pdf", "rtf"),
            array("php_version" => "xxx")
        )->execute();

        $array = $jasper->list_parameters(
            __DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world.jasper'
        )->execute();

        return view('test');*/
    }

    public function getDataDetail(Request $request)
    {
        $secfun = almTPreSF::all();
        $html = '';

        $html .= '<option value="ALL">TODOS</option>';
        foreach($secfun as $sf)
        {
            $html .= '<option value="'.$sf->secID.'">'.substr($sf->secID,-3).'-'.$sf->secDsc.'</option>';
        }

        return $html;

    }

    public function getDataFilter(Request $request)
    {
        $analysis = $request->analysis;
        $html = '';

        switch($analysis)
        {
            case 'PCS':
                $html .= '<option value="SN" >SELECCIONAR</option>';
                $html .= '<option value="SF">SECUENCIA FUNCIONAL</option>';
                break;
            case 'IYS':
                $html .= '<option value="SN" >SELECCIONAR</option>';
                //$html .= '<option value="CP" >CODIGO DEL PRODUCTO</option>';
                //$html .= '<option value="CL">CLASIFICADOR</option>';
                //$html .= '<option value="FF">FUENTE DE FINANCIAMIENTO</option>';
                $html .= '<option value="SF">SECUENCIA FUNCIONAL</option>';
                //$html .= '<option value="TP">TIPO DE PROCESO</option>';
                break;
            case 'NEA':
                $html .= '<option value="SN">SELECCIONAR</option>';
                $html .= '<option value="SF">SECUENCIA FUNCIONAL</option>';
                break;
            case 'GIU':
                $html .= '<option value="SN">SELECCIONAR</option>';
                $html .= '<option value="SF">SECUENCIA FUNCIONAL</option>';
                break;
        }

        return $html;
    }

    public function postMakePreview($type, Request $request)
    {   $almacen = $request->repAlmacen;
        $dateFrom = $request->repDateFrom;
        $dateTo = $request->repDateTo;
        $analysis = $request->repAnalysis;
        $filter = $request->repFilter;
        $detail = $request->repDetail; // secuencias funcionales

        $tiporpt = $request->repTipo;
        $orientation = 'landscape';

        if($tiporpt == 'rpt1'){

            if($analysis == 'PCS')
            {
                switch($filter)
                {
                    case 'SF':
                        $data = $this->create_report_pecosa_secfun($almacen,$dateFrom,$dateTo,$detail,'detallado');
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaPdfPcs',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaPcs',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteSecuenciaPcs';
                        }
                        break;
                }
            }
            else if($analysis == 'PCS-R')
            {
                switch ($filter)
                {
                    case 'SF':
                        $data = $this->create_report_pecosa_secfun($almacen,$dateFrom,$dateTo,$detail,'resumen');

                        if($type == 'pdf')
                        {
                            $data = $data->groupBy('rptSfID');
                            $view = view('almacen.reporte.reporteSecuenciaPdfPcsR', compact('data'));
                            $orientation = 'portrait';
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaPcsR',compact('data'));
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteSecuenciaPcsR';
                        }
                        break;
                }
            }
            else if($analysis == 'NEA')
            {
                switch($filter)
                {
                    case 'SF':
                        $data = $this->create_report_neas_secfun($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaNeaPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaNea',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteSecuenciaNea';
                        }
                        break;
                }
            }
            else if($analysis == 'GIU')
            {
                switch($filter)
                {
                    case 'SF':
                        $data = $this->create_report_gius_secfun($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaGiuPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaGiu',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteSecuenciaGiu';
                        }
                        break;
                }
            }
            else if($analysis == 'IYS')
            {
                switch($filter)
                {
                    case 'CP':
                        $data = $this->create_report_producto($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteProductoPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteProducto',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteProducto';
                        }
                        break;
                    case 'CL':
                        $data = $this->create_report_clasificador($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteClasificadorPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteClasificador',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteClasificador';
                        }
                        break;
                    case 'FF':
                        $data = $this->create_report_financiamiento($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteFinanciamientoPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteFinanciamiento',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteFinanciamiento';
                        }
                        break;
                    case 'SF':
                        $data = $this->create_report_secuencia($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteSecuenciaPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteSecuencia',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteSecuencia';
                        }
                        break;
                    case 'TP':
                        $data = $this->create_report_proceso($almacen,$dateFrom,$dateTo,$detail);
                        if($type == 'pdf')
                        {
                            $view = view('almacen.reporte.reporteProcesoPdf',['data' => $data]);
                        }
                        else if($type == 'html')
                        {
                            $view = view('almacen.reporte.reporteProceso',['data' => $data]);
                        }
                        else if($type == 'xls')
                        {
                            $view = 'almacen.reporte.reporteProceso';
                        }
                        break;
                }
            }

            if($type == 'xls')
            {
                /*Excel::create('Reporte Excel', function($excel) use ($data){
                    $excel->sheet('Reporte',function($sheet) use ($data){
                        $sheet->setFontFamily('Arial Narrow');
                        $sheet->setFontSize(10);
                        $sheet->setColumnFormat(array(
                            'H' => '0.00'
                        ));
                        $sheet->fromArray($data);
                    });
                })->download('xlsx');*/
                Excel::create('Reporte Excel', function($excel) use ($view,$data){
                    $excel->sheet('Reporte',function($sheet) use ($view,$data){
                        $sheet->loadView($view)->with('data',$data);
                    });
                })->export('xlsx');
            }
            else if($type == 'pdf')
            {
                $optionsHeader = array('header-html' => 'http://192.168.0.2:8081/slam/public/header', 'header-spacing' => -20);
                $optionsFooter = array('footer-html' => 'http://192.168.0.2:8081/slam/public/footer', 'footer-line' => true, 'footer-spacing' => 5);
                $optionsPage = array('margin-top'=>10,'margin-bottom'=>20,'margin-left'=>10,'margin-right'=>10);

                $snappy = App::make('snappy.pdf.wrapper');
                //$snappy->setOptions($optionsHeader);
                $snappy->setOptions($optionsPage);
                $snappy->setOptions($optionsFooter);
                $snappy->loadHTML($view)->setPaper('a4')->setOrientation($orientation);

                return $snappy->stream('reporte-productos.pdf');

                /*$pdf = new MYPDF('L','mm','A4',true,'UTF-8',false);

                $pdf->SetTitle('REPORTE DE ALMACEN POR PRODUCTOS');

                $pdf->setAttributesHeader('PRODUCTOS');
                $pdf->Header();
                $pdf->SetFont('times','',8);
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->AddPage();
                $pdf->writeHTML($view->render());
                $pdf->Output('hello_world.pdf');*/
            }
            else if($type == 'html')
            {
                return $view;
            }

        }
        else if($tiporpt == 'rpt2'){

            $subcuenta = $request->repSubcta;

            $query = "select b.prod_cta as rptCta,  SUBSTRING(c.orcSecFun,5,5) as rptSf, '' as rptSiaf, 
                                    b.prod_desc as rptDscprod, 
                                    ISNULL(SUBSTRING(d.pint_cpi,5,5) + '-' + SUBSTRING(d.pint_cpi,11,3),'S.I.') as rptIngreso, 
                                    SUBSTRING(c.orcID, 5, 5) as rptOC, 
                                    b.prod_recep as rptCantI, (b.prod_recep * b.prod_precio) as rptMontoI,
                                    ISNULL(SUBSTRING(e.psal_pecosa, 5, 5),'S.P.') as rptSalida, 
                                    b.prod_distribuido as rptCantS, (b.prod_distribuido * b.prod_precio) as rptMontoS
                                    from Internamiento a 
                                    left join Inventario b on a.ing_giu = b.cod_giu
                                    inner join DB_Logistica..TLogOC c on c.orcID = a.OC_COD
                                    left join procesos_intern d on d.cod_giu = a.ing_giu
                                    left join procesos_salida e on e.ing_giu = a.ing_giu";

            if($subcuenta == 'ALL'){

                $subcta = $subcuenta;

                if($detail == 'ALL'){
                    $query = $query . "
                                    WHERE 
                                    c.orcFecha BETWEEN ? AND ?";
                    $data = DB::connection('dbalmacen')->select(DB::raw($query), [$dateFrom, $dateTo]);
                }
                else{
                    $query = $query . "
                                    WHERE 
                                    c.orcFecha BETWEEN ? AND ? AND
                                    b.prod_secfun = ?";

                    $data = DB::connection('dbalmacen')->select(DB::raw($query), [$dateFrom, $dateTo, $detail]);
                }
            }
            else{
                $anio = explode('-', $subcuenta)[0];
                $subcta = explode('-', $subcuenta)[1];

                if($detail == 'ALL'){
                    $query = $query . "
                                    WHERE 
                                    c.orcFecha BETWEEN ? AND ? AND
                                    b.prod_cta like ?";
                    $data = DB::connection('dbalmacen')->select(DB::raw($query), [$dateFrom, $dateTo, $subcta.'%']);
                }
                else{
                    $query = $query . "
                                    WHERE 
                                    c.orcFecha BETWEEN ? AND ? AND
                                    b.prod_secfun = ? AND
                                    b.prod_cta like ?";
                    $data = DB::connection('dbalmacen')->select(DB::raw($query), [$dateFrom, $dateTo, $detail, $subcta.'%']);
                }
            }

            if($type == 'xls')
            {
                $view = 'almacen.reporte.reporteConta';
                Excel::create('Reporte Excel', function($excel) use ($view,$data,$subcta){
                    $excel->sheet('Reporte',function($sheet) use ($view,$data,$subcta){
                        $sheet->loadView($view)->with('data',$data)->with('subcta',$subcta);
                    });
                })->export('xlsx');
            }
            else if($type == 'pdf')
            {
                $query = "select b.prod_cta as rptCta, DB_Logistica.dbo.fnLogGetGrlDat('CTACONT', b.prod_cta, '2019') as rptCtadsc from Internamiento a 
                                    left join Inventario b on a.ing_giu = b.cod_giu
                                    inner join DB_Logistica..TLogOC c on c.orcID = a.OC_COD
                                    left join procesos_intern d on d.cod_giu = a.ing_giu
                                    left join procesos_salida e on e.ing_giu = a.ing_giu 
                                    WHERE 
                                    c.orcFecha BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "'  ";


                $query_grouped = $query;

                $query = $query . ($detail == 'ALL' ? "" : " AND b.prod_secfun = '" . $detail . "' ");
                $query = $query . ($subcta == 'ALL' ? "" : " AND b.prod_cta like '" . $subcta . "%' ");
                $query = $query . " GROUP BY b.prod_cta ORDER BY b.prod_cta ASC";

                $cuentas = DB::connection('dbalmacen')->select(DB::raw($query));

                foreach ($cuentas as $cta){

                    if($cta->rptCta != null){

                        $data[$cta->rptCta] = DB::connection('dbalmacen')->select(DB::raw("select b.prod_cta as rptCta,  
                                    SUBSTRING(c.orcSecFun,5,5) as rptSf, '' as rptSiaf, 
                                    b.prod_desc as rptDscprod, 
                                    ISNULL(SUBSTRING(d.pint_cpi,5,5) + '-' + SUBSTRING(d.pint_cpi,11,3),'S.I.') as rptIngreso, 
                                    SUBSTRING(c.orcID, 5, 5) as rptOC, 
                                    b.prod_recep as rptCantI, (b.prod_recep * b.prod_precio) as rptMontoI,
                                    ISNULL(SUBSTRING(e.psal_pecosa, 5, 5),'S.P.') as rptSalida, 
                                    b.prod_distribuido as rptCantS, (b.prod_distribuido * b.prod_precio) as rptMontoS
                                    from Internamiento a 
                                    left join Inventario b on a.ing_giu = b.cod_giu
                                    inner join DB_Logistica..TLogOC c on c.orcID = a.OC_COD
                                    left join procesos_intern d on d.cod_giu = a.ing_giu
                                    left join procesos_salida e on e.ing_giu = a.ing_giu
                                    WHERE 
                                    c.orcFecha BETWEEN ? AND ? AND
                                    b.prod_cta = ?"),[$dateFrom, $dateTo, $cta->rptCta]);

                    }
                }

                $view = view('almacen.reporte.reporteContaPdf',compact('data','cuentas', 'dateFrom', 'dateTo'));
                $optionsHeader = array('header-html' => 'http://192.168.0.2:8081/slam/public/header', 'header-spacing' => -20);
                $optionsFooter = array('footer-html' => 'http://192.168.0.2:8081/slam/public/footer', 'footer-line' => true, 'footer-spacing' => 5);
                $optionsPage = array('margin-top'=>10,'margin-bottom'=>20,'margin-left'=>10,'margin-right'=>10);

                $snappy = App::make('snappy.pdf.wrapper');
                //$snappy->setOptions($optionsHeader);
                $snappy->setOptions($optionsPage);
                $snappy->setOptions($optionsFooter);
                $snappy->loadHTML($view)->setPaper('a4')->setOrientation('landscape');

                return $snappy->stream('reporte-productos.pdf');
            }
            else if($type == 'html')
            {
                $view = view('almacen.reporte.reporteConta', compact('data','subcta'));
                return $view;
            }
        }
        else{
            return null;
        }
    }

    public function postMakePreview_temp(Request $request)
    {
        $almacen = $request->repAlmacen;
        $dateFrom = $request->repDateFrom;
        $dateTo = $request->repDateTo;
        $filter = $request->repFilter;
        $detail = $request->repDetail;

        switch($filter)
        {
            case 'CP':
                $view = $this->create_report_producto($almacen,$dateFrom,$dateTo,$detail);
                break;
            case 'CL':
                $this->create_report_clasificador($almacen,$dateFrom,$dateTo,$detail);
                break;
            case 'FF':
                $this->create_report_financiamiento($almacen,$dateFrom,$dateTo,$detail);
                break;
            case 'SF':
                $this->create_report_secuencia($almacen,$dateFrom,$dateTo,$detail);
                break;
            case 'TP':
                $this->create_report_proceso($almacen,$dateFrom,$dateTo,$detail);
                break;
        }

        $pdf = new MYPDF('L','mm','A4',true,'UTF-8',false);

        $pdf->SetTitle('REPORTE DE ALMACEN POR PRODUCTOS');

        $pdf->setAttributesHeader('PRODUCTOS');
        $pdf->Header();
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $pdf->writeHTML($view->render());
        $pdf->Output('hello_world.pdf');

        //return $snappy->stream('reporte-productos.pdf');
    }

    private function create_report_producto($almacen, $dateFrom, $dateTo, $detail)
    {
        $query = almInternamiento::select('conf_fecha as Fecha', 'ing_giu as Internamiento', 'prod_oc as Orden de Compra', 'prod_desc as Producto', 'prod_cant as Cantidad', 'prod_recep as Ingresado')
            ->addSelect('prod_precio as Precio','prod_costo as Costo', 'prod_distribuido as Distribuido', 'prod_stock as Stock')
            ->addSelect(DB::raw("(prod_distribuido*prod_precio) AS costoDistrib"))
            ->addSelect(DB::raw("(prod_stock*prod_precio) AS costoSaldo"))
            ->join('inventario','ing_giu','=','cod_giu')
            ->where('flagI',true)
            ->where('ing_almacen',$almacen)
            ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
            ->orderBy('conf_fecha','DESC')
            ->get();

        return $query;
        /*
        $view = view('almacen.reporte.reporteProductoPdf',['data' => $query]);
        return $view;*/
    }

    private function create_report_clasificador($almacen, $dateFrom, $dateTo, $detail)
    {
        $query = almInternamiento::select('prod_clasif','ing_giu as Internamiento','oc_cod as Orden de Compra','oc_fecha as Fecha','conf_fecha as Fecha','prod_desc as Producto','prod_cant as Cantidad')
                ->addSelect('prod_recep as Ingresado','prod_precio as Precio','prod_costo as Costo','prod_distribuido as Distribuido','prod_stock as Stock')
                ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('CLASF',prod_clasif,'') AS Clasificador"))
                ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('CLASFDSC',prod_clasif,'') AS clasifDsc"))
                ->addSelect(DB::raw("(prod_distribuido*prod_precio) AS costoDistrib"))
                ->addSelect(DB::raw("(prod_stock*prod_precio) AS costoSaldo"))
                ->join('inventario','ing_giu','=','cod_giu')
                ->where('flagI',true)
                ->where('ing_almacen',$almacen)
                ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                ->orderBy('conf_fecha','DESC')
                ->get();

        return $query;

    }

    private function create_report_financiamiento($almacen, $dateFrom, $dateTo, $detail)
    {
        $query = almInternamiento::select('oc_rubro','ing_giu as Internamiento','oc_cod as Orden de Compra','conf_fecha as Fecha','prod_desc as Producto','prod_cant as Cantidad')
                ->addSelect('prod_recep as Ingresado','prod_precio as Precio','prod_costo as Costo','prod_distribuido as Distribuido','prod_stock as Stock')
                ->addSelect(DB::raw("(oc_FteFto + '-' + oc_rubro) as Fuente"))
                ->addSelect(DB::raw("(prod_distribuido*prod_precio) AS costoDistrib"))
                ->addSelect(DB::raw("(prod_stock*prod_precio) AS costoSaldo"))
                ->join('inventario','ing_giu','=','cod_giu')
                ->where('flagI',true)
                ->where('ing_almacen',$almacen)
                ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                ->orderBy('conf_fecha','DESC')
                ->get();

        return $query;
    }

    private function create_report_secuencia($almacen, $dateFrom, $dateTo, $detail)
    {
        if($detail == 'ALL')
        {
            $query = almInternamiento::select('oc_secFuncional as Secuencia','oc_subSecFuncional','ing_giu as Internamiento','oc_cod as Orden de Compra','oc_fecha','conf_fecha as Fecha')
                ->addSelect('prod_desc as Producto','prod_cant as Cantidad','prod_recep as Ingresado','prod_precio as Precio','prod_costo as Costo','prod_distribuido as Distribuido','prod_stock as Stock','secDsc')
                ->addSelect(DB::raw("(prod_distribuido*prod_precio) AS costoDistrib"))
                ->addSelect(DB::raw("(prod_stock*prod_precio) AS costoSaldo"))
                ->join('inventario','ing_giu','=','cod_giu')
                ->join(DB::raw("DB_Logistica..TPreSF"),'oc_secFuncional','=','secID')
                ->where('flagI',true)
                ->where('ing_almacen',$almacen)
                ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                ->orderBy('conf_fecha','DESC')
                ->get();
        }
        else
        {
            $query = almInternamiento::select('oc_secFuncional as Secuencia','oc_subSecFuncional','ing_giu as Internamiento','oc_cod as Orden de Compra','oc_fecha','conf_fecha as Fecha')
                ->addSelect('prod_desc as Producto','prod_cant as Cantidad','prod_recep as Ingresado','prod_precio as Precio','prod_costo as Costo','prod_distribuido as Distribuido','prod_stock as Stock','secDsc')
                ->addSelect(DB::raw("(prod_distribuido*prod_precio) AS costoDistrib"))
                ->addSelect(DB::raw("(prod_stock*prod_precio) AS costoSaldo"))
                ->join('inventario','ing_giu','=','cod_giu')
                ->join(DB::raw("DB_Logistica..TPreSF"),'oc_secFuncional','=','secID')
                ->where('flagI',true)
                ->where('ing_almacen',$almacen)
                ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                ->where('oc_secFuncional',$detail)
                ->orderBy('conf_fecha','DESC')
                ->get();
        }
        

        return $query;
    }

    private function create_report_proceso($almacen, $dateFrom, $dateTo, $detail)
    {
        $query = almInternamiento::select('oc_tipoProceso as Proceso','ing_giu as Internamiento','oc_cod as Orden de Compra','oc_fecha','conf_fecha as Fecha','prod_desc as Producto','prod_cant as Cantidad')
                ->addSelect('prod_recep as Ingresado','prod_precio as Precio','prod_costo as Costo','prod_distribuido as Distribuido','prod_stock as Stock','tpcDsc')
                ->addSelect(DB::raw("(prod_distribuido*prod_precio) AS costoDistrib"))
                ->addSelect(DB::raw("(prod_stock*prod_precio) AS costoSaldo"))
                ->join('inventario','ing_giu','=','cod_giu')
                ->join(DB::raw("DB_Logistica..TLogTpPcs"),'oc_tipoProceso','=','tpcID')
                ->where('flagI',true)
                ->where('ing_almacen',$almacen)
                ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                ->orderBy('conf_fecha','DESC')
                ->get();

        return $query;
    }

    private function create_report_pecosa_secfun($almacen, $dateFrom, $dateTo, $detail, $nivel)
    {
        if($nivel == 'detallado'){
            if($detail == 'ALL')
            {
                $query = almInternamiento::select('psal_pecosa as PECOSA','Internamiento.ing_giu as GI','oc_secFuncional','psal_fecha as Fecha Pecosa','psalp_cod as Codigo Producto','oc_cod as OC')
                    ->addSelect('psalp_desc as Producto','psalp_cant as Cantidad','psalp_cant_atend as Atendido','psalp_precio as Precio','psalp_costo as Costo','psalp_umedida as Medida')
                    ->addSelect(DB::raw('dbo.getCodClsf(Internamiento.ing_giu, oc_cod, psalp_cod) AS Clasificador'))
                    ->addSelect(DB::raw('dbo.getCodNumber(oc_secFuncional) as SF'))
                    ->join('procesos_salida','Internamiento.ing_giu','=','procesos_salida.ing_giu')
                    ->join('psal_productos','psal_pecosa','=','psalp_pecosa')
                    ->where('ing_almacen',$almacen)
                    ->whereBetween('psal_fecha',[$dateFrom,$dateTo])
                    ->orderBy('oc_secFuncional','ASC')
                    ->get();
            }
            else
            {
                $query = almInternamiento::select('secDsc','psal_pecosa as PECOSA','Internamiento.ing_giu as GI','oc_secFuncional','psal_fecha as Fecha Pecosa','psalp_cod as Codigo Producto','oc_cod as OC')
                    ->addSelect('psalp_desc as Producto','psalp_cant as Cantidad','psalp_cant_atend as Atendido','psalp_precio as Precio','psalp_costo as Costo','psalp_umedida as Medida')
                    ->addSelect(DB::raw('dbo.getCodClsf(Internamiento.ing_giu, oc_cod, psalp_cod) AS Clasificador'))
                    ->addSelect(DB::raw('dbo.getCodNumber(oc_secFuncional) as SF'))
                    ->join('procesos_salida','Internamiento.ing_giu','=','procesos_salida.ing_giu')
                    ->join('psal_productos','psal_pecosa','=','psalp_pecosa')
                    ->join(DB::raw("DB_Logistica..TPreSF"),'oc_secFuncional','=','secID')
                    ->where('ing_almacen',$almacen)
                    ->whereBetween('psal_fecha',[$dateFrom,$dateTo])
                    ->where('oc_secFuncional',$detail)
                    ->orderBy('oc_secFuncional','ASC')
                    ->get();
            }
        }
        else if($nivel == 'resumen'){
            if($detail == 'ALL')
            {
                $query = almProcesoSalida::select('secDsc as rptSf','secID as rptSfID','orcRubro as rptRubro', 'orcRuc as rptRucid', 'orcID as rptOcid', 'orcFecha as rptOcfecha', 'procesos_salida.ing_giu as rptInternamiento', 'psal_pecosa as rptPcs', 'psal_fecha as rptPcsfecha', 'psal_solicitante as rptSolicitante')
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetCSExp(orcID) as rptSiaf"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('RUC', orcRuc, '') as rptRuc"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetMonto(orcID,'OC') as rptOcmonto"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetMonto(psal_pecosa,'PCS') as rptPcsmonto"))
                    ->join('Internamiento','Internamiento.ing_giu','=','procesos_salida.ing_giu')
                    ->leftJoin(DB::raw("DB_Logistica..TLogOC"),'oc_cod','=','orcID')
                    ->join(DB::raw("DB_Logistica..TPreSF"),'orcSecFun','=','secID')
                    ->where('ing_almacen',$almacen)
                    ->whereBetween('psal_fecha',[$dateFrom,$dateTo])
                    ->orderBy('oc_secFuncional','ASC')
                    ->get();
            }
            else
            {
                $query = almProcesoSalida::select('secDsc as rptSf','secID as rptSfID','orcRubro as rptRubro', 'orcRuc as rptRucid', 'orcID as rptOcid', 'orcFecha as rptOcfecha', 'procesos_salida.ing_giu as rptInternamiento', 'psal_pecosa as rptPcs', 'psal_fecha as rptPcsfecha', 'psal_solicitante as rptSolicitante')
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetCSExp(orcID) as rptSiaf"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('RUC', orcRuc, '') as rptRuc"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetMonto(orcID,'OC') as rptOcmonto"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetMonto(psal_pecosa,'PCS') as rptPcsmonto"))
                    ->join('Internamiento','Internamiento.ing_giu','=','procesos_salida.ing_giu')
                    ->leftJoin(DB::raw("DB_Logistica..TLogOC"),'oc_cod','=','orcID')
                    ->join(DB::raw("DB_Logistica..TPreSF"),'orcSecFun','=','secID')
                    ->where('ing_almacen',$almacen)
                    ->whereBetween('psal_fecha',[$dateFrom,$dateTo])
                    ->where('oc_secFuncional',$detail)
                    ->orderBy('oc_secFuncional','ASC')
                    ->get();
            }
        }


        return $query;

    }

    private function create_report_neas_secfun($almacen, $dateFrom, $dateTo, $detail)
    {
        if($detail == 'ALL')
        {
            $query = almInternamiento::select('*')
                        ->addSelect(DB::raw('dbo.getCodNumber(oc_secFuncional) as SF'))
                        ->join('neaInternamiento','ing_giu','=','ing_nea')
                        ->join('Inventario','ing_giu','=','cod_giu')
                        ->where('ing_almacen',$almacen)
                        ->where('tipo_doc','<>','OdC')
                        ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                        ->orderBy('oc_secFuncional','ASC')
                        ->get();
        }
        else
        {
            $query = almInternamiento::select('*')
                        ->addSelect(DB::raw('dbo.getCodNumber(oc_secFuncional) as SF'))
                        ->join('neaInternamiento','ing_giu','=','ing_nea')
                        ->join('Inventario','ing_giu','=','cod_giu')
                        ->join(DB::raw("DB_Logistica..TPreSF"),'oc_secFuncional','=','secID')
                        ->where('ing_almacen',$almacen)
                        ->where('tipo_doc','<>','OdC')
                        ->whereBetween('conf_fecha',[$dateFrom,$dateTo])
                        ->where('oc_secFuncional',$detail)
                        ->orderBy('oc_secFuncional','ASC')
                        ->get();
        }

        return $query;

    }

    private function create_report_gius_secfun($almacen, $dateFrom, $dateTo, $detail)
    {
        if($detail == 'ALL')
        {
            $query = almInternamiento::select('oc_secFuncional','ing_giu','pint_cpi','pint_fecha','oc_cod','pintp_cod')
                ->addSelect('pintp_desc','pintp_cant','pintp_cantr','pintp_umedida','pintp_precio','pintp_costo')
                ->addSelect(DB::raw('dbo.getCodClsf(Internamiento.ing_giu, oc_cod, pintp_cod) AS Clasificador'))
                ->addSelect(DB::raw('dbo.getCodNumber(oc_secFuncional) as SF'))
                ->join('procesos_intern','Internamiento.ing_giu','=','procesos_intern.cod_giu')
                ->join('pint_productos','pint_cpi','=','pintp_cpi')
                ->where('ing_almacen',$almacen)
                ->where('tipo_doc','OdC')
                ->whereBetween('pint_fecha',[$dateFrom,$dateTo])
                ->orderBy('oc_secFuncional','ASC')
                ->get();
        }
        else
        {
            $query = almInternamiento::select('oc_secFuncional','ing_giu','pint_cpi','pint_fecha','oc_cod','pintp_cod')
                ->addSelect('pintp_desc','pintp_cant','pintp_cantr','pintp_umedida','pintp_precio','pintp_costo')
                ->addSelect(DB::raw('dbo.getCodClsf(Internamiento.ing_giu, oc_cod, pintp_cod) AS Clasificador'))
                ->addSelect(DB::raw('dbo.getCodNumber(oc_secFuncional) as SF'))
                ->join('procesos_intern','Internamiento.ing_giu','=','procesos_intern.cod_giu')
                ->join('pint_productos','pint_cpi','=','pintp_cpi')
                ->join(DB::raw("DB_Logistica..TPreSF"),'oc_secFuncional','=','secID')
                ->where('ing_almacen',$almacen)
                ->where('tipo_doc','OdC')
                ->whereBetween('pint_fecha',[$dateFrom,$dateTo])
                ->where('oc_secFuncional',$detail)
                ->orderBy('oc_secFuncional','ASC')
                ->get();
        }

        return $query;
    }
}

class MYPDF extends TCPDF {

    var $titulo;

    public function setAttributesHeader($title = '')
    {
        $this->titulo = $title;
    }

    //Page header
    public function Header() {
        // Logo
        $image_file = asset('css/img/a.png');
        $this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, '<< REPORTE DE ALMACEN - '.$this->titulo.' >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}