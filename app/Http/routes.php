<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/','HomeController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('logistica/vwCat','Logistica\ctrlReq@fnGetViewCat');

/*
 * INTERNAMIENTO
 * */

Route::get('internamiento/period/{period}', 'Almacen\internamientoController@index');
Route::get('internamiento/page', 'Almacen\internamientoController@indexPage');
Route::get('internamiento/oc', 'Almacen\internamientoController@getRegisterOc');
Route::post('internamiento/oc', 'Almacen\internamientoController@postRegisterOc');
Route::get('internamiento/nea', 'Almacen\internamientoController@getRegisterNea');
Route::post('internamiento/nea', 'Almacen\internamientoController@postRegisterNea');
Route::get('internamiento/panel', 'Almacen\internamientoController@getShowAllRegister');
Route::get('internamiento/close', 'Almacen\internamientoController@getCloseInternamiento');
Route::get('internamiento/bienes/{gi}', 'Almacen\internamientoController@getInternamientoBienes');
Route::post('internamiento/bienes/{gi}', 'Almacen\internamientoController@postInternamientoBienes');
Route::get('findCpi','Almacen\internamientoController@getProcesosInternamiento');
Route::get('findGi/{gi}','Almacen\internamientoController@getFindGuia');
Route::get('findOr/{oc}','Almacen\internamientoController@getFindOrden');
Route::get('findNea/{nea}','Almacen\internamientoController@getFindNota');
Route::post('task/{operation}','Almacen\internamientoController@postMakeTask');

Route::get('internamiento/view/{gi}/{pi}','Almacen\internamientoController@getViewInternamiento');

/*
 * DISTRIBUCION O SALIDA
 * */

Route::get('distribucion/period/{period}','Almacen\distribucionController@index');
Route::get('distribucion/page','Almacen\distribucionController@indexPage');
Route::get('distribucion/bienes/{gi}', 'Almacen\distribucionController@getDistribucionBienes');
Route::post('distribucion/bienes/{gi}', 'Almacen\distribucionController@postDistribucionBienes');
Route::get('distribucion/edit/{ps}','Almacen\distribucionController@getDistribucionEdit');
Route::get('findPs/{ps}','Almacen\distribucionController@getFindPecosa');
Route::get('findPsoc/{oc}','Almacen\distribucionController@getFindPecosaOrden');
Route::get('findPsnea/{nea}','Almacen\distribucionController@getFindPecosaNea');

Route::post('remove/pcs','Almacen\distribucionController@postRemovePecosa');
Route::post('remove/gi','Almacen\internamientoController@postRemoveGuiaInternamiento');
/*
 * REPORTES DE ALMACEN
 * */

Route::get('reportemenu','Almacen\reporteController@index');
Route::post('reporte/{type}','Almacen\reporteController@postMakePreview');
Route::get('getDataFilter','Almacen\reporteController@getDataFilter');
Route::get('getDataDetail','Almacen\reporteController@getDataDetail');

/*
 * SEGUIMIENTO DE DOCUMENTOS
 * */

Route::get('seguimiento','Almacen\seguimientoController@index');
Route::get('seguimientoGi','Almacen\seguimientoController@getDataSeguimientoGi');
Route::get('seguimientoPs','Almacen\seguimientoController@getDataSeguimientoPs');

/*
 * MODIFICACION, ACTUALIZACIÓN DE CAMPOS INTERNAMIENTO - DISTRIBUCION
 * */

Route::post('update/ps','Almacen\distribucionController@postUpdatePecosa');
Route::post('update/gi','Almacen\internamientoController@postUpdateInternamiento');

/*
 * OPERACIONES BASICAS
 * */

Route::get('findOc','Almacen\logisticaController@autoFindOc');
Route::get('findProd','Almacen\logisticaController@autoFindProd');
Route::get('findUnidad','Almacen\logisticaController@autoFindUnidad');
Route::get('findPersona','Almacen\logisticaController@autoFindPersona');
Route::get('findDependency','Almacen\logisticaController@autoFindDependency');
Route::get('findSecuencia','Almacen\logisticaController@autoFindSecuencia');
Route::get('findSecFun','Almacen\logisticaController@autoFindSecFun');


