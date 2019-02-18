<?php

namespace Logistica\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Logistica\Almacen\almTLogReq;
use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;
use Mockery\Exception;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vista= view('home');
        return $vista;
        //return view('home');
    }

    public function conciliar_secfunrubro()
    {
        try{

            DB::transaction(function(){
                $reqs = DB::select(DB::raw("select reqID, reqSecFun, reqRubro, rdtID, rdtSecFun, rdtRubro, rdtCodProd from TLogReq
                        inner join TLogReqD on reqID = rdtCodReq
                        where (rdtSecFun IS NULL or rdtRubro IS NULL)"));

                $irq = 0;
                foreach ($reqs as $key => $item) {

                    if(substr($item->reqSecFun,-1) == 'M') continue;

                    DB::table('TLogReqD')
                        ->where('rdtID', $item->rdtID)
                        ->where('rdtCodReq', $item->reqID)
                        ->update(['rdtSecFun' => $item->reqSecFun, 'rdtRubro' => $item->reqRubro]);

                    $irq++;
                }

                echo "Se actualizaron " . $irq . " requerimientos <br>";

                $ctzs = DB::select(DB::raw("select ctzID, reqID, reqSecFun, reqRubro, zdtCodProd, zdtSecFun, zdtRubro  from TLogCtz
                    inner join TLogReq on reqID = ctzCodReq
                    inner join TLogCtzD on ctzID = zdtCodCtz
                    where (zdtSecFun IS NULL or zdtRubro IS NULL or zdtSecFun = '' or zdtRubro = '');"));

                $icz = 0;
                foreach($ctzs as $item){

                    if(substr($item->reqSecFun,-1) == 'M') continue;

                    DB::table('TLogCtzD')
                        ->where('zdtCodCtz', $item->ctzID)
                        ->where('zdtCodProd', $item->zdtCodProd)
                        ->update(['zdtSecFun' => $item->reqSecFun, 'zdtRubro' => $item->reqRubro]);

                    $icz++;
                }

                echo "Se actualizaron " . $icz . " Cotizaciones <br>";

                $cdrs = DB::select(DB::raw("select cdrID, reqID, reqSecFun, reqRubro, ctlCodProd, ctlSecFun, ctlRubro from TLogCC
inner join TLogCtz on ctzID = cdrCodCtz
inner join TLogReq on reqID = ctzCodReq
inner join TLogCCD on ctlCodCC = cdrID
where ctlSecFun is null or ctlRubro is null or ctlSecFun = '' or ctlRubro = '';"));

                $icd = 0;
                foreach ($cdrs as $item) {

                    if(substr($item->reqSecFun,-1) == 'M') continue;

                    DB::table('TLogCCD')
                        ->where('ctlCodCC', $item->cdrID)
                        ->where('ctlCodProd', $item->ctlCodProd)
                        ->update(['ctlSecFun' => $item->reqSecFun, 'ctlRubro' => $item->reqRubro]);
                    $icd++;
                }

                echo "Se actualizaron " . $icd . " Cuadros comparativos <br>";

                $ftes = DB::select(DB::raw("select fteID, reqID, reqSecFun, reqRubro, fdtCodProd, fdtSecFun, fdtRubro from TLogFte
inner join TLogFteD on fteID = fdtCodFte 
inner join TLogCC on cdrID = fteOrg
inner join TLogCtz on ctzID = cdrCodCtz
inner join TLogReq on reqID = ctzCodReq
where fdtSecFun is null or fdtRubro is null or fdtSecFun = '' or fdtRubro = '';"));

                $ift = 0;
                foreach ($ftes as $item) {

                    if(substr($item->reqSecFun,-1) == 'M') continue;

                    DB::table('TLogFteD')
                        ->where('fdtCodFte', $item->fteID)
                        ->where('fdtCodProd', $item->fdtCodProd)
                        ->update(['fdtSecFun' => $item->reqSecFun, 'fdtRubro' => $item->reqRubro]);
                    $ift++;
                }

                echo "Se actualizaron " . $ift . " Fuentes u ofertas <br>";

                $orcs = DB::select(DB::raw("SELECT orcID, orcReq, reqID, reqSecFun, reqRubro, cdtCodProd, cdtSecFun, cdtRubro from TLogOC
            inner join TLogOCD on orcID = cdtCodOC
            inner join TLogReq on reqId = orcReq
            WHERE cdtSecFun is null or cdtRubro is NULL or cdtSecFun = '' or cdtRubro = '';"));

                $ioc = 0;
                foreach ($orcs as $item) {

                    if(substr($item->reqSecFun,-1) == 'M') continue;

                    DB::table('TLogOCD')
                        ->where('cdtCodOC', $item->orcID)
                        ->where('cdtCodProd', $item->cdtCodProd)
                        ->update(['cdtSecFun' => $item->reqSecFun, 'cdtRubro' => $item->reqRubro]);
                    $ioc++;
                }

                echo "Se actualizaron " . $ioc . " Compras <br>";

                $orss = DB::select(DB::raw("select orsID, orsReq, reqID, reqSecFun, reqRubro, sdtCodProd, sdtSecFun, sdtRubro from TLogOS
            inner join TLogOSD on orsID = sdtCodOS
            inner join TLogReq on reqID = orsReq
            where sdtSecFun is null or sdtRubro is null or sdtSecFun = '' or sdtRubro = '';"));

                $ios = 0;
                foreach ($orss as $item) {

                    if(substr($item->reqSecFun,-1) == 'M') continue;

                    DB::table('TLogOSD')
                        ->where('sdtCodOS', $item->orsID)
                        ->where('sdtCodProd', $item->sdtCodProd)
                        ->update(['sdtSecFun' => $item->reqSecFun, 'sdtRubro' => $item->reqRubro]);
                    $ios++;
                }

                echo "Se actualizaron " . $ios . " Servicios <br>";

                $invs = DB::connection('dbalmacen')->select(DB::raw("select b.oc_cod, b.oc_rubro, b.oc_secFuncional, a.cod_giu, a.prod_cod, a.id, a.prod_oc, a.prod_secfun,
                a.prod_rubro   from Inventario a
                inner join Internamiento b on b.ing_giu = a.cod_giu
                where prod_secfun is null and prod_rubro is null
                or prod_secfun = '' or prod_rubro = '';"));

                $iinv = 0;
                foreach ($invs as $item){

                    if(substr($item->oc_secFuncional,-1) == 'M') continue;

                    DB::connection('dbalmacen')->table('Inventario')
                        ->where('id', $item->id)
                        ->update(['prod_secfun' => $item->oc_secFuncional, 'prod_rubro' => $item->oc_rubro]);
                    $iinv++;
                }

                echo "Se actualizaron" . $iinv . " Inventarios <br>";
            });

        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function conciliar_cuentas()
    {
        try{

            DB::transaction(function(){

                $ctas = DB::connection('dbalmacen')->select(DB::raw("select a.id, a.prod_oc, a.cod_giu, a.prod_clasif, b.claClasif, 
                        DB_Logistica.dbo.fnLogGetCtaCla('2019',b.claClasif) as ctaCont, a.prod_cta
                        from Inventario a
                        inner join DB_Logistica..TPreClasf b on a.prod_clasif = b.claID
                        where a.prod_cta is null or a.prod_cta = '';"));

                $ict = 0;
                foreach ($ctas as $key => $item) {

                    DB::connection('dbalmacen')->table('Inventario')
                        ->where('id', $item->id)
                        ->update(['prod_cta' => $item->ctaCont]);

                    $ict++;
                }

                echo "Se actualizaron " . $ict . " cuentas en inventario <br>";
            });

        }catch (Exception $e){
            return $e->getMessage();
        }
    }
}
