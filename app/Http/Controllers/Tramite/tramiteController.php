<?php

namespace Logistica\Http\Controllers\Tramite;

use Illuminate\Support\Facades\App;
use Logistica\Almacen\almTPrePto;
use Logistica\Almacen\almTPreSF;
use Logistica\Custom\FormatCode;
use Logistica\Custom\OleDbConnection;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Logistica\Almacen\almTLogOC;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\Tramite\siafOrdenCompra;
use Logistica\Tramite\tramLogBandeja;
use Logistica\Tramite\tramLogEntrada;
use Logistica\Tramite\tramLogSalida;
use Logistica\Tramite\tramLogVerificacion;
use Logistica\Tramite\tramOperacion;
use Logistica\Tramite\tramSeguimiento;
use Logistica\Tramite\tramTLogCC;
use Logistica\Tramite\tramTLogCtz;
use Logistica\Tramite\tramTLogOS;
use Logistica\Tramite\tramTLogReq;
use Logistica\Tramite\tramTPerPersona;
use Logistica\Tramite\tramViewSiafSeguimiento;

class tramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $dniUser = Auth::user()->usrID;
        /*$dniUser = '29298646';*/
        $usuario = tramTPerPersona::select('perID','perAPaterno','perAMaterno','perNombres','perCodDep')
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('DEP',perCodDep,'') AS Descripcion"))
                    ->where('perID',$dniUser)
                    ->get();

        $logisticos = tramTPerPersona::select(DB::raw("perID, concat(perNombres, ' ', perAPaterno, ' ', perAMaterno) AS logNombres"))
                    ->join('TSisModDll','mdlUsrID','=','perID')
                    ->where('mdlCre',1)
                    ->whereIn('mdlModID',['LOG_LOG_CZ','LOG_LOG_CC','LOG_LOG_OC','LOG_LOG_OS'])
                    ->groupBy(DB::raw("perID, concat(perNombres, ' ', perAPaterno, ' ', perAMaterno)"))
                    ->get();

        $view = view('tramite.panel-tramite',compact('usuario','logisticos'));

        return $view;
    }

    public function filtro()
    {
        $dniUser = Auth::user()->usrID;
        /*$dniUser = '29298646';*/

        $bandeja = tramLogBandeja::select('*')
            ->join('tramLogSalida','tlbEnvioId','=','tlsId')
            ->where('tlbFlagE',true)
            ->where('tlbFlagCheck',false)
            ->get();

        $verificados = tramLogBandeja::select('*')
            ->join('tramLogSalida','tlbEnvioId','=','tlsId')
            ->join('tramLogVerificacion','tlbVerificacionId','=','tlvId')
            ->where('tlbFlagE',true)
            ->where('tlbFlagCheck',true)
            ->get();

        $usuario = tramTPerPersona::select('perID','perAPaterno','perAMaterno','perNombres','perCodDep')
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('DEP',perCodDep,'') AS Descripcion"))
            ->where('perID',$dniUser)
            ->get();

        $view = view('tramite.panel-filtro',['usuario'=>$usuario,'bandeja'=>$bandeja, 'verificados' => $verificados]);
        return $view;
    }

    public function postUpdateStatetram(Request $request)
    {
        try
        {
            $exception = DB::transaction(function($request) use ($request){

                $bandeja = tramLogBandeja::find($request->pk);
                $bandeja->tlbSituacion = $request->value;
                $bandeja->save();

            });

            return is_null($exception) ? '200' : $exception;
        }
        catch(Exception $e)
        {
            return '500';
        }
    }

    public function getBandejaTramite($bandeja, Request $request)
    {
        if($bandeja == 'entrada')
        {
            $perfiles = DB::table('TSisModDll')
                        ->where('mdlUsrID',Auth::user()->usrID)
                        ->where('mdlCre',1)
                        ->where('mdlModID','!=','LOG_LOG_RQ')
                        ->get();

            /*foreach ($perfiles as $i => $perfil){

                $perfil = explode('_',$perfil->mdlModID)[2];

                switch($perfil)
                {
                    case 'CZ':
                        $recibidos = tramLogBandeja::select('*')
                            ->join('tramLogEntrada','tlbRecepcionId','=','tleId')
                            ->where('tlbFlagCheck',true)
                            ->where('tlbFlagR',true)
                            ->where('tleDni',Auth::user()->usrID)
                            ->orderby('tlbTypeDoc','DESC')
                            ->get();
                        break;
                    case 'CC':
                        $recibidos = tramLogBandeja::select('*')
                            ->join('tramLogEntrada','tlbRecepcionId','=','tleId')
                            ->where('tlbFlagCheck',true)
                            ->where('tlbFlagR',true)
                            ->where('tleDni',Auth::user()->usrID)
                            ->orderby('tlbTypeDoc','DESC')
                            ->get();
                        break;
                    case 'OC':
                        $recibidos = tramLogBandeja::select('*')
                            ->join('tramLogEntrada','tlbRecepcionId','=','tleId')
                            ->where('tlbFlagCheck',true)
                            ->where('tlbFlagR',true)
                            ->where('tleDni',Auth::user()->usrID)
                            ->orderby('tlbTypeDoc','DESC')
                            ->get();
                        break;
                    case 'OS':
                        $recibidos = tramLogBandeja::select('*')
                            ->join('tramLogEntrada','tlbRecepcionId','=','tleId')
                            ->where('tlbFlagCheck',true)
                            ->where('tlbFlagR',true)
                            ->where('tleDni',Auth::user()->usrID)
                            ->orderby('tlbTypeDoc','DESC')
                            ->get();
                        break;
                    case 'ALM':
                        $recibidos = tramLogBandeja::select('*')
                            ->join('tramLogEntrada','tlbRecepcionId','=','tleId')
                            ->where('tlbFlagCheck',true)
                            ->where('tlbFlagR',true)
                            ->where('tleDni',Auth::user()->usrID)
                            ->orderby('tlbTypeDoc','DESC')
                            ->get();
                        break;
                    default:
                        $oppendientes = [];
                        $recibidos = [];
                }

                $operaciones[$i] = tramOperacion::select('*')
                    ->whereIn('topId',$oppendientes->pluck('tlbOperacion')->all())
                    ->get();

            }*/

            $operaciones = tramOperacion::select('*')
                            ->where('topUsrTarget',Auth::user()->usrID)
                            ->where('topFlagR', false)
                            ->orderby('topId')
                            ->get();

            $recibidos = tramOperacion::select('*')
                            ->join('tramLogEntrada','topRecepcionId','=','tleId')
                            ->where('topFlagR', true)
                            ->where('tleDni',Auth::user()->usrID)
                            ->orderby('topId','DESC')
                            ->get();

            $view = view('tramite.bandejaEntrada', compact('operaciones','recibidos'));
        }
        else if($bandeja == 'salida')
        {
            $dniUser = Auth::user()->usrID;
            /*$dniUser = '29298646';*/
            $req = tramTLogReq::select('reqID','reqFecha','reqUsr')
                ->where('flagEnvio',false)
                ->where('reqUsr',$dniUser)
                ->get();

            $ctz = tramTLogCtz::select('ctzID','ctzFecha','ctzUser')
                ->where('flagEnvio',false)
                ->where('ctzUser',$dniUser)
                ->get();

            $cdr = tramTLogCC::select('cdrID','cdrFecha','cdrUsr')
                ->where('flagEnvio',false)
                ->where('cdrUsr',$dniUser)
                ->get();

            $ors = tramTLogOS::select('orsID','orsFecha','orsEstUsr')
                ->where('flagEnvio',false)
                ->where('orsEstUsr',$dniUser)
                ->get();

            $orc = almTLogOC::select('orcID','orcFecha','orcEstUsr')
                ->where('flagEnvio',false)
                ->where('orcEstUsr',$dniUser)
                ->get();

            $enviados = tramOperacion::select('*')
                ->join('tramLogSalida','topEnvioId','=','tlsId')
                ->where('topFlagE',true)
                ->where('tlsDni',$dniUser)
                ->orderby('topId','DESC')
                ->get();

            $view = view('tramite.bandejaSalida',['req'=>$req,'ctz'=>$ctz,'cdr'=>$cdr,'ors'=>$ors,'orc'=>$orc, 'enviados'=>$enviados]);
        }

        return $view;
    }

    public function getListarDocumentosEnviados(Request $request)
    {
        $bandeja = tramLogBandeja::select('*')
                    ->join('tramOperacion','topId','=','tlbOperacion')
                    ->join('tramLogSalida','tlsId','=','topEnvioId')
                    ->where('tlbOperacion',$request->operacion)
                    ->get();

        $view = view('tramite.bandejaEnviadosLista', compact('bandeja'));
        return $view;
    }

    public function getListarDocumentosPendientes(Request $request)
    {
        $bandeja = tramLogBandeja::select('*')
            ->join('tramOperacion','topId','=','tlbOperacion')
            ->join('tramLogSalida','tlsId','=','topEnvioId')
            ->where('tlbOperacion',$request->operacion)
            ->get();

        $view = view('tramite.bandejaPendientesLista', compact('bandeja'));
        return $view;
    }

    public function getListarDocumentosRecibidos(Request $request)
    {
        $bandeja = tramLogBandeja::select('*')
            ->join('tramOperacion','topId','=','tlbOperacion')
            ->join('tramLogEntrada','tleId','=','topRecepcionId')
            ->where('tlbOperacion',$request->operacion)
            ->get();

        $view = view('tramite.bandejaRecibidosLista', compact('bandeja'));
        return $view;
    }

    public function printTramiteOperacion($opId)
    {
        $operacion = tramOperacion::select(DB::raw("*, DB_Logistica.dbo.fnLogGetGrlDat('DNI', topUsrTarget, '') as topTargetName"))
                        ->where('topId',$opId)
                        ->first();

        $documentos = $operacion->documentos;
        $emisor = $operacion->remitente;

        $view = view('tramite.tramitePdf', compact('operacion','documentos','emisor'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('A4','portrait');
        return $pdf->stream('tramite.pdf');
    }

    public function getDeleteDocumentOperacion($docId)
    {
        try{

            $doc = tramLogBandeja::find($docId);
            $operacion = tramOperacion::find($doc->tlbOperacion);

            if($operacion->topFlagR){
                throw new Exception("No es posible eliminar el documento elegido, porque ya se registro su recepción");
            }

            $exception = DB::transaction(function() use($docId){

                $doc = tramLogBandeja::find($docId);

                switch ($doc->tlbTypeDoc){
                    case 'REQUERIMIENTO':
                        $req = tramTLogReq::find($doc->tlbCodDoc);
                        $req->flagEnvio = false;
                        $req->save();
                        break;
                    case 'COTIZACION':
                        $ctz = tramTLogCtz::find($doc->tlbCodDoc);
                        $ctz->flagEnvio = false;
                        $ctz->save();
                        break;
                    case 'CUADRO COMPARATIVO':
                        $cdr = tramTLogCC::find($doc->tlbCodDoc);
                        $cdr->flagEnvio = false;
                        $cdr->save();
                        break;
                    case 'ORDEN DE COMPRA':
                        $ctz = almTLogOC::find($doc->tlbCodDoc);
                        $ctz->flagEnvio = false;
                        $ctz->save();
                        break;
                    case 'ORDEN DE SERVICIO':
                        $ctz = tramTLogOS::find($doc->tlbCodDoc);
                        $ctz->flagEnvio = false;
                        $ctz->save();
                        break;
                }

                tramLogBandeja::destroy($docId);

            });

            if(is_null($exception)){
                $msg = "Documento eliminado de la hoja de trámite seleccionada";
                $msgId = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $msg = "Error: " . $e->getMessage();
            $msgId = 500;
        }

        return response()->json(compact('msg','msgId'));
    }

    public function postOperationTramite($operation, Request $request)
    {
        $success = '';

        if($operation == 'sendDoc')
        {
            $success = $this->storeEnvioDocumento($request);
        }
        else if($operation == 'checkDoc')
        {
            $success = $this->storeCheckDocument($request);
        }
        else if($operation == 'receiptDoc')
        {
            $success = $this->storeReceiptDocument($request);
        }

        return $success;
    }

    public function storeReceiptDocument($data)
    {
        try{
            $exception = DB::transaction(function($data) use ($data){

                $fullName = explode('_',$data->envFullName);

                $receptor = new tramLogEntrada();
                $receptor->tleDni = $data->envDni;
                $receptor->tleNombre = $fullName[0];
                $receptor->tleAPaterno = $fullName[1];
                $receptor->tleAMaterno = $fullName[2];
                $receptor->tleFecha = Carbon::now()->format('d/m/Y h:i:s A');//$data->envDate;
                $receptor->tleRegisterBy = Auth::user()->usrID; /*'user session';*/
                $receptor->tleRegisterAt = Carbon::now()->format('d/m/Y h:i:s A');
                $receptor->tleDestinoPlace = '-';//$data->envDepOrigen;
                $receptor->save();

                foreach($data->receiptDoc as $doc)
                {
                    $operacion = tramOperacion::find($doc);
                    $operacion->topFlagR = true;
                    $operacion->topRecepcionId = $receptor->tleId;
                    $operacion->save();

                    unset($operacion);
                }

            });

            if(is_null($exception)){
                $msg = 'Recepción registrada correctamente';
                $msgId = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){
            $msg = "Error: " . $e->getMessage();
            $msgId = 500;
        }

        return response()->json(compact('msg','msgId'));
    }

    public function storeCheckDocument($data)
    {
        try{
            $exception = DB::transaction(function($data) use ($data){

                $fullName = explode('_',$data->checkFullName);

                $verificador = new tramLogVerificacion();
                $verificador->tlvDni = $data->checkDni;
                $verificador->tlvNombre = $fullName[0];
                $verificador->tlvAPaterno = $fullName[1];
                $verificador->tlvAMaterno = $fullName[2];
                $verificador->tlvFecha = Carbon::now()->format('d/m/Y h:i:s A'); //$data->checkDate;
                $verificador->tlvRegisterBy = Auth::user()->usrID; /*'user session';*/
                $verificador->tlvRegisterAt = Carbon::now()->format('d/m/Y h:i:s A');
                $verificador->save();

                foreach($data->checkDoc as $doc)
                {
                    $document = tramLogBandeja::find($doc);
                    $document->tlbVerificacionId = $verificador->tlvId;
                    $document->tlbFlagCheck = true;
                    $document->save();

                    unset($document);
                }

            });

            return is_null($exception) ? '200' : $exception;

        }catch (Exception $e){
            return '500';
        }
    }

    public function storeEnvioDocumento($data)
    {
        try{
            $tramNro = 0;

            $exception = DB::transaction(function() use ($data, &$tramNro){

                $fullName = explode('_',$data->envFullName);

                $emisor = new tramLogSalida();
                $emisor->tlsDni = $data->envDni;
                $emisor->tlsNombre = $fullName[0];
                $emisor->tlsAPaterno = $fullName[1];
                $emisor->tlsAMaterno = $fullName[2];
                $emisor->tlsFecha = Carbon::now()->format('d/m/Y h:i:s A');//$data->envDate;
                $emisor->tlsRegisterBy = Auth::user()->usrID; /*'user session';*/
                $emisor->tlsRegisterAt = Carbon::now()->format('d/m/Y h:i:s A');
                $emisor->tlsOrigenPlace = '-';//$data->envDepOrigen;
                $emisor->save();

                if(!$emisor){
                    throw new Exception("Error al registrar al emisor del docuemento");
                }


                $opId = DB::select(DB::raw("SELECT dbo.fnLogGetTramKy(?) AS tramNro"), [trim($data->tramAnio)]);

                $operacion = new tramOperacion();
                $operacion->topId = $opId[0]->tramNro;
                $operacion->topFecha = Carbon::parse($data->envDate)->format('d/m/Y h:i:s A');
                $operacion->topUsr = Auth::user()->usrID;
                $operacion->topUsrTarget = $data->envUsrTarget;
                $operacion->topMensaje = $data->envMensaje;
                $operacion->topFlagE = true;
                $operacion->topFlagR = false;
                $operacion->topEnvioId = $emisor->tlsId;
                $operacion->save();

                if(!$operacion){
                    throw new Exception("Error al registrar la operación " . $opId[0]->tramNro);
                }

                foreach($data->envDoc as $key=>$doc)
                {
                    $bandeja = new tramLogBandeja();
                    $bandeja->tlbOperacion = $opId[0]->tramNro;
                    $bandeja->tlbTypeDoc = $this->docType($doc);
                    $bandeja->tlbCodDoc = $doc;
                    $bandeja->tlbFechaDoc = Carbon::parse($data->envDate)->format('d/m/Y h:i:s A');
                    $bandeja->tlbFlagCheck = $this->docType($doc) == 'REQUERIMIENTO' ? false : true;
                    $bandeja->tlbSituacion = $data[$doc];
                    $bandeja->save();

                    unset($bandeja);
                }

                foreach($data->envDoc as $doc)
                {
                    if($this->docType($doc) == 'REQUERIMIENTO')
                    {
                        $requerimiento = tramTLogReq::find($doc);
                        $requerimiento->flagEnvio = true;
                        $requerimiento->save();

                        unset($requerimiento);
                    }
                    else if($this->docType($doc) == 'COTIZACION')
                    {
                        $cotizacion = tramTLogCtz::find($doc);
                        $cotizacion->flagEnvio = true;
                        $cotizacion->save();

                        unset($cotizacion);
                    }
                    else if($this->docType($doc) == 'CUADRO COMPARATIVO')
                    {
                        $cuadro = tramTLogCC::find($doc);
                        $cuadro->flagEnvio = true;
                        $cuadro->save();

                        unset($cuadro);
                    }
                    else if($this->docType($doc) == 'ORDEN DE COMPRA')
                    {
                        $compra = almTLogOC::find($doc);
                        $compra->flagEnvio = true;
                        $compra->save();

                        unset($compra);
                    }
                    else if($this->docType($doc) == 'ORDEN DE SERVICIO')
                    {
                        $servicio = tramTLogOS::find($doc);
                        $servicio->flagEnvio = true;
                        $servicio->save();

                        unset($servicio);
                    }
                }

                $tramNro = $opId[0]->tramNro;

            });

            if(is_null($exception)){
                $msg = 'Tramite Generado NRO: ' . $tramNro;
                $msgId = 200;
            }
            else{
                throw new Exception($exception);
            }

        }catch (Exception $e){

            $msg = "Error: " . $e->getMessage();
            $msgId = 500;
        }

        return response()->json(compact('msg','msgId'));

    }

    public function isAlreadyRemit($doc)
    {

    }

    public function docType($doc)
    {
        $prefijo = substr($doc,0,2);
        $documento = 'OTROS';

        switch($prefijo)
        {
            case 'RQ':
                $documento = 'REQUERIMIENTO';
                break;
            case 'CZ':
                $documento = 'COTIZACION';
                break;
            case 'CD':
                $documento = 'CUADRO COMPARATIVO';
                break;
            case 'OC':
                $documento = 'ORDEN DE COMPRA';
                break;
            case 'OS':
                $documento = 'ORDEN DE SERVICIO';
                break;
        }

        return $documento;
    }

    public function getConsultaProveedor(Request $request)
    {
        $view = view('tramite.panel-consulta');
        return $view;
    }

    public function postConsultaProveedor(Request $request)
    {
        $num = trim($request->searchDoc);
        $tipo = trim($request->searchTipo);
        $anio = trim($request->searchPeriodo);
        $codigo = $this->assembleCode($tipo,$anio,$num);

        switch($tipo)
        {
            case 'RQ':
                $cadena = tramSeguimiento::select('*')
                        ->where('reqID',$codigo)
                        ->get();
                break;
            case 'CZ':
                $cadena = tramSeguimiento::select('*')
                        ->where('ctzID',$codigo)
                        ->get();
                break;
            case 'CD':
                $cadena = tramSeguimiento::select('*')
                        ->where('cdrID',$codigo)
                        ->get();
                break;
            case 'OC':
                $cadena = tramSeguimiento::select('*')
                        ->where('orcID',$codigo)
                        ->get();
                break;
            case 'OS':
                $cadena = tramSeguimiento::select('*')
                        ->where('orsID',$codigo)
                        ->get();
                break;
        }


        if($cadena->isEmpty())
        {
            $msg = 'EL CÓDIGO INGRESADO NO TIENE SEGUIMIENTO REGISTRADO';
            return view('tramite.panel-error',[ 'message' => $msg ]);
        }

        /*dd($cadena->toArray());*/

        /*
         * DATOS DE SU REQUERIMIENTO
         * */
        if($cadena[0]->reqID != null)
        {
            $req = tramLogBandeja::select('*')
                ->with('remitente')
                ->with('verificador')
                ->with('receptor')
                ->addSelect(DB::raw("DB_Almacen.dbo.getCodNumber(tlbCodDoc) as shortID"))
                ->where('tlbCodDoc',$cadena[0]->reqID)
                ->get();
            if($req->isEmpty())
            {
                return view('tramite.panel-error',[ 'message' => 'EL CÓDIGO DE REQUERIMIENTO INGRESADO AUN NO HA INICIADO SU PROCESO DE TRAMITE' ]);
            }
        }

        /*
         * DATOS DE SU COTIZACION
         * */

        if($cadena[0]->ctzID != null)
        {
            $ctz = tramLogBandeja::select('*')
                ->with('remitente')
                ->with('receptor')
                ->addSelect(DB::raw("DB_Almacen.dbo.getCodNumber(tlbCodDoc) as shortID"))
                ->where('tlbCodDoc',$cadena[0]->ctzID)
                ->get();

            $ctz = $ctz->toArray();
        }
        else
        {
            $ctz = [];
        }

        /*
         * DATOS DE SU CUADRO COMPARATIVO
         * */

        if($cadena[0]->cdrID != null)
        {
            $cdr = tramLogBandeja::select('*')
                ->with('remitente')
                ->with('receptor')
                ->addSelect(DB::raw("DB_Almacen.dbo.getCodNumber(tlbCodDoc) as shortID"))
                ->where('tlbCodDoc',$cadena[0]->cdrID)
                ->get();

            $cdr = $cdr->toArray();
        }
        else
        {
            $cdr = [];
        }

        /*
         * DATOS DE SU ORDEN DE COMPRA O SERVICIO
         * */

        if($cadena[0]->orcID != null)
        {
            $orc = tramLogBandeja::select('*')
                ->with('remitente')
                ->with('receptor')
                ->addSelect(DB::raw("DB_Almacen.dbo.getCodNumber(tlbCodDoc) as shortID"))
                ->where('tlbCodDoc',$cadena[0]->orcID)
                ->get();

            $orden = $orc->toArray();
        }
        else if($cadena[0]->orsID != null)
        {
            $ors = tramLogBandeja::select('*')
                ->with('remitente')
                ->with('receptor')
                ->addSelect(DB::raw("DB_Almacen.dbo.getCodNumber(tlbCodDoc) as shortID"))
                ->where('tlbCodDoc',$cadena[0]->orsID)
                ->get();

            $orden = $ors->toArray();
        }
        else
        {
            $orden = [];
        }

        /*
         * DATOS DE ALMACEN - PECOSA
         * */

        if($cadena[0]->psal_pecosa != null)
        {
            $pcs = tramLogBandeja::select('*')
                ->with('remitente')
                ->with('receptor')
                ->addSelect(DB::raw("DB_Almacen.dbo.getCodNumber(tlbCodDoc) as shortID"))
                ->where('tlbCodDoc',$cadena[0]->psal_pecosa)
                ->get();

            $pcs = $pcs->toArray();
        }
        else
        {
            $pcs = [];
        }

        /*
         * DATOS SIAF ORDEN DE COMPRA
         * */
        $tool = new FormatCode();

        if($cadena[0]->orcID != null)
        {
            $oc = $tool->toNumberMode($cadena[0]->orcID);
            $siaf = tramViewSiafSeguimiento::where('tlbCodDoc',$oc)->get();
            $siaf = $siaf->toArray();
        }
        else
        {
            $siaf = [];
        }

        $result = array_merge($req->toArray(),$ctz,$cdr,$orden,$pcs,$siaf);
        $view = view('tramite.panel-result',['result' => $result]);
        return $view;



        /*if($tipo == 'RQ')
        {
            $req = tramLogBandeja::select('*')
                    ->with('remitente')
                    ->with('receptor')
                    ->where('tlbCodDoc',$codigo)
                    ->get();

            if(!$req->isEmpty())
            {
                $result = $req->toArray();
                $ctz = tramTLogCtz::select('ctzID')
                        ->where('ctzCodReq',$req)
                        ->get();

                if(!$ctz->isEmpty())
                {
                    $ctzBandeja = tramLogBandeja::select('*')
                            ->with('remitente')
                            ->with('receptor')
                            ->where('tlbCodDoc',$ctz)
                            ->get();
                    array_push($result,$ctzBandeja->toArray());

                    $cdr = tramTLogCC::select('cdrID')
                            ->where('cdrCodCtz')
                            ->get();

                    if(!$cdr->isEmpty())
                    {
                        $cdrBandeja = tramLogBandeja::select('*')
                                    ->with('remitente')
                                    ->with('receptor')
                                    ->where('tlbCodDoc',$cdr)
                                    ->get();
                        array_push($result,$cdrBandeja->toArray());

                        $ors = tramTLogOS::select('orsID')
                                ->where('orsCdr',$cdr)
                                ->get();

                        $orc = almTLogOC::select('orcID')
                                ->where('orcCdr',$cdr)
                                ->get();

                        if(!$ors->isEmpty())
                        {
                            $orsBandeja = tramLogBandeja::select('*')
                                ->with('remitente')
                                ->with('receptor')
                                ->where('tlbCodDoc',$ors)
                                ->get();
                            array_push($result,$orsBandeja->toArray());
                        }
                        else if(!$orc->isEmpty())
                        {
                            $orcBandeja = tramLogBandeja::select('*')
                                ->with('remitente')
                                ->with('receptor')
                                ->where('tlbCodDoc',$orc)
                                ->get();
                            array_push($result,$orcBandeja->toArray());
                        }
                    }
                }
            }
        }*/

        //dd($result);
        //return $result;
    }

    public function assembleCode($pref,$year,$number)
    {
        if($pref == 'RQ')
        {
            $number = substr('0000000'.$number,-7);
        }
        else
        {
            $number = substr('00000'.$number,-5);
        }

        $newCode = $pref.$year.$number;

        return $newCode;
    }

    public function indexSync()
    {
        $view = view('sync.index');
        return $view;
    }

    public function listsf()
    {
        $conn = new OleDbConnection();
        $conn->openDataOleDb(config('slam.PATH_SYNC'));
        $data = $conn->makeQueryOleDb('SELECT A.Ano_eje, A.Sec_ejec, A.Sec_func, A.Programa, A.Sub_programa, A.Act_proy, A.Finalidad, B.Nombre as Namepry FROM META as A INNER JOIN Finalidad as B ON A.Ano_eje =B.Ano_eje AND A.Finalidad = B.Finalidad  WHERE A.Ano_eje = "'.config('slam.ANIO').'" AND A.Sec_ejec="'.config('slam.UE_ENTIDAD').'" ORDER BY A.Sec_func ASC');
        $result = array();

        while(!$data->EOF){
            $sf['year'] = $data->Fields('Ano_eje')->value;
            $sf['ejec'] = $data->Fields('Sec_ejec')->value;
            $sf['sf'] = $data->Fields('Sec_func')->value;
            $sf['prog'] = $data->Fields('Programa')->value;
            $sf['subprg'] = $data->Fields('Sub_programa')->value;
            $sf['actpry'] = $data->Fields('Act_proy')->value;
            $sf['fin'] = $data->Fields('Finalidad')->value;
            $sf['name'] = iconv('','UTF-8',trim($data->Fields('Namepry')->value));

            array_push($result,$sf);

            $data->MoveNExt();
        }

        $data->Close();
        $conn->closeDataOleDb();
        $view = view('sync.listSyncSf',compact('result'));

        return $view;
    }

    public function updatesf(Request $request)
    {
        try{
            $periodo = substr($request->periodo,-2);

            $conn = new OleDbConnection();
            $conn->openDataOleDb(config('slam.PATH_SYNC'));

            $data = $conn->makeQueryOleDb('SELECT A.Ano_eje, A.Sec_ejec, A.Sec_func, A.Programa, A.Sub_programa, A.Act_proy, A.Finalidad, B.Nombre as Namepry FROM META as A INNER JOIN Finalidad as B ON A.Ano_eje =B.Ano_eje AND A.Finalidad = B.Finalidad  WHERE A.Ano_eje = "'.$request->periodo.'" AND A.Sec_ejec="' . config('slam.UE_ENTIDAD') . '" ORDER BY A.Sec_func ASC');

            if($data->EOF){
                throw new Exception('No existen secuencias funcionales que correspondan a los parámetros elegidos');
            }

            $result = array();

            while(!$data->EOF){
                $sf['year'] = $data->Fields('Ano_eje')->value;
                $sf['ejec'] = $data->Fields('Sec_ejec')->value;
                $sf['sf'] = $data->Fields('Sec_func')->value;
                $sf['prog'] = $data->Fields('Programa')->value;
                $sf['subprg'] = $data->Fields('Sub_programa')->value;
                $sf['actpry'] = $data->Fields('Act_proy')->value;
                $sf['fin'] = $data->Fields('Finalidad')->value;
                $sf['name'] = iconv('','UTF-8',trim($data->Fields('Namepry')->value));

                array_push($result,$sf);
                $data->MoveNExt();
            }

            $data->Close();
            $conn->closeDataOleDb();

            $registrados = 0;

            foreach ($result as $i=>$row){
                $sfid = 'SF' . $periodo . substr('00000' . $row['sf'],-5);
                $sfslam = almTPreSF::find($sfid);

                if(is_null($sfslam)) {
                    $secfun = new almTPreSF();
                    $secfun->secID = $sfid;
                    $secfun->secDsc = $row['name'];
                    $secfun->secFin = $row['fin'];
                    $secfun->save();

                    if($secfun)
                        $registrados++;
                    else
                        throw new Exception('Error al registrar la secuencia funcional ' . $row['sf']);
                }
            }

            $msg = "Se agregaron " . $registrados . " Secuencias Funcionales nuevas";
            $msgId = 200;

        }catch (Exception $e){
            $msgId = '500';
            $msg = 'Error: ' . $e->getMessage();
            $registrados = 999;
        }

        return response()->json(compact('msgId','msg','registrados'));
    }

    public function listclasif(Request $request)
    {
        $year = $request->nanioSecfun;
        $secfun = substr('0000' . $request->ncodSecfun, -4);

        $data = almTPrePto::where('ptoAnio',$year)
                ->where('ptoSecFun',$secfun)
                ->get();

        $view = view('sync.listLocalClasif', compact('data'));

        return $view;
    }

    public function listsyncclasif(Request $request)
    {
        try{
            $year = $request->nanioSecfun;
            $secfun = substr('0000' . $request->ncodSecfun, -4);

            $conn = new OleDbConnection();
            $conn->openDataOleDb(config('slam.PATH_SYNC'));

            $query = 'SELECT A.Ano_eje, A.Sec_func, A.Fuente_financ, B.clasificador, A.Id_clasificador, SUM(A.Modificacion) as Pim, SUM(A.Monto_certificado) as Certif  from gasto as A INNER JOIN maestro_clasificador as B ON B.Id_clasificador = A.Id_clasificador AND B.Ano_eje = A.Ano_eje  WHERE A.Ano_eje = "'.$year.'" AND A.Sec_func = "'.$secfun.'" AND A.Sec_ejec="'.config('slam.UE_ENTIDAD').'" GROUP BY A.Ano_eje, A.Sec_func, A.Fuente_financ, B.clasificador, A.Id_clasificador';

            $data = $conn->makeQueryOleDb($query);

            if($data->EOF){
                throw new Exception('No existen clasificadores que correspondan a los parámetros elegidos');
            }

            $clasiaf = array();

            while(!$data->EOF){
                $item['year'] = trim($data->Fields('Ano_eje')->value);
                $item['sf'] = trim($data->Fields('Sec_func')->value);
                $item['rubro'] = trim($data->Fields('Fuente_financ')->value);
                $item['claid'] = trim($data->Fields('Id_clasificador')->value);
                $item['cla'] = trim($data->Fields('clasificador')->value);
                $item['pim'] = trim($data->Fields('Pim')->value);
                $item['cert'] = trim($data->Fields('Certif')->value);

                array_push($clasiaf,$item);
                $data->MoveNExt();
            }

            $data->Close();
            $conn->closeDataOleDb();

            $updated = 0;
            $added = 0;

            foreach ($clasiaf as $cla){
                $localCla = almTPrePto::where('ptoAnio',$year)
                            ->where('ptoSecFun',$secfun)
                            ->where('ptoRubro',$cla['rubro'])
                            ->where('ptoIdClasificador',$cla['claid'])
                            ->first();

                if(is_null($localCla)){

                    $newLocalCla = new almTPrePto();
                    $newLocalCla->ptoAnio = $cla['year'];
                    $newLocalCla->ptoSecFun = $cla['sf'];
                    $newLocalCla->ptoRubro = $cla['rubro'];
                    $newLocalCla->ptoIdClasificador = $cla['claid'];
                    $newLocalCla->ptoClasificador = $cla['cla'];
                    $newLocalCla->ptoPim = $cla['pim'];
                    $newLocalCla->ptoCertif = $cla['cert'];
                    $newLocalCla->save();

                    if($newLocalCla)
                        $added++;
                    else
                        throw new Exception('Error al intentar registrar el clasificador');
                }
                else{
                    almTPrePto::where('ptoAnio',$year)
                        ->where('ptoSecFun',$secfun)
                        ->where('ptoRubro',$cla['rubro'])
                        ->where('ptoIdClasificador',$cla['claid'])
                        ->update(['ptoPim' => $cla['pim'], 'ptoCertif' => $cla['cert']]);

                    $updated++;
                }

            }

            $msg = "Se agregaron " . $added . " y se actualizaron " . $updated . " clasificadores para la secuencia funcional " . $secfun;
            $msgId = 200;


        }catch (Exception $e){
            $msgId = 500;
            $msg = 'Error: ' . $e->getMessage();
            $updated = 999;
            $added = 999;
        }

        return response()->json(compact('msgId','msg','added','updated'));
    }

    public function fullsyncclasif(Request $request)
    {
        try{

            /* El año de sincronizacion es establecido en la configuración de la aplicación */

            $year = $request->periodo;

            $conn = new OleDbConnection();
            $conn->openDataOleDb(config('slam.PATH_SYNC'));

            $query = 'SELECT A.Ano_eje, A.Sec_func, A.Fuente_financ, B.clasificador, A.Id_clasificador, SUM(A.Modificacion) as Pim, SUM(A.Monto_certificado) as Certif  from gasto as A INNER JOIN maestro_clasificador as B ON B.Id_clasificador = A.Id_clasificador AND B.Ano_eje = A.Ano_eje  WHERE A.Ano_eje = "'.$year.'" AND A.Sec_ejec="'.config('slam.UE_ENTIDAD').'" GROUP BY A.Ano_eje, A.Sec_func, A.Fuente_financ, B.clasificador, A.Id_clasificador';

            $data = $conn->makeQueryOleDb($query);

            if($data->EOF){
                throw new Exception('No existen clasificadores que correspondan a los parámetros elegidos');
            }

            $clasiaf = array();

            while(!$data->EOF){
                $item['year'] = trim($data->Fields('Ano_eje')->value);
                $item['sf'] = trim($data->Fields('Sec_func')->value);
                $item['rubro'] = trim($data->Fields('Fuente_financ')->value);
                $item['claid'] = trim($data->Fields('Id_clasificador')->value);
                $item['cla'] = trim($data->Fields('clasificador')->value);
                $item['pim'] = trim($data->Fields('Pim')->value);
                $item['cert'] = trim($data->Fields('Certif')->value);

                array_push($clasiaf,$item);
                $data->MoveNExt();
            }

            $data->Close();
            $conn->closeDataOleDb();

            $updated = 0;
            $added = 0;

            foreach ($clasiaf as $cla){
                $localCla = almTPrePto::where('ptoAnio',$year)
                    ->where('ptoSecFun',$cla['sf'])
                    ->where('ptoRubro',$cla['rubro'])
                    ->where('ptoIdClasificador',$cla['claid'])
                    ->first();

                if(is_null($localCla)){

                    $newLocalCla = new almTPrePto();
                    $newLocalCla->ptoAnio = $cla['year'];
                    $newLocalCla->ptoSecFun = $cla['sf'];
                    $newLocalCla->ptoRubro = $cla['rubro'];
                    $newLocalCla->ptoIdClasificador = $cla['claid'];
                    $newLocalCla->ptoClasificador = $cla['cla'];
                    $newLocalCla->ptoPim = $cla['pim'];
                    $newLocalCla->ptoCertif = $cla['cert'];
                    $newLocalCla->save();

                    if($newLocalCla)
                        $added++;
                    else
                        throw new Exception('Error al intentar registrar el clasificador');
                }
                else{
                    almTPrePto::where('ptoAnio',$year)
                        ->where('ptoSecFun',$cla['sf'])
                        ->where('ptoRubro',$cla['rubro'])
                        ->where('ptoIdClasificador',$cla['claid'])
                        ->update(['ptoPim' => $cla['pim'], 'ptoCertif' => $cla['cert']]);

                    $updated++;
                }

            }

            $msg = "Se agregaron " . $added . " y se actualizaron " . $updated . " clasificadores de todas las secuencias funcionales ";
            $msgId = 200;


        }catch (Exception $e){
            $msgId = 500;
            $msg = 'Error: ' . $e->getMessage();
            $updated = 999;
            $added = 999;
        }

        return response()->json(compact('msgId','msg','added','updated'));
    }

    public function testSiaf()
    {
        $test = new OleDbConnection();
        //$test->openDataOleDb("\\\\192.168.1.90\data");
        $test->openDataOleDb(config('slam.PATH_SYNC'));
        $rs = $test->makeQueryOleDb('SELECT Ano_eje, Sec_ejec,Expediente,Ciclo,Fase,Secuencia,Correlativo,Cod_doc,Num_doc,Fecha_doc,Moneda,Monto,Ano_proceso,Mes_proceso,Dia_proceso,Fecha_autorizacion,Estado_envio from expediente_secuencia WHERE cod_doc in ("032") AND Ano_eje in ("2018")');

        while(!$rs->EOF)
        {
            $fv = $rs->Fields("Num_doc");
            $doc = $rs->Fields("Cod_doc");
            $mnt = $rs->Fields("Monto");
            echo $fv->value." - ".$doc->value."-".$mnt->value."<br>";
            $rs->MoveNext();
        }

        $rs->Close();
        $test->closeDataOleDb();
        $test = null;

    }

    public function fillDataSiaf()
    {
        $siaf = new OleDbConnection();
        $siaf->openDataOleDb('E:\Data_SIAF_Seguimiento');
        $rs = $siaf->makeQueryOleDb('SELECT Ano_eje, Sec_ejec,Expediente,Ciclo,Fase,Secuencia,Correlativo,Cod_doc,Num_doc,Fecha_doc,Moneda,Monto,Ano_proceso,Mes_proceso,Dia_proceso,Fecha_autorizacion,Estado_envio from expediente_secuencia WHERE cod_doc in ("031") AND Ano_eje in ("2016","2017")');

        if($rs)
        {
            try{

                $exception = DB::transaction(function() use ($rs){

                    while(!$rs->EOF)
                    {
                        $tabla = new siafOrdenCompra();

                        $tabla->socAno_eje = trim($rs->Fields("Ano_eje")->value);
                        $tabla->socSec_ejec = trim($rs->Fields("Sec_ejec")->value);
                        $tabla->socExpediente = trim($rs->Fields("Expediente")->value);
                        $tabla->socCiclo = trim($rs->Fields("Ciclo")->value);
                        $tabla->socFase = trim($rs->Fields("Fase")->value);
                        $tabla->socSecuencia = trim($rs->Fields("Secuencia")->value);
                        $tabla->socCorrelativo = trim($rs->Fields("Correlativo")->value);
                        $tabla->socCod_doc = trim($rs->Fields("Cod_doc")->value);
                        $tabla->socNum_doc = iconv('','UTF-8',trim($rs->Fields("Num_doc")->value));
                        $tabla->socFecha_doc = trim($rs->Fields("Fecha_doc")->value);
                        $tabla->socMoneda = trim($rs->Fields("Moneda")->value);
                        $tabla->socMonto = trim($rs->Fields("Monto")->value);
                        $tabla->socAno_proceso = trim($rs->Fields("Ano_proceso")->value);
                        $tabla->socMes_proceso = trim($rs->Fields("Mes_proceso")->value);
                        $tabla->socDia_proceso = trim($rs->Fields("Dia_proceso")->value);
                        $tabla->socFecha_autorizacion = trim($rs->Fields("Fecha_autorizacion")->value);
                        $tabla->socEstado_envio = trim($rs->Fields("Estado_envio")->value);
                        $tabla->socUpdateBy = 'admin';
                        $tabla->socUpdateAt = Carbon::now()->format('d/m/Y h:i:s A');

                        $tabla->save();
                        unset($tabla);

                        $rs->MoveNext();
                    }
                });

                $msg = is_null($exception) ? 'Tabla siafOrdenCompra actualizada correctamente' : $exception;

            }catch(Exception $e){
                $rs->Close();
                $siaf->closeDataOleDb();
                $siaf = null;
                return 'Excepción capturada: '. $e->getMessage() . "\n";
            }
        }

        $rs->Close();
        $siaf->closeDataOleDb();
        $siaf = null;
        return $msg;

    }

    public function cleanDataSiaf()
    {
        DB::connection('dbalmacen')->table('siafOrdenCompra')->truncate();
        return 'Tabla siafOrdenCompra limpiada completamente';
    }

    public function cleanString($String)
    {
        $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
        $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
        $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
        $String = str_replace(array('í','ì','î','ï'),"i",$String);
        $String = str_replace(array('é','è','ê','ë'),"e",$String);
        $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
        $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
        $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
        $String = str_replace(array('ú','ù','û','ü'),"u",$String);
        $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
        $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
        $String = str_replace("ç","c",$String);
        $String = str_replace("Ç","C",$String);
        $String = str_replace("ñ","n",$String);
        $String = str_replace("Ñ","N",$String);
        $String = str_replace("Ý","Y",$String);
        $String = str_replace("ý","y",$String);

        $String = str_replace("&aacute;","a",$String);
        $String = str_replace("&Aacute;","A",$String);
        $String = str_replace("&eacute;","e",$String);
        $String = str_replace("&Eacute;","E",$String);
        $String = str_replace("&iacute;","i",$String);
        $String = str_replace("&Iacute;","I",$String);
        $String = str_replace("&oacute;","o",$String);
        $String = str_replace("&Oacute;","O",$String);
        $String = str_replace("&uacute;","u",$String);
        $String = str_replace("&Uacute;","U",$String);

        return trim($String);
    }
}