/*
 * LOGISTICA OPERACIONES
 * */
Route::get('dataOc','Almacen\logisticaController@getDataOc');
Route::get('productsOc','Almacen\logisticaController@getProductsOc');
Route::get('verifyOcExist','Almacen\logisticaController@getVerifyExistOc');

/*
 * GENERACION DE PDF
 * */
Route::get('pdfGi/{gi}/{pi}','Almacen\pdfController@getPdfGuiaSheet');
Route::get('pdfActa/{gi}/{pi}','Almacen\pdfController@getPdfActaPreview');
Route::get('pdfPs/{ps}','Almacen\pdfController@getPdfPecosaSheet');
Route::get('pdfNota/{nea}','Almacen\pdfController@getPdfNeaSheet');
Route::get('header',function(){
    return view('partials.header-pdf');
});
Route::get('footer',function(){
    return view('partials.footer-pdf');
});

/*
 * TRAMITE DOCUMENTARIO DE SLAM
 * */

Route::get('tramite','Tramite\tramiteController@index');
Route::get('filtro','Tramite\tramiteController@filtro');
Route::get('tramite/{bandeja}','Tramite\tramiteController@getBandejaTramite');
Route::post('tramite/{operation}','Tramite\tramiteController@postOperationTramite');
Route::get('consulta/procesos','Tramite\tramiteController@getConsultaProveedor');
Route::post('consulta/procesos','Tramite\tramiteController@postConsultaProveedor');
Route::post('update/statetram','Tramite\tramiteController@postUpdateStatetram');

/*
 * TEST -PRUEBAS
 * */

Route::post('sync/fullsyncclasif','Tramite\tramiteController@fullsyncclasif');
Route::post('sync/listsyncclasif','Tramite\tramiteController@listsyncclasif');
Route::post('sync/listclasif','Tramite\tramiteController@listclasif');
Route::get('sync/querysecfun','Tramite\tramiteController@listsf');
Route::post('sync/executesf','Tramite\tramiteController@updatesf');
Route::get('sync','Tramite\tramiteController@indexSync');
Route::get('testsiaf','Tramite\tramiteController@testSiaf');
Route::get('fillDataOcSiaf','Tramite\tramiteController@fillDataSiaf');
Route::get('cleanDataOcSiaf','Tramite\tramiteController@cleanDataSiaf');

Route::get('/reporting',['uses'=>'Almacen\ReporteController@index','as'=>'Report']);
Route::post('/reporting',['uses'=>'Almacen\ReporteController@create']);



/*
 * LOGISTICA
 * */

/*
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
*/
Route::get('getFindReq','Logistica\ctrlGrl@autoFindReq');

Route::get('getFindClasf','Logistica\ctrlGrl@autoFindClasf');
Route::get('getFindProd','Logistica\ctrlGrl@autoFindProd');
Route::get('getFindUnd','Logistica\ctrlGrl@autoFindUnd');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::get('logistica/rpt','Logistica\ctrlGrl@spRpt');
Route::get('logistica/rptExcel/{Anio}/{Doc}/{TipoRpt}/{Nivel}/{FecIni}/{FecFin}/{SecFun}/{Rubro}/{TipoProc}/{Ruc}',    'Logistica\ctrlGrl@spRptExcel');
Route::get('logistica/rptSeaceExcel/{Doc}/{TipoRpt}/{FecIni}/{FecFin}',    'Logistica\ctrlGrl@spRptSeaceExcel');
Route::get('logistica/rptPriceExcel/{TipoRpt}/{FecIni}/{FecFin}',    'Logistica\ctrlGrl@spRptPriceExcel');
Route::get('logistica/rptSegExcel/{anio}/{tipo}/{valor}',    'Logistica\ctrlGrl@spLogGetSegExcel');

