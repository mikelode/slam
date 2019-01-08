<?php

namespace Logistica\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Logistica\Almacen\almInternamiento;
use Logistica\Almacen\almInventario;
use Logistica\Almacen\almProcesoInternamiento;
use Logistica\Almacen\almProcesoSalida;
use Logistica\Almacen\almSeguimiento;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

class seguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $result = \DB::select('exec spLogGetAcceso ? ,? ', array(Auth::user()->usrID,'LOG_ALM_CONS'  ));
        if( isset ($result[0]->NEW ))
        {
            if( $result[0]->NEW =="1") {
                    return view('almacen.seguimiento.panel-seguimiento');
            }
            else {
                return view('logistica.Adq.vwPermission');
            }
        }
        else {
            return view('logistica.Adq.vwPermission');
        }

        
    }

    public function getDataSeguimientoGi(Request $request)
    {
        $gi = $this->assembleCode('GI',$request->year,$request->segGi) ;
        $internamiento = almInternamiento::with('inventario')->find($gi);
        $ingreso = almProcesoInternamiento::with('productos_ingresados')->where('cod_giu',$gi)->get();
        $salida = almProcesoSalida::with('productos_distribuidos')->where('ing_giu',$gi)->get();
        $seguimiento = almSeguimiento::where('seg_giu',$gi)->get();

        $view = view('almacen.seguimiento.dataSeguimiento',['internamiento' => $internamiento, 'ingreso' => $ingreso, 'salida' => $salida, 'seguimiento' => $seguimiento]);

        if(!is_null($internamiento))
        {
            return $view;
        }
        else
        {
            $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$gi;
            return view('errors.error-busqueda',['message' => $msg]);
        }



    }

    public function assembleCode($pref,$year,$number)
    {
        $number = substr('00000'.$number,-5);
        $newCode = $pref.substr($year,2,2).$number;
        return $newCode;
    }

    public function getDataSeguimientoPs(Request $request)
    {
        $ps = $this->assembleCode('PS',$request->year,$request->segPs);
        $salida = almProcesoSalida::with('productos_distribuidos')->where('psal_pecosa',$ps)->get();
        $msg = 'NO EXISTE REGISTRO PARA EL CODIGO '.$ps;
        if(count($salida)==0) return view('errors.error-busqueda',['message' => $msg]);

        $internamiento = almInternamiento::with('inventario')->find($salida[0]->ing_giu);
        $ingreso = almProcesoInternamiento::with('productos_ingresados')->where('cod_giu',$salida[0]->ing_giu)->get();
        $salida = almProcesoSalida::with('productos_distribuidos')->where('ing_giu',$salida[0]->ing_giu)->get();
        $seguimiento = almSeguimiento::where('seg_giu',$salida[0]->ing_giu)->get();

        $view = view('almacen.seguimiento.dataSeguimiento',['internamiento' => $internamiento, 'ingreso' => $ingreso, 'salida' => $salida, 'seguimiento' => $seguimiento]);

        return $view;

    }
}
