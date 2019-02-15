<?php

namespace Logistica\Http\Controllers\Requerimiento;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

class lsmReq extends Controller
{
    public function spLogListReq()
    {
        try{
            $idUsr = Auth::user()->usrID;
            $prRows = '';
            $prAnio = '2019';
            $prQry = "and reqUsrID = '" . $idUsr . "'";

            $ReqData = \DB::select('exec spLogGetReq ?,?,?', array(  $prRows, $prAnio, $prQry ));

            if(count($ReqData) == 0){
                $msg = 'No existen requerimiento registrados por Ud.';
            }
            else{
                $msg = 'Requerimientos recuperados correctamente';
            }

            $view = view('logistica.Adq.vwAdqReqList', compact('ReqData','msg'));

        }catch (Exception $e){
            $msg = "Atención: " + $e->getMessage();
            $view = null;
        }

        return $view;
    }
}