Route::get('logistica/rptRankingExcel/{Doc}/{FecIni}/{FecFin}',    'Logistica\ctrlGrl@spRptRankingExcel');
Route::get('logistica/rptRankingPdf/{Doc}/{FecIni}/{FecFin}',    'Logistica\ctrlGrl@spRptRankingPdf');

Route::get('logistica/rptSegDllExcel/{id}',    'Logistica\ctrlGrl@spLogGetSegDllExcel');



Route::POST('logistica/spLogRptView',     'Logistica\ctrlGrl@spRptView');
Route::get('logistica/vwCat',            'Logistica\ctrlGrl@fnGetViewCat');
Route::get('logistica/vwUsr',            'Logistica\ctrlGrl@fnGetViewUsr');
Route::get('logistica/vwPers',           'Logistica\ctrlGrl@fnGetViewPers');
Route::get('logistica/vwAnio',           'Logistica\ctrlGrl@fnGetViewAnio');
Route::get('logistica/vwCal',            'Logistica\ctrlGrl@fnGetViewCal');
Route::get('logistica/vwReqSg',           'Logistica\ctrlGrl@fnGetViewReqSg');
Route::post('logistica/spLogGetReqSg',    'Logistica\ctrlGrl@spLogGetReqSg');
Route::post('logistica/spLogGetReqSgDll', 'Logistica\ctrlGrl@spLogGetReqSgDll');

Route::get('logistica/vwPrice',           'Logistica\ctrlGrl@fnGetViewPrice');
Route::post('logistica/spLogGetPrice',    'Logistica\ctrlGrl@spLogGetPrice');

Route::get('logistica/vwPass',           'Logistica\ctrlGrl@fnGetViewPass');
Route::Post('logistica/vwPassVal',       'Logistica\ctrlGrl@fnGetViewPassVal');
Route::Post('logistica/spLogSetUsrPss',  'Logistica\ctrlGrl@spLogSetUsrPss');
Route::Post('logistica/spLogSetUsrPss',  'Logistica\ctrlGrl@spLogSetUsrPss');
Route::Post('logistica/spLogGetBusy',    'Logistica\ctrlGrl@spLogGetBusy');
Route::Post('logistica/spLogGetCodNext', 'Logistica\ctrlGrl@spLogGetCodNext');
Route::get('logistica/vwLogRpt',        'Logistica\ctrlGrl@fnGetViewRpt');
Route::get('logistica/vwLogRptSeace',   'Logistica\ctrlGrl@fnGetViewRptSeace');
Route::get('logistica/vwLogRptRanking',   'Logistica\ctrlGrl@fnGetViewRptRanking');



Route::get('logistica/vwDep',            'Logistica\ctrlGrl@fnGetViewDep');
Route::get('logistica/vwDepNew',           'Logistica\ctrlGrl@fnGetViewDepNew');
Route::Post('logistica/spLogGetDep', 'Logistica\ctrlGrl@spLogGetDep');
Route::Post('logistica/spLogSetDep', 'Logistica\ctrlGrl@spLogSetDep');

Route::get('logistica/vwSecFun',            'Logistica\ctrlGrl@fnGetViewSecFun');
Route::get('logistica/vwSecFunNew',           'Logistica\ctrlGrl@fnGetViewSecFunNew');
Route::Post('logistica/spLogGetSecFun', 'Logistica\ctrlGrl@spLogGetSecFun');
Route::Post('logistica/spLogSetSecFun', 'Logistica\ctrlGrl@spLogSetSecFun');



/*********************************/
Route::post('logistica/spLogGetDatos', 'Logistica\ctrlGrl@spLogGetDatos');
Route::post('logistica/spLogGetCatalogo', 'Logistica\ctrlGrl@spLogGetCatalogo');
Route::post('logistica/spLogSetCatalogo', 'Logistica\ctrlGrl@spLogSetCatalogo');
Route::post('logistica/spLogSetRuc', 'Logistica\ctrlGrl@spLogSetRuc');
Route::post('logistica/spLogGetRuc', 'Logistica\ctrlGrl@spLogGetRuc');
Route::post('logistica/spLogGetRucsunat', 'Logistica\ctrlGrl@spLogGetRucsunat');

