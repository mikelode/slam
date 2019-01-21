/**
 * Created by SERVER on 03/12/2015.
 */
 
 $( document ).on( 'click', '.menu-RptTipoRpt li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txRpt_CodTipoRpt").attr("codID",TipoReq);
    return false;
});

$( document ).on( 'click', '.menu-RptNivel li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txRpt_CodNivel").attr("codID",TipoReq);
    return false;
});

$( document ).on( 'click', '.menu-RptEtapa li', function( event ) {
    var $target = $( event.currentTarget );
    $target.closest( '.btn-group' ).find( '[data-bind="label"]' ).text( $target.text() ).end().children( '.dropdown-toggle' ).dropdown( 'toggle' );
    var TipoReq= $target.attr("psrId") ;
    $("#txRpt_CodEtapa").attr("codID",TipoReq);
    return false;
});


    




$(document).ready(function(){

    $('#btnMainClose').click(function(e){
        e.preventDefault();
        window.location.href="auth/logout";
    });

    $('#btnMainLogReqSg').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwReqSg';
        $.get(url,function(data){
             
            $("#loadModalsMain").html(data);
            $('#modalReqSg').modal('show');

           // $('#txPER_DNI').attr("maxlength", 8);

        });
    });

    $('#btnMainLogPrice').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwPrice';
        // alert('MEFF');
       $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalRptPrice').modal('show');
            
            // $('#txPER_DNI').attr("maxlength", 8);


      });
    });


    $('#btnMainLogCat').click(function(e){
        e.preventDefault();

        var url = 'logistica/vwCat';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
            $("#btnLogCat_Cancel").addClass("fila-Hide");
            $("#btnLogCat_Save").addClass("fila-Hide");
            $("#btnLogCat_New").removeClass("fila-Hide");
        });

    });

    $('#btnMainLogUsr').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwUsr';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalUsr').modal('show');
            $('#txUSR_DNI').attr("maxlength", 8);

        });
    });

    $('#btnMainLogPers').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwPers';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalPers').modal('show');
            $('#txPER_DNI').attr("maxlength", 8);

        });
    });

    $('#btnMainLogAnio').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwAnio';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalAnio').modal('show');
            $('#txLogAnio').attr("maxlength", 4);
            $('#txLogAnio').val("2019");
           // $('#txPER_DNI').attr("maxlength", 8);

        });
    });
    $('#btnMainLogCal').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwCal';
        $.get(url,function(data){
            //$("#loadModalsMain").html(data);
            //$('#modalAnio').modal('show');
            // $('#txPER_DNI').attr("maxlength", 8);

        });
    });
   /* $('#btnUSR_').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwUsr';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalUsr').modal('show');
            $('#txAnio').attr("maxlength", 4);

        });
    });
*/
    $('#btnMainLogPass').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwPass';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalPass').modal('show');
           // $('#txPER_DNI').attr("maxlength", 8);

        });
    });

    $('#btnMainLogReq').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwReq';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
            $('#txNroReq').attr("maxlength", 5);
            $('#txAnio').attr("maxlength", 4);
            $('#txAnio').prop('readOnly', true);
            $('#txAnio').val($('.txVarAnioEjec').val());
            $('#txDep').prop('readOnly', true);
            $('#txTipoReq').prop('readOnly', true);
            $('#txSecFun').prop('readOnly', true);
            $('#txSubSec').prop('readOnly', true);
            $('#txRubro').prop('readOnly', true);
            $('#txSolicitante').prop('readOnly', true);
            jsFunReqClear(true);
            jsFunReqButtons(false);
            jsFunReqEnable(true);

            $.ajax({
                type: "POST",
                url: "logistica/spLogGetCodNext",
                data: { Anio:$(".txVarAnioEjec").val(), Tipo:"RQ",'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#txReqNo").val( VR[0].Codigo ); }
            });

            //var year = $('#periodSys').val();
        });
    });

    $('#btnMainLogCtz').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwCtz';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
            $('#txNroReq').attr("maxlength", 5);
            $('#txAnio').attr("maxlength", 4);
            $('#txAnio').prop('readOnly', true);
            $('#txAnio').val($('.txVarAnioEjec').val());
            $('#txDep').prop('readOnly', true);
            $('#txTipoReq').prop('readOnly', true);
            $('#txSecFun').prop('readOnly', true);
            $('#txSolicitante').prop('readOnly', true);
            jsFunCtzClear(true);
            jsFunCtzButtons(false);
            jsFunCtzEnable(true);

            $.ajax({
                type: "POST",
                url: "logistica/spLogGetCodNext",
                data: { Anio:$("#txAnio").val(), Tipo:"CZ",'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#txCtzNo").val( VR[0].Codigo ); }
            });

            //var year = $('#periodSys').val();
        });
    });

    $('#btnMainLogCC').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwCC';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
            $('#txCCNo').attr("maxlength", 5);
            $('#txAnio').attr("maxlength", 4);
            $('#txAnio').prop('readOnly', true);
            $('#txAnio').val($('.txVarAnioEjec').val());
            $('#txDep').prop('readOnly', true);
            $('#txTipoReq').prop('readOnly', true);
            $('#txSecFun').prop('readOnly', true);
            $('#txSolicitante').prop('readOnly', true);
            jsFunCdrClear(true);
            jsFunCdrButtons(false);
            jsFunCdrEnable(true);

            $.ajax({
                type: "POST",
                url: "logistica/spLogGetCodNext",
                data: { Anio:$(".txVarAnioEjec").val(), Tipo:"CC",'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#txCCNo").val( VR[0].Codigo ); }
            });
        });
    });

    $('#btnMainLogOC').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwOC';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
            $('#txOC_No').attr("maxlength", 5);
            $('#txAnio').val($('.txVarAnioEjec').val());
            $('#txAnio').attr("maxlength", 4);
            $('#txAnio').prop('readOnly', true);
            jsFunOC_Default();
            jsFunOC_EnableBtns(false);
            jsFunOC_EnableText(true);

            $.ajax({
                type: "POST",
                url: "logistica/spLogGetCodNext",
                data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OC",'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#txOC_No").val( VR[0].Codigo ); }
            });
        });
    });

    $('#btnMainLogOS').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwOS';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
            $('#txAnio').val($('.txVarAnioEjec').val());
            $('#txOS_No').attr("maxlength", 5);
            $('#txAnio').attr("maxlength", 4);
            $('#txAnio').prop('readOnly', true);
            jsFunOS_Default();
            jsFunOS_EnableBtns(false);
            jsFunOS_EnableText(true);
            $.ajax({
                type: "POST",
                url: "logistica/spLogGetCodNext",
                data: { Anio:$(".txVarAnioEjec").val(), Tipo:"OS",'_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#txOS_No").val( VR[0].Codigo ); }
            });
        });
    });
	
	 $('#btnMainLogRpt').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwLogRpt';
        $.get(url,function(data){
			
            $('.alm-content-wrapper').html(data);          
			$('#txAnio').prop('readOnly', true);
			$('#txRpt_SecFun').prop('readOnly', true);
			$('#txRpt_Rubro').prop('readOnly', true);			
			$('#txRpt_TipoProc').prop('readOnly', true);
			$('#txRpt_RSocial').prop('readOnly', true);
			 $('#txRpt_FechaIni').val(moment().format('YYYY-MM-DD'));
			 $('#txRpt_FechaFin').val(moment().format('YYYY-MM-DD'));
			
        });
    });
	
	    

	    $('#btnMainLogRptSeace').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwLogRptSeace';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalRptSeace').modal('show');
            $('#txRpt_SeaceFechaIni').val(moment().format('YYYY-MM-DD'));
			$('#txRpt_SeaceFechaFin').val(moment().format('YYYY-MM-DD'));

        });
    });


    $('#btnMainLogRptRanking').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwLogRptRanking';
        $.get(url,function(data){
            $("#loadModalsMain").html(data);
            $('#modalRptRanking').modal('show');
            $('#txRpt_RankingFechaIni').val(moment().format('YYYY-MM-DD'));
            $('#txRpt_RankingFechaFin').val(moment().format('YYYY-MM-DD'));

        });
    });



	
   /* $('#btnMainLogCat').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwCat';
        $.get(url,function(data){
            //$('.alm-content-wrapper').html(data);

            $("#loadModalsMain").html(data);
            $('#modalCatalogo').modal('show');

            $("#btnLogCat_Cancel").addClass("fila-Hide");
            $("#btnLogCat_Save").addClass("fila-Hide");
            $("#btnLogCat_New").removeClass("fila-Hide");
        });
    });

*/
    $('#btnMainLogRUC').click(function(e){
        e.preventDefault();
        $("#loadModalsMain").html(jsFunModalRuc('REGISTRO DE PROVEEDORES'));
        $('#modalRUC').modal('show');
        $('#txRUC_Ruc').attr("maxlength", 11);
    });


