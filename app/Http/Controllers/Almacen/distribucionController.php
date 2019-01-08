<?php

namespace Logistica\Http\Controllers\Almacen;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almInventario;
use Logistica\Almacen\almProcesoSalida;
use Logistica\Almacen\almProcesoSalidaB;
use Logistica\Almacen\almRecyclePecosa;
use Logistica\Almacen\almSeguimiento;
use Logistica\Almacen\almTPerPrs;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Logistica\Http\Requests\almStoreDistPostRequest;

class distribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($period, Request $request)
    {
          $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_ALM_PSA'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                
                 $giu = almInternamiento::select('*')
                    ->with('pecosas')
                    ->join('Almacen','ing_almacen','=','id')
                    ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
                    ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
                    ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
                    
                   // ->where('estado_validacion','T')
                   // ->orWhere('estado_validacion','C')
                   //  ->whereRaw("'20'+SUBSTRING(ing_giu,3,2)='".$period."'")
                    ->whereRaw("estado_validacion in ('C', 'T')")

                    ->where('estado_anulacion','NO')
                    ->whereRaw('YEAR(conf_fecha) = '.$period)
                    ->orderBy('estado_salida','DESC')
                    ->orderBy('conf_fecha','DESC')
                    ->paginate(30);

        $view = view('almacen.salida.panel-salida',compact('giu'));

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
            ->with('pecosas')
            ->join('Almacen','ing_almacen','=','id')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            //->where('flagI',true)
            ->where('estado_validacion','T')
            ->orWhere('estado_validacion','C')
            ->where('estado_anulacion','NO')
            ->whereRaw('YEAR(conf_fecha) = '.$year)
            ->orderBy('estado_salida','DESC')
            ->orderBy('conf_fecha','DESC')
            ->paginate(30);

        $view = view('almacen.salida.panel-salidaPage',compact('giu'));

        if($request->ajax())
        {
            return $view;
        }
    }

    public function getFindPecosa($ps, Request $request)
    {
        $year = trim($request->year);
        $ps = $this->assembleCode('PS',$year,trim($ps));
        $pecosa = almProcesoSalida::find($ps);

        if(is_null($pecosa))
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$ps;
            return view('errors.error-busqueda',['message' => $msg]);
        }

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            //->where('flagI',true)
            ->where('estado_validacion','<>','P')
            ->where('estado_anulacion','NO')
            ->where('ing_giu',$pecosa->ing_giu)
            ->orderBy('conf_fecha','DESC')
            ->paginate(30);

        $view = view('almacen.salida.panel-salidaPage',compact('giu'));

        return $view;
    }

    public function getFindPecosaOrden($oc, Request $request)
    {
        $year = trim($request->year);
        $oc = $this->assembleCode('OC',$year,trim($oc));

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(oc_cod) as shortOc"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            //->where('flagI',true)
            ->where('estado_validacion','<>','P')
            ->where('estado_anulacion','NO')
            ->where('oc_cod',$oc)
            ->orderBy('conf_fecha','DESC')
            ->paginate(30);

        if(count($giu) == 0)
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$oc;
            $view = view('errors.error-busqueda',['message' => $msg]);
        }
        else
        {
            $view = view('almacen.salida.panel-salidaPage',compact('giu'));
        }

        return $view;
    }

     public function getFindPecosaNea($nea, Request $request)
    {
        $year = trim($request->year);
        $nea = $this->assembleCode('NE',$year,trim($nea));

        $giu = almInternamiento::select('*')
            ->join('Almacen','ing_almacen','=','id')
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortNea"))
            ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(ing_giu) as shortGi"))
            ->addSelect(DB::raw("DB_Logistica.dbo.fnLogGetGrlDat('ADQTIP',oc_tipoProceso,'') as ocProcTipo"))
            
            ->where('estado_validacion','<>','P')
            ->where('estado_anulacion','NO')
            ->where('ing_giu',$nea)
            ->orderBy('conf_fecha','DESC')
            ->paginate(30);

        if(count($giu) == 0)
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$oc;
            $view = view('errors.error-busqueda',['message' => $msg]);
        }
        else
        {
            $view = view('almacen.salida.panel-salidaPage',compact('giu'));
        }

        return $view;
    }


    public function getDistribucionEdit($ps)
    {
        $proceso = almProcesoSalida::with('productos_distribuidos')
                    ->where('psal_pecosa',$ps)
                    ->get();

        $giu = almInternamiento::with('inventario')
                    ->where('ing_giu',$proceso[0]->ing_giu)
                    ->get();

        $pecosas = almProcesoSalida::with('productos_distribuidos')
                    ->select('*')
                    ->addSelect(DB::raw("DB_Almacen.dbo.getCodShort(psal_pecosa) as shortPs"))
                    ->where('ing_giu',$proceso[0]->ing_giu)
                    ->get();

        $view = view('almacen.salida.distribucionEdit',['proceso' => $proceso,'giu' => $giu, 'pecosas' => $pecosas]);

        return $view;
    }

    public function getDistribucionBienes($gi, Request $request)
    {
        $giu = almInternamiento::find($gi);
        $bienes = almInternamiento::find($gi)->inventario;
        $applicant = DB::connection('dblogistica')->table('TLogOC')
                            ->join('TLogReq','orcReq','=','reqID')
                            ->join('TPerPrs','reqSolicitante','=','perID')
                            ->select('*')
                            ->where('orcID',$giu->oc_cod)->get();

        $view = view('almacen.salida.distribucion',['giu' => $giu, 'bienes' => $bienes, 'applicant' => $applicant]);

        return $view;
    }

    public function postDistribucionBienes($gi, almStoreDistPostRequest $request)
    {
        try{
            $exception = DB::transaction(function($request) use ($gi, $request){

                $guia = almInternamiento::find($gi);
                $bienes = almInternamiento::find($gi)->inventario;

                /*
                 * GENERAMOS NUEVO CODIGO DE PECOSA
                 * */
                $ps = '';
                $pref = 'PS';
                $anio = $request->almAnio;

                 $result = \DB::connection('dbalmacen')->select('exec generar_codigoFin ?,?',  array( $anio ,  $pref));  
                $ps= $result[0]->codigo ;

               /* $stmt = DB::connection('dbalmacen')->getPdo()->prepare('SET NOCOUNT ON; EXEC generar_codigo ?,?');
                $stmt->bindParam(1,$pref);
                $stmt->bindParam(2,$ps,\PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 11);
                $stmt->execute();
                unset($stmt);
*/
                /*
                 * REGISTRAMOS PROCESO DE SALIDA
                 * */

                $pcs = new almProcesoSalida();
                $pcs->psal_pecosa = $ps;
                $pcs->ing_giu = $guia->ing_giu;
                $pcs->psal_fecha = $request->disDateAttend;
                $pcs->psal_dni_solicitante = $request->disDniApplicant;
                $pcs->psal_solicitante =$request->disNameApplicant ;
                $pcs->psal_dependencia_solic = $request->disDependency;
                $pcs->psal_solic_cargo = $request->disRole;
                $pcs->psal_usu_despachador = $request->disNameServer;
                $pcs->psal_destino = $request->disTarget;
                $pcs->psal_receptor = $request->receptorNameApplicant;
                $pcs->psal_receptordni = $request->receportDniApplicant;
                $pcs->seguimiento = " ";
                $pcs->psal_observacion = $request->disComment;
                $pcs->psal_guiarem = $request->guiarem;
                $pcs->psal_factura = $request->factura;
                $pcs->usu_act = Auth::user()->usrID;// 'usuario';
                $pcs->fec_act = Carbon::now()->format('d/m/Y h:i:s A');
                $pcs->hor_act = Carbon::now()->toTimeString();
                $pcs->save();

                $flagS = true;
                $tmp = '';
                foreach($bienes as $item)
                {
                    /*
                     * VALIDACACION DE LA DISTRIBUCION DE BIENES
                     * */

                    $distribuido = is_null($request['disQ-' . $item->prod_cod . '-' . $item->id])?0:$request['disQ-' . $item->prod_cod . '-' . $item->id];
                    $comentario = is_null($request['disC-' . $item->prod_cod . '-' . $item->id])?'Distribuido Completamente':$request['disC-' . $item->prod_cod . '-' . $item->id];

                    /*
                     * REGISTRAMOS PROCESO DE INTERNAMIENTO DETALLADO (PRODUCTOS)
                     * */

                    $pcsb = new almProcesoSalidaB();
                    $pcsb->psalp_pecosa = $ps;
                    $pcsb->psalp_cod = $item->prod_cod;
                    $pcsb->psalp_desc = $item->prod_desc;
                    $pcsb->psalp_cant = $item->prod_cant;
                    $pcsb->psalp_cant_atend = $distribuido; // $request['disQ-' . $item->prod_cod];
                    $pcsb->psalp_umedida = $item->prod_medida;
                    $pcsb->psalp_precio = $item->prod_precio;
                    $pcsb->psalp_costo = $distribuido * $item->prod_precio; //$item->prod_costo;
                    $pcsb->psalp_marca = $item->prod_marca;
                    $pcsb->psalp_observacion = $comentario; // $request['disC-' . $item->prod_cod];
                    $pcsb->save();

                    unset($pintb);

                    /*
                     * ACTUALIZACIÓN DE LA TABLA DE INVENTARIO
                     * */
                    $estado = $this->estado_distribucion_producto($distribuido,$item->prod_stock);
                    /*$estado = $this->estado_distribucion_producto($request['disQ-' . $item->prod_cod],$item->prod_stock);*/

                    if($estado == 'X')
                    {
                        throw new Exception('Revise sus datos de cantidad distribuida ó atendida: '.$estado);
                    }
                    else
                    {
                        if($estado != 'C') $flagS = false;
                    }

                    $inventory = almInventario::find($item->id);
                    $inventory->prod_distribuido = $item->prod_distribuido + $distribuido; // $request['disQ-' . $item->prod_cod];
                    if(!is_null($request['disQ-' . $item->prod_cod . '-' . $item->id]))
                        $inventory->prod_stock = $item->prod_stock - $request['disQ-' . $item->prod_cod . '-' . $item->id];
                    $inventory->flagD = $estado=='C'?true:false;
                    $inventory->prod_salobs = $comentario; //$request['disC-' . $item->prod_cod];
                    $inventory->save();

                    unset($inventory);
                }

                /*
                 * ACTUALIZACIÓN DE LA TABLA DE INTERNAMIENTO
                 * */

                $internment = almInternamiento::find($gi);
                $internment->flagS = $flagS;
                $internment->estado_salida = $flagS?'C':'I';
                $internment->save();

                /*
                 * REGISTRAMOS DATOS DE SEGUIMIENTO
                 * */

                $tracking = new almSeguimiento();
                $tracking->seg_giu = $gi;
                $tracking->seg_operacion = 'Distribución-Salida';
                $tracking->seg_usuario = Auth::user()->usrID; //'usuario';
                $tracking->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                $tracking->seg_hora = Carbon::now()->toTimeString();
                $tracking->seg_descripcion = "Distribución de bienes de la OC:".$guia->oc_cod." como la GI:".$gi." PECOSA: ".$ps;
                $tracking->save();

            });

            return is_null($exception) ? 'Registro exitoso de la PECOSA' : $exception;

        }catch (Exception $e){
            return 'Excepción capturada: '. $e->getMessage() . "\n";
        }
    }

    public function estado_distribucion_producto($cant_dist, $stock)
    {
        $dif = $stock - $cant_dist;
        $estado = 'X';

        if($dif == $stock && $stock != 0)
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
                $estado = 'I';
            }
        }

        return $estado;
    }

    public function assembleCode($pref,$year,$number)
    {
        $number = substr('00000'.$number,-5);
        $newCode = $pref.substr($year,2,2).$number;
        return $newCode;
    }

    public function postUpdatePecosa(Request $request)
    {
        $field = $request->control;
        $result = array();

        switch($field)
        {
            case 'quantity':
                $result['msg'] = $this->actualizar_cantidad($request->pk,$request->name,$request->value);
                break;
            case 'general':
                $result['msg'] = $this->actualizar_data($request->pk,$request->name,$request->value);
                break;
            default:
                $result['msg'] = 'Error en la elección del campo a editar';
        }

        $result['ps'] = $request->pk;

        return response()->json($result);
    }

    public function actualizar_cantidad($campo, $field, $value)
    {
        /*
         * indice 0 = numero de pecosa a editar
         * indice 1 = codigo del producto a editar
         * indice 2 = id que le pertenece al producto en inventario
         * indice 3 = id que le pertenece al producto en la pecosa a editar
         * indice 4 = id del mismo productos de las demas pecosas (parents)
         * */
        $keys = explode('$',$campo);

        try{
            $estado = $this->validarCantidad($keys,$value);
            $response = array();

            if($estado['valido'])
            {
                $exception = DB::transaction(function() use($keys,$value,$estado){

                    /*
                     * ACTUALIZANDO CANTIDAD DEL PRODUCTO DEL PROCESO DE SALIDA
                     * */

                    almProcesoSalidaB::where('psalp_pecosa',$keys[0])
                        ->where('psalp_cod',$keys[1])
                        ->where('id',$keys[3])
                        ->update(['psalp_cant_atend' => $value]);

                    /*
                     * ACTUALIZANDO INVENTARIO
                     * */

                    $pecosa = almProcesoSalida::find($keys[0]);
                    $producto = almInventario::where('cod_giu',$pecosa->ing_giu)
                                        ->where('prod_cod',$keys[1])
                                        ->where('id',$keys[2])
                                        ->get();

                    $inventario = almInventario::find($producto[0]->id);

                    $inventario->prod_distribuido = $inventario->prod_cant - $estado['stock'];
                    $inventario->prod_stock = $estado['stock'];
                    $inventario->flagD = $estado['stock']==0 ? true : false;

                    $inventario->save();

                    /*
                     * ACTUALIZANDO INTERNAMIENTO
                     * */

                    $guia = almInternamiento::find($pecosa->ing_giu);
                    $flagS = $this->validarFlagSalida($pecosa->ing_giu);

                    $guia->flagS = $flagS;
                    $guia->estado_salida = $flagS ? 'C' : 'I';

                    $guia->save();
                });

                if(is_null($exception))
                {
                    $response['msg'] = 'Modificado Correctamente';
                    $response['ps'] = $keys[0];
                }
                else
                {
                    $response['msg'] = $exception;
                    $response['ps'] = $keys[0];
                }

                return response()->json($response);
            }
            else
            {
                return false;
            }

        }catch(Exception $e){

            $response['msg'] = 'Excepción capturada: '. $e->getMessage() . "\n";
            $response['ps'] = $keys[0];
            return response()->json($response);
        }
    }

    public function validarFlagSalida($gi)
    {
        $inventario = almInventario::where('cod_giu',$gi)->get();
        $flag = true;

        foreach($inventario as $producto)
        {
            if($producto->flagD == false)
                $flag = false;
        }

        return $flag;
    }

    public function validarCantidad($key,$value)
    {
        /*
         * indice 0 = numero de pecosa a editar
         * indice 1 = codigo del producto a editar
         * indice 2 = id que le pertenece al producto en inventario
         * indice 3 = id que le pertenece al producto en la pecosa a editar
         * indice 4 = id del mismo productos de las demas pecosas (parents)
         * */
        $idPcs = explode(' ',trim($key[4]));

        $pecosa_to_edit = almProcesoSalida::find($key[0]);
        /*$giTmp = almInternamiento::find($pecosa_to_edit->ing_giu);*/
        /*$pecosasTmp = almProcesoSalida::with('productos_distribuidos')
                        ->where('ing_giu',$pecosa_to_edit->ing_giu)
                        ->get();*/

        $pecosasTmp = almProcesoSalida::select('*')
                        ->join('psal_productos','psal_pecosa','=','psalp_pecosa')
                        ->where('ing_giu',$pecosa_to_edit->ing_giu)
                        ->whereIn('id',$idPcs)
                        ->get();

        $cantTmp = $value;

        foreach($pecosasTmp as $ps)
        {
            if($ps->psal_pecosa != $key[0])
                $cantTmp += $ps->psalp_cant_atend;
        }

        $stockTmp = $pecosasTmp[0]->psalp_cant - $cantTmp;
        $result = array('stock' => $stockTmp);

        if($cantTmp <= $pecosasTmp[0]->psalp_cant)
        {
            /*Valor Valido*/
            $result['valido'] = true;
            return $result;
        }
        else
        {
            /*Valor Invalido*/
            $result['valido'] = false;
            return $result;
        }
    }

    public function actualizar_data($ps, $field, $value)
    {
        try{

            $exception = DB::transaction(function() use ($ps, $field, $value){

                $pecosa = almProcesoSalida::find($ps);

                switch($field)
                {
                    case 'datePs':
                        $pecosa->psal_fecha = $value;
                        break;

                     case 'guiarem':
                        $pecosa->psal_guiarem = $value;
                        break;

                     case 'factura':
                        $pecosa->psal_factura = $value;
                        break;


                    case 'recepPs':
                        $pecosa->psal_receptor = $value;
                        break;

                    case 'commentPs':
                        $pecosa->psal_observacion = $value;
                        break;
                    case 'solicPs':
                        $persona = almTPerPrs::find($value);
                        if(!is_null($persona))
                        {
                            $pecosa->psal_dni_solicitante = $persona->perID;
                            $pecosa->psal_solicitante = $persona->perNombres.' '.$persona->perAPaterno.' '.$persona->perAMaterno;
                        }
                        else
                        {
                            throw new Exception('Error, el DNI no está registrado en el sistema');
                        }
                        break;

                     case 'receptorPs':
                        $persona = almTPerPrs::find($value);
                        if(!is_null($persona))
                        {
                            $pecosa->psal_receptordni = $persona->perID;
                            $pecosa->psal_receptor = $persona->perNombres.' '.$persona->perAPaterno.' '.$persona->perAMaterno;
                        }
                        else
                        {
                            throw new Exception('Error, el DNI del receptor no está registrado en el sistema');
                        }
                    break;

                    default:
                        throw new Exception('Error en la selección del campo a editar');
                }

                $pecosa->save();
            });

            return is_null($exception) ? 'Modificado con Éxito' : $exception;

        }catch(Exception $e){
            return 'Excepción capturada: '. $e->getMessage() . "\n";
        }
    }

    public function postRemovePecosa(Request $request)
    {
        try{
            $pecosa = almProcesoSalida::with('productos_distribuidos')
                        ->where('psal_pecosa',$request->removePcs)
                        ->get();
            $message = '200';

            $exception = DB::transaction(function() use ($pecosa, $request){

                foreach($pecosa[0]->productos_distribuidos as $item)
                {
                    $recycle = new almRecyclePecosa();

                    $recycle->pcsCodigo = $pecosa[0]->psal_pecosa;
                    $recycle->pcsGiu = $pecosa[0]->ing_giu;
                    $recycle->pcsFecha = $pecosa[0]->psal_fecha;
                    $recycle->pcsDniSolicitante = $pecosa[0]->psal_dni_solicitante;
                    $recycle->pcsNameSolicitante = $pecosa[0]->psal_solicitante;
                    $recycle->pcsDepSolicitante = $pecosa[0]->psal_dependencia_solic;
                    $recycle->pcsDespachador = $pecosa[0]->psal_usu_despachador;
                    $recycle->pcsDestino = $pecosa[0]->psal_destino;
                    $recycle->pcsProdCod = $item->psalp_cod;
                    $recycle->pcsProdDsc = $item->psalp_desc;
                    $recycle->pcsProdCant = $item->psalp_cant;
                    $recycle->pcsProdCantAtend = $item->psalp_cant_atend;
                    $recycle->pcsProdPrecio = $item->psalp_precio;
                    $recycle->pcsProdMedida = $item->psalp_umedida;
                    $recycle->pcsProdCosto = $item->psalp_costo;
                    $recycle->pcsProdMarca = $item->psalp_marca;
                    $recycle->pcsRemoveAt = Carbon::now()->format('d/m/Y h:i:s A');
                    $recycle->pcsRemoveBy = Auth::user()->usrID;
                    $recycle->pcsRemoveFor = $request->rmvCause;

                    $recycle->save();
                    unset($recycle);
                }
            });

            if(is_null($exception))
            {
                $exceptionUpdate = DB::transaction(function() use ($pecosa){
                    $npecosas = almProcesoSalida::where('ing_giu',$pecosa[0]->ing_giu)->count();

                    $internamiento = almInternamiento::find($pecosa[0]->ing_giu);
                    $internamiento->estado_salida = $npecosas > 1 ? 'I' : 'P';
                    $internamiento->flagS = false;
                    $internamiento->save();

                    foreach($pecosa[0]->productos_distribuidos as $item)
                    {
                        $inventario = almInventario::select('*')
                            ->where('cod_giu',$pecosa[0]->ing_giu)
                            ->where('prod_cod',$item->psalp_cod)
                            ->where('prod_desc',$item->psalp_desc)
                            ->get();

                        $prod_inventario = almInventario::find($inventario[0]->id);
                        $prod_inventario->prod_distribuido = $prod_inventario->prod_distribuido - $item->psalp_cant_atend;
                        $prod_inventario->prod_stock = $prod_inventario->prod_stock + $item->psalp_cant_atend;
                        $prod_inventario->flagD = false;
                        $prod_inventario->save();
                    }
                });

                if(is_null($exceptionUpdate))
                {
                    almProcesoSalida::destroy($request->removePcs);

                    $seguimiento = new almSeguimiento();

                    $seguimiento->seg_giu = $request->removePcs;
                    $seguimiento->seg_operacion = 'Eliminacion';
                    $seguimiento->seg_usuario = Auth::user()->usrID; // 'usuario';
                    $seguimiento->seg_fecha = Carbon::now()->format('d/m/Y h:i:s A');
                    $seguimiento->seg_hora = Carbon::now()->toTimeString();
                    $seguimiento->seg_descripcion = "Eliminación del registro de la PECOSA:".$request->removePcs." que tiene la GI:".$pecosa[0]->ing_giu;

                    $seguimiento->save();
                }
                else
                {
                    $message = $exceptionUpdate;
                }
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