Route::post('logistica/spLogSetPers', 'Logistica\ctrlGrl@spLogSetPers');
Route::post('logistica/spLogGetPers', 'Logistica\ctrlGrl@spLogGetPers');

Route::post('logistica/spLogGetUsr', 'Logistica\ctrlGrl@spLogGetUsr');
Route::post('logistica/spLogSetUsr', 'Logistica\ctrlGrl@spLogSetUsr');



/* *  REQUERIMIENTOS ************* */
Route::get('logistica/vwReq', 'Logistica\ctrlReq@fnGetViewReq');
Route::post('logistica/spLogGetReq', 'Logistica\ctrlReq@spLogGetReq');

Route::post('logistica/spLogGetReqTmpII', 'Logistica\ctrlReq@spLogGetReqTmpII');

Route::post('logistica/spLogGetReqD', 'Logistica\ctrlReq@spLogGetReqD');
Route::post('logistica/spLogGetReqBusy', 'Logistica\ctrlReq@spLogGetReqBusy');
Route::get('logistica/rptReq/{id}/{anio}', 'Logistica\ctrlReq@spLogGetReqPrint');
Route::post('logistica/spLogSetReq', 'Logistica\ctrlReq@spLogSetReq');
Route::post('logistica/spLogSetReqD', 'Logistica\ctrlReq@spLogSetReqD');
Route::post('logistica/spLogSetReqBusy', 'Logistica\ctrlReq@spLogSetReqBusy');
Route::post('logistica/spLogGetReqLR',   'Logistica\ctrlReq@spLogGetReqLR');

/* *  COTIZACION ************* */
Route::get('logistica/vwCtz',           'Logistica\ctrlCtz@fnGetViewCtz');
Route::post('logistica/spLogSetCtz',    'Logistica\ctrlCtz@spLogSetCtz');
Route::post('logistica/spLogSetCtzD',   'Logistica\ctrlCtz@spLogSetCtzD');
Route::Post('logistica/spLogSetCtzBusy',     'Logistica\ctrlCtz@spLogSetCtzBusy');
Route::post('logistica/spLogGetCtzReq', 'Logistica\ctrlCtz@spLogGetCtzReq');
Route::post('logistica/spLogGetCtz',    'Logistica\ctrlCtz@spLogGetCtz');
Route::post('logistica/spLogGetCtzD',   'Logistica\ctrlCtz@spLogGetCtzD');
Route::get('logistica/rptCtz/{id}/{anio}',     'Logistica\ctrlCtz@spLogGetCtzPrint');
Route::post('logistica/spLogGetCtzLR',   'Logistica\ctrlCtz@spLogGetCtzLR');
Route::post('logistica/spLogGetCtzSearch',   'Logistica\ctrlCtz@spLogGetCtzSearch');


/* *  CUADRO COMPARATIVO  ************* */
Route::get('logistica/vwCC',           'Logistica\ctrlCC@fnGetViewCC');
Route::get('logistica/vwCCRucAdd',     'Logistica\ctrlCC@fnGetViewCCRucAdd');
Route::get('logistica/spLogGetFte',    'Logistica\ctrlCC@spLogGetFte');
Route::get('logistica/spLogGetFteD',    'Logistica\ctrlCC@spLogGetFteD');
Route::Post('logistica/spLogSetFte',     'Logistica\ctrlCC@spLogSetFte');
Route::Post('logistica/spLogSetFteD',     'Logistica\ctrlCC@spLogSetFteD');
Route::Post('logistica/spLogSetCC',     'Logistica\ctrlCC@spLogSetCC');
Route::Post('logistica/spLogSetCCD',     'Logistica\ctrlCC@spLogSetCCD');
Route::Post('logistica/spLogSetCCCz',     'Logistica\ctrlCC@spLogSetCCCz');
Route::Post('logistica/spLogGetCC',     'Logistica\ctrlCC@spLogGetCC');
Route::Post('logistica/spLogSetCCBusy',     'Logistica\ctrlCC@spLogSetCCBusy');
Route::get('logistica/rptCC/{anio}/{id}',     'Logistica\ctrlCC@spLogGetCCPrint');
Route::post('logistica/spLogGetCCLR',   'Logistica\ctrlCC@spLogGetCCLR');
Route::post('logistica/spLogGetCCSearch',   'Logistica\ctrlCC@spLogGetCCSearch');