$('#btnMainLogDep').click(function(e){
        e.preventDefault();

        var url = 'logistica/vwDep';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);           
            $("#btnLogCat_New").removeClass("fila-Hide");
             $.ajax({
                type: "POST",
                url: "logistica/spLogGetDep",
                data: { prAnio:$(".txVarAnioEjec").val(), prQry:'','_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#divDepDll").html( VR); }
            });

        });

    });

     $('#btnMainLogSecFun').click(function(e){
        e.preventDefault();

        var url = 'logistica/vwSecFun';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
             $.ajax({
                type: "POST",
                url: "logistica/spLogGetSecFun",
                data: { prAnio:$(".txVarAnioEjec").val(), prQry:'','_token': $('#tokenBtnMain').val() },
                error: function () {   jsFnDialogBox(400, 145, "WARNING", null, "ERROR EN LA PETICION", "Se produjo un ERROR en la peticion durante la Peticion. <br><strong>CONTACTESE CON EL ADMINISTRADOR</strong>"); return "-";},
                success: function (VR) { $("#divSecFunDll").html( VR); }
            });

        });

    });


 $('#btnMainLogActDoc').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwActDoc';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
        });
    });

$('#btnMainLogActUser').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwActUser';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
        });
    });

    $('#btnMainLogNot').click(function(e){
        e.preventDefault();
        var url = 'logistica/vwNotify';
        $.get(url, function(response){
            $('.alm-content-wrapper').html(response);
        });
    });



});
