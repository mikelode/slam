<?php

namespace Logistica\Http\Controllers\Almacen;

use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Logistica\Almacen\almAlmacen;
use Logistica\Almacen\almAmpliarPlazo;
use Logistica\Almacen\almAnularOc;
use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almInventario;
use Logistica\Almacen\almNeaInternamiento;
use Logistica\Almacen\almProcesoInternamiento;
use Logistica\Almacen\almProcesoInternamientoB;
use Logistica\Almacen\almRecycleInternamiento;
use Logistica\Almacen\almSeguimiento;
use Logistica\Almacen\almTLogOC;
use Logistica\Almacen\almTLogOCD;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\Http\Requests\almStoreInterPostRequest;
use Logistica\Http\Requests\almStoreNeaPostRequest;
use Logistica\Http\Requests\almStoreOcPostRequest;

class internamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($period,Request $request)
    {

        $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_ALM_NEA'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                // $number = substr('00000'.$number,-5);
                 //->where('name', 'like', 'T%')
                 $giu = almInternamiento::select('*')
                        ->join('Almacen','ing_almacen','=','id')
                        ->select('*')
                        ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
                        ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
                        ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
                        ->where('ing_giu', 'like', 'GI'.substr(trim($period),-2).'%')
                      //  ->whereRaw('YEAR(ing_fecha) = '.trim($period))
                        ->orWhere('estado_validacion','T')
                        ->orderBy('estado_validacion','desc')
                        ->orderBy('ing_giu','desc')
                        ->orderBy('ing_fecha','desc')
                        ->paginate(40);

                $view = view('almacen.ingreso.panel-ingreso',compact('giu'));

                if($request->ajax())
                {
                    return $view;
                }

            }
            else {
                return view('logistica.Adq.vwPermission');
            }
        }
        else {
            return view('logistica.Adq.vwPermission');
        }


      
    }

    public function indexPage(Request $request)
    {
        $page = $request->page;
        $year = $request->year;

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->select('*')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            ->whereRaw('YEAR(ing_fecha) = '.trim($year))
            ->orderBy('estado_validacion','desc')
            ->orderBy('ing_fecha','desc')
            ->paginate(30);

        $view = view('almacen.ingreso.panel-ingresoPage',compact('giu'));

        if($request->ajax())
        {
            return $view;
        }
    }

    public function getFindGuia($gi, Request $request)
    {
        $year = trim($request->year);
        $gi = $this->assembleCode('GI',$year,trim($gi));

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->select('*')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            ->where('ing_giu',$gi)
            ->orderBy('ing_fecha','desc')
            ->paginate(30);

        if(count($giu) == 0)
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$gi;
            $view = view('errors.error-busqueda',['message' => $msg]);
        }
        else
        {
            $view = view('almacen.ingreso.panel-ingresoPage',compact('giu'));
        }
        return $view;
    }

    public function getFindOrden($oc, Request $request)
    {
        $year = trim($request->year);
        $oc = $this->assembleCode('OC',$year,trim($oc));

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->select('*')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            ->where('oc_cod',$oc)
            ->orderBy('ing_fecha','desc')
            ->paginate(30);

        if(count($giu) == 0)
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$oc;
            $view = view('errors.error-busqueda',['message' => $msg]);
        }
        else
        {
            $view = view('almacen.ingreso.panel-ingresoPage',compact('giu'));
        }
        return $view;
    }

    public function getFindNota($nea, Request $request)
    {
        $year = trim($request->year);
        $nea = $this->assembleCode('NE',$year,trim($nea));

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->select('*')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            ->where('ing_giu',$nea)
            ->orderBy('ing_fecha','desc')
            ->paginate(30);

        if(count($giu) == 0)
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$nea;
            $view = view('errors.error-busqueda',['message' => $msg]);
        }
        else
        {
            $view = view('almacen.ingreso.panel-ingresoPage',compact('giu'));
        }
        return $view;
    }

    public function getRegisterOc(Request $request)
    {
        $almacen = almAlmacen::all();
        $view = view('almacen.ingreso.registerOc',compact('almacen'));
        return $view;
    }

    public function postRegisterOc(almStoreOcPostRequest $request)
    {
        $status = 'Error en el registro de la orden de compra';
        $findOc = almInternamiento::where('oc_cod',$request->ocCodigo)->count();
        $nullOc = almInternamiento::where('oc_cod',$request->ocCodigo)->where('estado_anulacion','SI')->count();

        if($findOc == 0 || $nullOc != 0)
        {
            DB::transaction(function($request) use ($request){

                $giu = '';
                $pref = 'GI';
                $anio = $request->almAnio;
                $result = \DB::connection('dbalmacen')->select('exec generar_codigoFin ?,?',  array( $anio ,  $pref));  
                $giu= $result[0]->codigo ;
               /* $stmt = DB::connection('dbalmacen')->getPdo()->prepare('SET NOCOUNT ON; EXEC generar_codigoFin ?,?');
                $stmt->bindParam(1,$pref);
                $stmt->bindParam(2,$giu,\PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 11);
                $stmt->execute();
                unset($stmt);
                */

                //$oc = almTLogOC::find($request->ocCodigo);
                $oc = DB::connection('dblogistica')->table('TLogOC')
                    ->select('*', DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('DEP',orcDep,'') as ocDepdesc"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('RUC',orcRuc,'') as ocProv"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',orcProcTip,'') as ocProcTipo"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('SECFUN',orcSecFun,'') as ocSecFuncDesc"))
                    ->where('orcID',$request->ocCodigo)->get();

                $ocInt = new almInternamiento();

                $ocInt->ing_giu = $giu;
                $ocInt->ing_almacen = $request->ocAlmacen;
                $ocInt->ing_guiaremision = $request->ocNroGuiaRemision;
                $ocInt->ing_factura =  $request->ocNroFactura;
                $ocInt->ing_fecha = Carbon::now()->toDateString();  /*FECHA Y HORA DE REGISTRO DE LA OC*/
                $ocInt->ing_hora = Carbon::now()->toTimeString();
                $ocInt->ing_usu = Auth::user()->usrID;//'usuario';
                $ocInt->ing_obs = $request->ocComment;
                $ocInt->estado_validacion = 'P';
                $ocInt->estado_salida = 'P';
                $ocInt->flagI = false;
                $ocInt->flagS = false;
                $ocInt->tipo_internamiento = $request->ocDeliveryType;
                $ocInt->tipo_doc = 'OdC';
                $ocInt->oc_cod = $oc[0]->orcID;
                $ocInt->oc_plazo_dias = $oc[0]->orcPlazo;
                $ocInt->oc_costotal = $this->costoTotalOC($oc[0]->orcID); //Hallar el costo total
                $ocInt->oc_proveedor = $oc[0]->ocProv;
                $ocInt->oc_rucprovee = $oc[0]->orcRuc;
                $ocInt->oc_fecha = $oc[0]->orcFecha;
                $ocInt->oc_dep_destino = $oc[0]->ocDepdesc;
                $ocInt->oc_obra_destino = $oc[0]->ocSecFuncDesc;
                $ocInt->usu_act = Auth::user()->usrID; // 'usuario';
                $ocInt->fec_act = Carbon::now()->toDateString();;
                $ocInt->hor_act = Carbon::now()->toTimeString();;
                $ocInt->oc_fecha_limite = $request->ocDateExpiration;
                $ocInt->estado_anulacion = 'NO';
                $ocInt->oc_tipoProceso = $oc[0]->orcProcTip;
                $ocInt->oc_FteFto = $oc[0]->orcFteFto;
                $ocInt->oc_rubro = $oc[0]->orcRubro;
                $ocInt->oc_secFuncional = $oc[0]->orcSecFun;
                $ocInt->oc_subSecFuncional = $oc[0]->orcSubSec;
                $ocInt->oc_docRef = $oc[0]->orcRef;
                $ocInt->oc_glosa = $oc[0]->orcGlosa;
                $ocInt->oc_expSiaf = 'siaf'; //$oc[0]->orcExpSiaf;
                $ocInt->oc_fecha_notificacion = $request->ocDateNotification;
                $ocInt->oc_medio_notificacion = $request->ocMedioNotificacion;

                $ocInt->save();

                /*VERIFICAMOS SI PERTENECE AL CONVENIO MARCO*/

                $flagCMarco = false;
                if($oc[0]->orcProcTip == '009' && trim($oc[0]->orcIGV) == 'SI')
                {
                    $checkCMarco = array();
                    if(in_array($oc[0]->orcID,$checkCMarco))
                    {
                        $flagCMarco = false;
                    }
                    else
                    {
                        $flagCMarco = true;
                    }
                }

                /*******************************************/

                //$ocd = almTLogOCD::where('cdtCodOC',$request->ocCodigo)->get();
                $ocd = DB::connection('dblogistica')->table('TLogOCD')
                    ->select('*', DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('PROD',cdtCodProd,'') AS ocdProd"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('UNDABRV',cdtCodUnd,'') AS ocdUnd"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('CLASF',cdtCodClsf,'') AS ocdClsf"))
                    ->where('cdtCodOC',$request->ocCodigo)->get();

                //dd($ocd);

                for($i = 0; $i < count($ocd); $i++)
                {
                    $ocDet = new almInventario();

                    $ocDet->cod_giu = $giu;
                    $ocDet->prod_oc = $ocd[$i]->cdtCodOC;
                    $ocDet->prod_cod = $ocd[$i]->cdtCodProd;
                    $ocDet->prod_desc = $ocd[$i]->ocdProd.': '.$ocd[$i]->cdtEspecif;
                    $ocDet->prod_marca = $ocd[$i]->cdtMarca;
                    $ocDet->prod_cant = $ocd[$i]->cdtCant;
                    $ocDet->prod_medida = $ocd[$i]->ocdUnd;
                    $ocDet->prod_precio = $ocd[$i]->cdtPrecio;
                    if($flagCMarco)
                    {
                        $ocDet->prod_costo = $this->getMountCMarco($ocd[$i]->cdtSubTotal,$ocd[$i]->cdtEnvio,$ocd[$i]->cdtIgv);
                    }
                    else
                    {
                        $ocDet->prod_costo = $ocd[$i]->cdtCant * $ocd[$i]->cdtPrecio;
                    }
                    $ocDet->prod_ingobs = null;
                    $ocDet->prod_recep = 0;
                    $ocDet->conf_prod = 'P';
                    $ocDet->flagR = false;
                    $ocDet->prod_distribuido = 0;
                    $ocDet->prod_stock = 0;
                    $ocDet->flagD = false;
                    $ocDet->prod_salobs = null;
                    $ocDet->prod_clasif = $ocd[$i]->cdtCodClsf;
                    $ocDet->fecha_act = Carbon::now()->toDateString();
                    $ocDet->hora_act = Carbon::now()->toTimeString();
                    $ocDet->user_act = Auth::user()->usrID; // 'Usuario';

                    $ocDet->save();
                    unset($ocDet);
                }

                $seguimiento = new almSeguimiento();

                $seguimiento->seg_giu = $giu;
                $seguimiento->seg_operacion = 'Registro';
                $seguimiento->seg_usuario = Auth::user()->usrID; // 'usuario';
                $seguimiento->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                $seguimiento->seg_hora = Carbon::now()->toTimeString();
                $seguimiento->seg_descripcion = "Registro de la OC:".$oc[0]->orcID." como la GI:".$giu;

                $seguimiento->save();
            });

            $status = 'Notificación de Orden de compra registrada con éxito';
        }
        else
        {
            $status = 'La orden de compra seleccionada ya fue registrada anteriormente, y se actualizaron sus datos correctamente';
            $intern = almInternamiento::find($request->guiId);
            $intern->ing_almacen = $request->ocAlmacen;
            $intern->ing_obs = $request->ocComment;
            $intern->tipo_internamiento = $request->ocDeliveryType;
            $intern->oc_fecha_limite = $request->ocDateExpiration;
            $intern->oc_fecha_notificacion = $request->ocDateNotification;
            $intern->oc_medio_notificacion = $request->ocMedioNotificacion;
            $intern->save();
        }

        return $status;
    }

    public function getMountCMarco($subTotal, $cenvio, $cigv)
    {
        $monto = (1.18 * (float)$subTotal) + (float)$cenvio + (float)$cigv;
        return round((float)$monto,2);
    }

    public function getRegisterNea(Request $request)
    {
        $almacen = almAlmacen::all();
        $view = view('almacen.ingreso.registerNea',compact('almacen'));
        return $view;
    }

    public function postRegisterNea(almStoreNeaPostRequest $request)
    {
        $productos = count($request->neaProd);
        if($productos <= 1) throw new Exception('Error debe registrar los productos',1);

        DB::transaction(function($request) use ($request) {

            /*
             * GENERAMOS NUEVO CODIGO PARA LA NOTA DE ENTRADA
             * */

            $nea = '';
            $pref = 'NE';
            $anio = $request->almAnio;
            $result = \DB::connection('dbalmacen')->select('exec generar_codigoFin ?,?',  array( $anio ,  $pref));  
            $nea= $result[0]->codigo ;
            /*$stmt = DB::connection('dbalmacen')->getPdo()->prepare('SET NOCOUNT ON; EXEC generar_codigo ?,?');
            $stmt->bindParam(1, $pref);
            $stmt->bindParam(2, $nea, \PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 11);
            $stmt->execute();
            unset($stmt);
*/
            /*
             * REGISTRAMOS DATOS DE LA NEA EN LA TABLA INTERNAMIENTO
             * */

            $int = new almInternamiento();
            $int->ing_giu = $nea;
            $int->ing_almacen = $request->neaAlmacen;
            $int->ing_fecha = $request->neaDateInput;
            $int->ing_hora = Carbon::now()->toTimeString();
            $int->ing_usu = Auth::user()->usrID; // 'Usuario Sesion';
            $int->ing_obs = $request->neaComment;
            $int->estado_validacion = 'C';
            $int->estado_salida = 'P';
            $int->conf_fecha = $request->neaDateInput;
            $int->conf_hora = Carbon::now()->toTimeString();
            $int->conf_usu = Auth::user()->usrID; // 'Usuario Sesion';
            $int->flagI = true;
            $int->flagS = false;
            $int->nea_cod = null;
            $int->tipo_internamiento = 'A';
            $int->tipo_doc = $request->neaNeaType;
            $int->oc_cod = null;
            $int->oc_plazo_dias = 0;
            $int->oc_costotal = 0;
            $int->oc_proveedor = 'Area Usuaria';
            $int->oc_fecha = Carbon::now()->toDateString();
            $int->usu_act = Auth::user()->usrID; // 'Usuario Sesion';
            $int->fec_act = Carbon::now()->toDateString();
            $int->hor_act = Carbon::now()->toTimeString();
            $int->estado_anulacion = 'NO';
            $int->oc_secFuncional = $request->neaSecGiver;
            $int->oc_obra_destino = $request->neaDescSecGiver;
            $int->save();

            $neaInt = new almNeaInternamiento();
            $neaInt->ing_nea = $nea;
            $neaInt->nea_dniRecepcionista = $request->neaDniReceipt;
            $neaInt->nea_recepcionista = $request->neaNameReceipt;
            $neaInt->nea_dniDador = $request->neaDniGiver;
            $neaInt->nea_dador = $request->neaNameGiver;
            $neaInt->nea_sfDador = $request->neaSecGiver;
            $neaInt->save();

            /*
             * REGISTRO DE LOS PRODUCTOS INGRESADOS EN LA TABLA INVENTARIO
             * */

            $rows = count($request->neaProd);

            for($i = 1;$i < $rows; $i++)
            {
                $neaProd = new almInventario();
                $neaProd->cod_giu = $nea;
                $neaProd->prod_cod = $request->neaProd[$i];
                $neaProd->prod_desc = $request->neaDesc[$i];
                $neaProd->prod_marca = $request->neaMarca[$i];
                $neaProd->prod_cant = $request->neaCant[$i];
                $neaProd->prod_medida = $request->neaUnd[$i];
                $neaProd->prod_precio = $request->neaPrecio[$i];
                $neaProd->prod_costo = $request->neaCosto[$i];
                $neaProd->prod_ingobs = $request->neaProdComment[$i];
                $neaProd->prod_recep = $request->neaCant[$i];
                $neaProd->conf_prod = 'C';
                $neaProd->flagR = true;
                $neaProd->prod_distribuido = 0;
                $neaProd->prod_stock = $request->neaCant[$i];
                $neaProd->flagD = false;
                $neaProd->fecha_act = Carbon::now()->toDateString();
                $neaProd->hora_act = Carbon::now()->toTimeString();
                $neaProd->user_act = Auth::user()->usrID; // 'Usuario Sesion';
                $neaProd->save();

                unset($neaProd);
            }

            /*
             * REGISTRO DEL SEGUIMIENTO EN LA TABLA SEGUIMIENTO
             * */

            $seguimiento = new almSeguimiento();
            $seguimiento->seg_giu = $nea;
            $seguimiento->seg_operacion = 'Registro';
            $seguimiento->seg_usuario = Auth::user()->usrID; // 'usuario';
            $seguimiento->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
            $seguimiento->seg_hora = Carbon::now()->toTimeString();
            $seguimiento->seg_descripcion = "Registro de la NEA: ".$nea;
            $seguimiento->save();
        });

        $status = 'Nota de Entrada registrada con éxito';

        return $status;
    }

    public function getShowAllRegister(Request $request)
    {
        $view = view('almacen.ingreso.panelInternamiento');
        return $view;
    }

    public function getCloseInternamiento(Request $request)
    {
        return '';
    }

    public function getViewInternamiento($gi, $pi)
    {
        $guia = almInternamiento::find($gi);
        $proceso = almProcesoInternamiento::find($pi);
        $bienes = almProcesoInternamiento::find($pi)->productos_ingresados;

        $view = view('almacen.ingreso.viewinternamiento',compact('guia','proceso','bienes'));
        return $view;
    }

    public function getInternamientoBienes($gi, Request $request)
    {
        $guia = almInternamiento::find($gi);
        $bienes = almInternamiento::find($gi)->inventario;

        $view = view('almacen.ingreso.internamiento',['guia' => $guia, 'bienes' => $bienes]);
        return $view;
    }

    public function postInternamientoBienes($gi, almStoreInterPostRequest $request)
    {
        try{
            $exception = DB::transaction(function($request) use ($gi, $request){

                $guia = almInternamiento::find($gi);
                $bienes = almInternamiento::find($gi)->inventario;

                /*
                 * GENERAMOS NUEVO CODIGO DE PROCESO DE INTERNAMIENTO
                 * */

                $cpi = '';
                $pref = 'PI';
                $father = $guia->ing_giu;
                $stmt = DB::connection('dbalmacen')->getPdo()->prepare('SET NOCOUNT ON; EXEC generar_codigo_hijo ?,?,?');
                $stmt->bindParam(1,$pref);
                $stmt->bindParam(2,$father);
                $stmt->bindParam(3,$cpi,\PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 13);
                $stmt->execute();
                unset($stmt);

                /*
                 * REGISTRAMOS EL PROCESO DE INTERNAMIENTO GENERAL
                 * */

                $pint = new almProcesoInternamiento();
                $pint->pint_cpi = $cpi;
                $pint->cod_giu = $guia->ing_giu;
                $pint->pint_fecha = $request->intDateReceipt;
                $pint->pint_hora = Carbon::now()->toTimeString();
                $pint->pint_pentrega = $request->intNameGiver;
                $pint->pint_dni_pentrega = $request->intDniGiver;
                $pint->pint_preceptor = $request->intNameReceiver;
                $pint->pint_dni_receptor = $request->intDniReceiver;
                $pint->pint_conductor = $request->intNameDriver;
                $pint->pint_dni_conductor = $request->intDniDriver;
                $pint->pint_observacion = $request->intComment;
                $pint->save();

                $flagI = true;
                $modFlagS = false;

                foreach($bienes as $item) {

                    /*
                     * VALIDACION DE ENTREGA DE BIENES
                     * */
                    /*$recibido = is_null($request['intQ-' . $item->prod_cod])?$item->prod_cant:$request['intQ-' . $item->prod_cod];*/
                    $recibido = is_null($request['intQ-' . $item->prod_cod . '-' . $item->id]) ? 0 : $request['intQ-' . $item->prod_cod . '-' . $item->id];
                    $comentario = is_null($request['intC-' . $item->prod_cod . '-' . $item->id]) ? 'Entregado Completamente' : $request['intC-' . $item->prod_cod . '-' . $item->id];

                    /*
                     * REGISTRAMOS PROCESO DE INTERNAMIENTO DETALLADO (PRODUCTOS)
                     * */

                    $pintb = new almProcesoInternamientoB();
                    $pintb->pintp_cpi = $cpi;
                    $pintb->pintp_cod = $item->prod_cod;
                    $pintb->pintp_desc = $item->prod_desc;
                    $pintb->pintp_cant = $item->prod_cant;
                    $pintb->pintp_cantr = $recibido;
                    $pintb->pintp_umedida = $item->prod_medida;
                    $pintb->pintp_precio = $item->prod_precio;
                    $pintb->pintp_costo = $recibido * $item->prod_precio;//$item->prod_costo;
                    $pintb->pintp_marca = $item->prod_marca;
                    $pintb->pintp_observacion = $comentario;
                    $pintb->save();

                    unset($pintb);

                    /*
                     * ACTUALIZACIÓN DE LA TABLA DE INVENTARIO
                     * */
                    /*$acumulado = is_null($request['intQ-' . $item->prod_cod]) ? $recibido : $item->prod_stock + $recibido;*/ /* ANTES ERA $acumulado = $item->prod_stock + $recibido -- fallaba para varios internamientos */
                    $acumulado = $item->prod_recep + $recibido;
                    $conformidad = $this->conformidad_producto($acumulado,$item->prod_cant);

                    if($conformidad == 'X')
                    {
                        throw new Exception('Revise sus datos de cantidad ingresados: '.$conformidad);
                    }
                    else
                    {
                        if($conformidad != 'C') $flagI = false;
                    }

                    $inventory = almInventario::find($item->id);
                    $inventory->prod_ingobs = $comentario;
                    $inventory->prod_recep = $item->prod_recep + $recibido;
                    $inventory->conf_prod = $conformidad;
                    $inventory->flagR = $conformidad=='C'?true:false;
                    if(!is_null($request['intQ-' . $item->prod_cod . '-' . $item->id])){
                        $stock = $item->prod_stock + $request['intQ-' . $item->prod_cod . '-' . $item->id];
                        $inventory->prod_stock = $stock;
                        if($stock > 0)
                        {
                            $modFlagS = true;
                            $inventory->flagD = false;
                        }

                    }
                    $inventory->save();

                    unset($inventory);
                }

                /*
                 * ACTUALIZACIÓN DE LA TABLA DE INTERNAMIENTO
                 * */

                $internment = almInternamiento::find($gi);
                $internment->estado_validacion = $flagI?'C':'T';
                $internment->conf_fecha = $request->intDateReceipt; /*FECHA Y HORA DE INTERNAMIENTO DE BIENES*/
                $internment->conf_hora = Carbon::now()->toTimeString();
                $internment->conf_usu = Auth::user()->usrID; //'Usuario';
                $internment->flagI = $flagI;
                if($modFlagS)
                {
                    $internment->estado_salida = 'P';
                    $internment->flagS = false;
                }
                $internment->save();

                /*
                 * REGISTRAMOS DATOS DE SEGUIMIENTO
                 * */

                $tracking = new almSeguimiento();
                $tracking->seg_giu = $gi;
                $tracking->seg_operacion = 'Internamiento';
                $tracking->seg_usuario = Auth::user()->usrID; // 'usuario';
                $tracking->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                $tracking->seg_hora = Carbon::now()->toTimeString();
                $tracking->seg_descripcion = "Internamiento de bienes de la OC:".$guia->oc_cod." como la GI:".$gi." PI: ".$cpi;
                $tracking->save();

            });

            return is_null($exception) ? 'Registro exitoso del internamiento' : $exception;

        }catch (Exception $e){
            return 'Excepción capturada: '. $e->getMessage() . "\n";
        }
    }

    public function conformidad_producto($cant_recep, $cant_ing)
    {
        $dif = $cant_ing - $cant_recep;

        $estado = 'X';

        if($dif == $cant_ing)
        {
            $estado = 'P';
        }
        else
        {
            if($dif == 0)
            {
                $estado = 'C';
            }
            else if($dif > 0)
            {
                $estado = 'T';
            }
        }

        return $estado;
    }

    public function costoTotalOC($oc)
    {
        $ct = DB::connection('dblogistica')->table('TLogOCD')
            ->select(DB::raw("CONVERT(DECIMAL(19,4),SUM(cdtCant * cdtPrecio)) as ocTotalCosto"))
            ->where('cdtCodOC',$oc)->get();

        $cto = $ct[0]->ocTotalCosto;

        return $cto;
    }

    public function getProcesosInternamiento(Request $request)
    {
        $gi = $request->guia;
        $cpi = almProcesoInternamiento::where('cod_giu',$gi)->get();
        $ingreso = almInternamiento::select('flagI','estado_validacion','tipo_doc')->where('ing_giu',$gi)->get();

        if($ingreso[0]->tipo_doc == 'OdC')
        {
            $html = '<select class="form-control alm-input" name="printPi" id="printPi">';
            foreach($cpi as $key=>$pi)
            {
                if($key==0)
                {
                    $html .= "<option value='".$pi->pint_cpi."' selected>".$pi->pint_cpi."</option>";
                }
                else
                {
                    $html .= "<option value='".$pi->pint_cpi."'>".$pi->pint_cpi."</option>";
                }
            }
            $html .= '</select>';
            foreach ($cpi as $key => $pi) {
                if($ingreso[0]->estado_validacion == 'C' || $ingreso[0]->estado_validacion == 'T')
                {
                    $html .= '<br><a href="pdfActa/'.$gi.'/'.$pi->pint_cpi.'" id="btnPreviewActa">Acta de Recepción Nro:'.substr($pi->pint_cpi, -3).'</a>';
                }
            }
        }
        else
        {
            if($ingreso[0]->estado_validacion == 'C' || $ingreso[0]->estado_validacion == 'T')
            {
                $html = '<br><a href="pdfNota/'.$gi.'" id="btnPreviewActa">Acta de Recepción Nota de Entrada: '.$gi.'</a>';
            }
        }

        return $html;
    }

    public function assembleCode($pref,$year,$number)
    {
        $number = substr('00000'.$number,-5);
        $newCode = $pref.substr($year,2,2).$number;
        return $newCode;
    }

    public function postMakeTask($operation, Request $request)
    {
        switch($operation)
        {
            case 'anular':
                try{
                    $exception = DB::transaction(function($request) use ($request){
                        /*
                         * REGISTRANDO LA ANULACION
                         * */

                        $anular = new almAnularOc();
                        $anular->anul_oc_cod = $request->cancelOc;
                        $anular->anul_motivo = $request->cancelCause;
                        $anular->anul_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                        $anular->anul_hora = Carbon::now()->toTimeString();
                        $anular->anul_usu = Auth::user()->usrID; // 'session user';
                        $anular->save();

                        /*
                         * ACTUALIZANDO ESTADO DE ANULACION
                         * */

                        $internamiento = almInternamiento::find($request->cancelGi);
                        $internamiento->estado_anulacion = 'SI';
                        $internamiento->save();

                        /*
                         * REGISTRAMOS DATOS DE SEGUIMIENTO
                         * */

                        $tracking = new almSeguimiento();
                        $tracking->seg_giu = $internamiento->ing_giu;
                        $tracking->seg_operacion = 'Anulacion OC';
                        $tracking->seg_usuario = Auth::user()->usrID; // 'usuario';
                        $tracking->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                        $tracking->seg_hora = Carbon::now()->toTimeString();
                        $tracking->seg_descripcion = "Anulacion de la OC:".$internamiento->oc_cod." correspondiente a la GI:".$internamiento->ing_giu;
                        $tracking->save();
                    });

                    return is_null($exception) ? 'La anulación del registro se realizó con éxito.' : $exception;

                }catch (Exception $e){
                    return 'Error al registrar la operación';
                }
                break;
            case 'plazo':
                try{
                    $exception = DB::transaction(function() use ($request){
                        $ampliar = new almAmpliarPlazo();
                        $ampliar->subs_oc_cod = $request->updtOc;
                        $ampliar->subs_nueva_flimite = $request->newLimitDate;
                        $ampliar->subs_descripcion = $request->causeLimitDate;
                        $ampliar->subs_fecha = Carbon::now()->toDateString();
                        $ampliar->subs_hora = Carbon::now()->toTimeString();
                        $ampliar->subs_usu = Auth::user()->usrID; // 'session user';
                        $ampliar->save();

                        /*
                         * ACTUALIZAR FECHA LIMITE DE LA ORDEN DE COMPRA PARA INTERNAR
                         * */

                        $internamiento = almInternamiento::find($request->updtGi);
                        $internamiento->oc_fecha_limite = $request->newLimitDate;
                        $internamiento->save();

                        /*
                         * SEGUIMIENTO
                         * */

                        $tracking = new almSeguimiento();
                        $tracking->seg_giu = $internamiento->ing_giu;
                        $tracking->seg_operacion = 'Ampliacion OC';
                        $tracking->seg_usuario = Auth::user()->usrID; // 'usuario';
                        $tracking->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                        $tracking->seg_hora = Carbon::now()->toTimeString();
                        $tracking->seg_descripcion = "Ampliación de plazo en la OC:".$internamiento->oc_cod." correspondiente a la GI:".$internamiento->ing_giu;
                        $tracking->save();

                    });

                    return is_null($exception) ? 'Registro exitoso' : $exception;

                }catch (Exception $e){
                    return 'Error al registrar la operación';
                }
                break;
        }
    }

    public function postUpdateInternamiento(Request $request)
    {
        $gi = '';
        try{
            switch($request->name)
            {
                case 'editFactura':
                    $gi = $request->pk;
                    $internamiento = almInternamiento::find($gi);
                    $internamiento->ing_factura = $request->value;
                    $internamiento->save();
                    unset($internamiento);
                    break;
                case 'editRemision':
                    $gi = $request->pk;
                    $internamiento = almInternamiento::find($gi);
                    $internamiento->ing_guiaremision = $request->value;
                    $internamiento->save();
                    unset($internamiento);
                    break;
                case 'editFecIntern':
                    $pi = $request->pk;
                    $pint = almProcesoInternamiento::find($pi);
                    $pint->pint_fecha = $request->value;
                    $pint->save();
                    unset($pint);
                    break;
                default:
                    throw new Exception('Error al especificar el tipo de campo a editar',1);
            }
            return 'Campo actualizado correctamente';
        }catch(Exception $e){
            return 'Excepción capturada: '. $e->getMessage() . "\n";
        }
    }




    public function postRemoveGuiaInternamiento(Request $request)
        {
            try{
                $internamiento = almInternamiento::find($request->rmvGi);
                $ingresos = almProcesoInternamiento::with('productos_ingresados')
                    ->where('cod_giu',$request->rmvGi)
                    ->get();
                $message = '200';

                $exception = DB::transaction(function() use ($internamiento, $ingresos, $request){

                    if(count($ingresos) > 0)
                    {
                        foreach($ingresos as $pguia)
                        {
                            foreach($pguia->productos_ingresados as $item)
                            {
                                $recycle = new almRecycleInternamiento();

                                $recycle->giCodigo = $internamiento->ing_giu;
                                $recycle->giAlmacen = $internamiento->ing_almacen;
                                $recycle->giGuiaRemision = $internamiento->ing_guiaremision;
                                $recycle->giFactura = $internamiento->ing_factura;
                                $recycle->giUsuInternamiento = $internamiento->conf_usu;
                                $recycle->giFechaInternamiento = $internamiento->conf_fecha;
                                $recycle->giNea = $internamiento->nea_cod;
                                $recycle->giTipoInternamiento = $internamiento->tipo_internamiento;
                                $recycle->giTipoDoc = $internamiento->tipo_doc;
                                $recycle->giOrdenCompra = $internamiento->oc_cod;
                                $recycle->giProcesoCodigo = $pguia->pint_cpi;
                                $recycle->giProcesoFecha = $pguia->pint_fecha;
                                $recycle->giProcesoNameEntrega = $pguia->pint_pentrega;
                                $recycle->giProcesoDniEntrega = $pguia->pint_dni_pentrega;
                                $recycle->giProcesoNameReceptor = $pguia->pint_receptor;
                                $recycle->giProcesoDniReceptor = $pguia->pint_dni_receptor;
                                $recycle->giProcesoObservacion = $pguia->pint_observacion;
                                $recycle->giProcesoProdCod = $item->pintp_cod;
                                $recycle->giProcesoProdDsc = $item->pintp_desc;
                                $recycle->giProcesoProdCantr = $item->pintp_cantr;
                                $recycle->giProcesoProdMedida = $item->pintp_umedida;
                                $recycle->giProcesoProdPrecio = $item->pintp_precio;
                                $recycle->giProcesoProdCosto = $item->pintp_costo;
                                $recycle->giProcesoProdMarca = $item->pintp_marca;
                                $recycle->giRemoveAt = Carbon::now()->format('d/m/Y h:i:s A');
                                $recycle->giRemoveBy = Auth::user()->usrID;
                                $recycle->giRemoveFor = $request->rmvCause;

                                $recycle->save();
                                unset($recycle);
                            }
                        }
                    }
                    else
                    {
                        $recycle = new almRecycleInternamiento();

                        $recycle->giCodigo = $internamiento->ing_giu;
                        $recycle->giAlmacen = $internamiento->ing_almacen;
                        $recycle->giGuiaRemision = $internamiento->ing_guiaremision;
                        $recycle->giFactura = $internamiento->ing_factura;
                        $recycle->giUsuInternamiento = $internamiento->conf_usu;
                        $recycle->giFechaInternamiento = $internamiento->conf_fecha;
                        $recycle->giNea = $internamiento->nea_cod;
                        $recycle->giTipoInternamiento = $internamiento->tipo_internamiento;
                        $recycle->giTipoDoc = $internamiento->tipo_doc;
                        $recycle->giOrdenCompra = $internamiento->oc_cod;
                        $recycle->giRemoveAt = Carbon::now()->format('d/m/Y h:i:s A');
                        $recycle->giRemoveBy = Auth::user()->usrID;
                        $recycle->giRemoveFor = '';

                        $recycle->save();
                        unset($recycle);
                    }

                });

                if(is_null($exception))
                {
                    almInternamiento::destroy($request->rmvGi);

                    $seguimiento = new almSeguimiento();

                    $seguimiento->seg_giu = $request->rmvGi;
                    $seguimiento->seg_operacion = 'Eliminacion';
                    $seguimiento->seg_usuario = Auth::user()->usrID; // 'usuario';
                    $seguimiento->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                    $seguimiento->seg_hora = Carbon::now()->toTimeString();
                    $seguimiento->seg_descripcion = "Eliminación del registro de la OC:".$request->refOc." como la GI:".$request->rmvGi;

                    $seguimiento->save();
                }
                else
                {
                    $message = $exception;
                }

                return $message;

            }catch(Exception $e){
                return 'Excepción capturada: '.$e->getMessage().' \n ';
            }
        }


}