Route::Post('logistica/spLogGetCC_Ctz',     'Logistica\ctrlCC@spLogGetCC_Ctz');
Route::Post('logistica/spLogGetCC_Req',     'Logistica\ctrlCC@spLogGetCC_Req');

/* *  ORDEN DE COMPRA ************* */
Route::get('logistica/vwOC',           'Logistica\ctrlOC@fnGetViewOC');
Route::post('logistica/spLogGetOC',    'Logistica\ctrlOC@spLogGetOC');
Route::post('logistica/spLogGetOCTmp',    'Logistica\ctrlOC@spLogGetOCTmp');
Route::post('logistica/spLogGetOCD',   'Logistica\ctrlOC@spLogGetOCD');
Route::post('logistica/spLogGetOCBusy','Logistica\ctrlOC@spLogGetOCBusy');
Route::get('logistica/rptOC/{anio}/{id}',     'Logistica\ctrlOC@spLogGetOCPrint');

//Route::get('logistica/rptOC/{id}',     'Logistica\ctrlOC@spPrueba');

Route::post('logistica/spLogSetOC',    'Logistica\ctrlOC@spLogSetOC');
Route::post('logistica/spLogSetOCD',   'Logistica\ctrlOC@spLogSetOCD');
Route::Post('logistica/spLogSetOCBusy','Logistica\ctrlOC@spLogSetOCBusy');
Route::Post('logistica/spLogSetOcDClear',  'Logistica\ctrlOC@spLogSetOcDClear');
//Route::post('logistica/spLogSetOCBusy','Logistica\ctrlOC@spLogSetOCBusy');
Route::post('logistica/spLogGetOCReq', 'Logistica\ctrlOC@spLogGetReq');
Route::post('logistica/spLogGetOCLR',  'Logistica\ctrlOC@spLogGetOCLR');
Route::post('logistica/spLogGetOCSearch', 'Logistica\ctrlOC@spLogGetOCSearch');
Route::get('logistica/vwCatalogoOC',      'Logistica\ctrlOC@fnGetViewCatalogoOC');
Route::post('logistica/vwGetTable',      'Logistica\ctrlOC@fnGetViewTableNull');
Route::Post('logistica/spLogSetOCIgv','Logistica\ctrlOC@spLogSetOCIgv');
Route::Post('logistica/spLogSetOCDDel','Logistica\ctrlOC@spLogSetOCDDel');
Route::post('logistica/spLogGetOC_CCVal', 'Logistica\ctrlOC@spLogGetOC_CCVal');

/* *  ORDEN DE SERVICIO ************* */
Route::get('logistica/vwOS',           'Logistica\ctrlOS@fnGetViewOS');
Route::post('logistica/spLogGetOS',    'Logistica\ctrlOS@spLogGetOS');
Route::post('logistica/spLogGetOSD',   'Logistica\ctrlOS@spLogGetOSD');
Route::post('logistica/spLogGetOSBusy','Logistica\ctrlOS@spLogGetOSBusy');
Route::get('logistica/rptOS/{anio}/{id}',     'Logistica\ctrlOS@spLogGetOSPrint');
Route::post('logistica/spLogSetOS',    'Logistica\ctrlOS@spLogSetOS');
Route::post('logistica/spLogSetOSD',   'Logistica\ctrlOS@spLogSetOSD');
Route::post('logistica/spLogSetOSBusy','Logistica\ctrlOS@spLogSetOSBusy');
Route::post('logistica/spLogGetOSReq', 'Logistica\ctrlOS@spLogGetReq');
Route::post('logistica/spLogGetOSLR',   'Logistica\ctrlOS@spLogGetOSLR');
Route::post('logistica/spLogGetOSSearch',   'Logistica\ctrlOS@spLogGetOSSearch');
Route::post('logistica/vwGetTableOSDll',  'Logistica\ctrlOS@fnGetViewTableOSNull');
Route::Post('logistica/spLogSetOSDDel','Logistica\ctrlOS@spLogSetOSDDel');
Route::post('logistica/spLogGetOS_CCVal', 'Logistica\ctrlOS@spLogGetOS_CCVal');




Route::post('logistica/spLogSetPrePto',    'Logistica\ctrlReq@spLogSetPrePto');
Route::get('logistica/rptPrueba/{prAnio}/{prTipoRpt}/{prFecIni}/{prFecFin}/{prSecFun}/{prTipoProc}/{prRubro}/{prRuc}/{prNivel}',    'Logistica\ctrlGrl@spLogGetRpt');


Route::get('logistica/vwLiqCS',    'Logistica\ctrlGrl@fnGetViewLiqCS');
Route::post('logistica/spLiqGetCS',    'Logistica\ctrlGrl@spLiqGetCS');	
Route::get('logistica/rptLiqCSExcel/{prAnio}/{prCodSecFun}/{prTipo}/{prOrdn}',    'Logistica\ctrlGrl@spLiqGetCSExcel');


Route::post('logistica/spLogGetOC_Expediente',    'Logistica\ctrlOC@spLogGetOC_Expediente');
Route::post('logistica/spLogSetOC_Expediente',    'Logistica\ctrlOC@spLogSetOC_Expediente');
Route::post('logistica/spLogGetOC_ExpedienteRow', 'Logistica\ctrlOC@spLogGetOC_ExpedienteRow');


Route::post('logistica/spLiqGetSecFun',    'Logistica\ctrlGrl@spLiqGetSecFun');



Route::get('logistica/vwAdqSegDoc',    'Logistica\ctrlGrl@fnGetViewAdqSegDoc');
Route::post('consulta','Logistica\ctrlGrl@spGetSeg');



Route::get('logistica/vwActDoc',            'Logistica\ctrlGrl@fnGetViewActDoc');
Route::Post('logistica/spLogGetActDll',     'Logistica\ctrlGrl@spLogGetActDocDll');
Route::Post('logistica/spLogSetActDll',     'Logistica\ctrlGrl@spLogSetActDocDll');


Route::get('logistica/vwActUser',            'Logistica\ctrlGrl@fnGetViewActUser');
Route::Post('logistica/spLogGetActUserDll',     'Logistica\ctrlGrl@spLogGetActUserDll');
Route::Post('logistica/spLogSetActUserDll',     'Logistica\ctrlGrl@spLogSetActUserDll');

Route::Post('logistica/spLogGetUsrPerz',     'Logistica\ctrlGrl@spLogGetUsrPerz');
Route::Post('logistica/spLogSetUsrPerz',     'Logistica\ctrlGrl@spLogSetUsrPerz');
Route::Post('logistica/spLogGetUsrAcs',     'Logistica\ctrlGrl@spLogGetUsrAcs');

Route::Post('logistica/spLogSetTrsh','Logistica\ctrlGrl@spLogSetTrsh');
Route::Post('logistica/spSiafAsyn','Logistica\ctrlGrl@spSiafAsyn');

Route::get('logistica/vwAdqPriceRef',            'Logistica\ctrlGrl@fnGetViewPriceRef');
Route::Post('logistica/spLogGetPriceItem',     'Logistica\ctrlGrl@spLogGetPriceItem');
Route::Post('logistica/spLogGetPriceAll',     'Logistica\ctrlGrl@spLogGetPriceAll');
Route::get('logistica/rptPriceRefExcel/{prAnio}/{prCodigo}',    'Logistica\ctrlGrl@spLogGetPriceRefExcel');

/* *************** NOTIFY OCS ROUTE ***************** */

Route::get('logistica/vwNotify', 'Logistica\ctrlGrl@fnGetViewNotify');
Route::get('displayOc','Almacen\logisticaController@displayOc');