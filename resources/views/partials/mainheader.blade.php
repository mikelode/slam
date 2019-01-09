<div id="ribbon">
    <span class="ribbon-window-title"></span>
    <div class="ribbon-tab file" id="file-tab">
        <span class="ribbon-title">Inicio</span>
        <div class="ribbon-backstage">
        <H4>    {{ config('slam.APP_ENTIDAD') }} - {{ config('slam.ENTIDAD_TI') }} </H4>

           
        </div>
    </div>

    <div class="ribbon-tab" id="next-tab">
        <span class="ribbon-title">General</span>
        <div class="ribbon-section">
            <span class="section-title">Usuario</span>

            <div class="ribbon-button ribbon-button-large"  id="btnMainLogAnio" >
            <span class="button-title">Año de <br/>Ejecución</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconAnios.png') }}" />
            </div>

            <div class="ribbon-button ribbon-button-large " id="btnMainLogPass">
            <span class="button-title">Cambiar<br/>Contraseña</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPassword.png') }}" />
            </div>
            <!--
            <div class="ribbon-button ribbon-button-large " id="btnMainLogCal">
            <span class="button-title"> Calculadora </span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconCal.png') }}" width="40px" height="40px" />
            </div>
            -->
           
        </div>
         <div class="ribbon-section">
              <span class="section-title">Requerimiento</span>
              <div class="ribbon-button ribbon-button-large" id="btnMainLogReq">
              <span class="button-title">Solicitud de <br>Requerimiento</span>
              <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconRq.png') }}" width="32px" height="32px" />
              </div>

              <div class="ribbon-button ribbon-button-large" id="btnMainLogReqSg">
              <span class="button-title">Seguimiento</span>
              <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconSegreq.png') }}" width="32px" height="32px"  />
              </div>

             <div class="ribbon-button ribbon-button-large" id="btnMainLogCat">
                 <span class="button-title">Catálogo de <br>BB y SS</span>
                 <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconCat.png') }}" />
             </div>
         </div>
        
         <div class="ribbon-section">
         <span class="section-title">Consulta</span>

             <div class="ribbon-button ribbon-button-large" id="btnMainLogCS" style="width:80px">
              <span class="button-title">Reporte  <br>de OC y OS</span>
              <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconRptocs.png') }}" width="35px" height="35px"  />
             </div>


             {{--<div class="ribbon-button ribbon-button-large" id="btnMainLogSiafSeg" style="width:80px">--}}
              {{--<span class="button-title">Seguimiento  <br>de OC y OS</span>--}}
              {{--<img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconSeg.png') }}" width="35px" height="35px"  />--}}
             {{--</div>--}}
             
            
        </div>

        <!-- <div class="ribbon-section">
            <span class="section-title">Tramite y Verificación</span>
            <div class="ribbon-button ribbon-button-large" id="btnTramBandeja">
            <span class="button-title">Tramite de <br>Requerimientos</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/computer_go.png') }}" width="32px" height="32px" />
            </div>

            <div class="ribbon-button ribbon-button-large" id="btnTramChecking">
            <span class="button-title">Verificación <br>de Requerimiento</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/checklist-1.png') }}" width="35px" height="35px"  />
            </div>
         </div>
        -->
          <div class="ribbon-section">
             <div class="ribbon-button ribbon-button-large" id="btnMainLogAnio">
            <span class="button-title">Año de Ejecución</span>
             <input type="text" id="txAnioFinal" name="txAnioFinal"  disabled="true" value="{{ config('slam.ANIO') }}" class="form-control gs-input txVarAnioEje2" style="width: 110px; text-align: center;  height:60px;font-size: 35px;  "   placeholder=".......... " > 
            </div>
          </div>

          <div class="ribbon-section">

           <span class="section-title"><a id="CloseSys" href="./auth/logout" ></a></span>
            <div class="ribbon-button ribbon-button-large" id="btnMainClose">
            <span class="button-title">SALIR</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/close.png') }}" />
            </div>

        
            
          </div>

          
    </div>
    <div class="ribbon-tab" id="tabLogistica">

        <span class="ribbon-title">Logística</span>
        <div class="ribbon-section">
            <span class="section-title">Ctz- CC - OC - OS </span>

            <div class="ribbon-button ribbon-button-large" id="btnMainLogCtz">
            <span class="button-title">Solicitud de <br/>Cotización </span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconCtz2.png') }}" />
            </div>

            <div class="ribbon-button ribbon-button-large" id="btnMainLogCC">
            <span class="button-title">Cuadro <br/>Comparativo</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconCmp.png') }}" />
            </div>

           <div class="ribbon-button ribbon-button-large" id="btnMainLogOC">
            <span class="button-title">Orden de<br/>Compra</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconOC.png') }}" />
            </div>

            <div class="ribbon-button ribbon-button-large" id="btnMainLogOS">
            <span class="button-title">Orden de<br/>Servicio</span>
            <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconOS.png') }}" />
            </div>

            
        </div>


         <div class="ribbon-section">

              <div class="ribbon-button ribbon-button-large" id="btnMainLogRptRanking">
              <span class="button-title">Ranking de <br>Proveedores</span>
              <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPrice.png') }}" />
              </div>

              <span class="section-title">Reportes</span>
              {{--<div class="ribbon-button ribbon-button-large" id="btnMainLogPrice">--}}
              {{--<span class="button-title">Precios<br>Referenciales</span>--}}
              {{--<img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPrice.png') }}" />--}}
              {{--</div>--}}

              
			       <div class="ribbon-button ribbon-button-large" id="btnMainLogRptSeace">
              <span class="button-title">Reportes <br>SEACE</span>
              <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconRpt.png') }}" width="35px" height="35px"  />
              </div>
			  
			       <div class="ribbon-button ribbon-button-large" id="btnMainLogRpt">
              <span class="button-title">Reportes <br>General</span>
              <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconRpt.png') }}" width="35px" height="35px"  />
             </div>

             


			  
        </div>

       <div class="ribbon-section">
            <div class="ribbon-button ribbon-button-large" id="btnMainLogAnio">
            <span class="button-title">Año de Ejecución</span>
             <input type="text"    disabled="true" value="{{ config('slam.ANIO') }}" class="form-control gs-input txVarAnioEjec" style="width: 110px; text-align: center;  height:60px;font-size: 35px;  "   placeholder=".......... " > 
            </div>
       </div>
 </div>


<div class="ribbon-tab" id="almacen-tab">
        <span class="ribbon-title">Almacén</span>
        <div class="ribbon-section">
            <span class="section-title">Ingreso y Salida</span>
            <div class="ribbon-button ribbon-button-large" id="btn-menuInternamiento">
                <span class="button-title">Internamiento</span>
                <span class="button-help">Registro de Internamiento de Bienes.</span>
                <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/box_down.png') }}" />
            </div>
            <div class="ribbon-button ribbon-button-large" id="btn-menuDistribucion">
                <span class="button-title">PECOSA</span>
                <span class="button-help">Registro de Salida de Bienes.</span>
                <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/iconDistribution.png') }}" />
            </div>
        </div>
        <div class="ribbon-section">
            <div class="ribbon-button ribbon-button-large" id="btn-menuSeguimiento">
                <span class="button-title">Consulta<br/>Seguimiento</span>
                <span class="button-help">Seguimiento.</span>
                <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/windows_32x32.png') }}" />
            </div>
        </div>
        <div class="ribbon-section">
            <div class="ribbon-button ribbon-button-large" id="btn-menuReporte">
                <span class="button-title">Reporte<br/>Almacén</span>
                <span class="button-help">Reportes.</span>
                <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/report_32x32.png') }}" />
            </div>
        </div>
       
       <div class="ribbon-section">
            <span class="section-title">Año de Ejecución</span>
                <input disabled="true" type="text" id="periodSys" value="{{ Carbon\Carbon::now()->year }}" class="form-control gs-input" style="width: 110px; text-align: center;  height:60px;font-size: 35px;  " />
        </div>
</div>


 <div class="ribbon-tab" id="tbConfiguracion">
        <span class="ribbon-title">Configuración</span>
        <div class="ribbon-section">
            <span class="section-title">Configuraciones</span>

             <div class="ribbon-button ribbon-button-large" id="btnMainLogRUC" >
             <span class="button-title">Registro de  <br>Proveedores</span>
             <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconProv.png') }}" />
             </div>

             <div class="ribbon-button ribbon-button-large" id="btnMainLogPers">
             <span class="button-title">Registro de  <br>Personal</span>
             <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPer.png') }}" />
             </div>

          
             <div class="ribbon-button ribbon-button-large" id="btnMainLogDep">
             <span class="button-title">Registro de  <br>Dependencia</span>
             <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPer.png') }}" />
             </div>

             <div class="ribbon-button ribbon-button-large" id="btnMainLogSecFun">
             <span class="button-title">Registro de  <br>Secuencia Funcional</span>
             <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPer.png') }}" />
             </div>

              <div class="ribbon-button ribbon-button-large" id="btnMainLogActDoc">
             <span class="button-title">Activar  <br>Documentos</span>
             <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPer.png') }}" />
             </div>

          
             <div class="ribbon-button ribbon-button-large" id="btnMainLogActUser">
             <span class="button-title">Cambiar  <br>Usuarios</span>
             <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconPer.png') }}" />
             </div>
             
         </div>

         <div class="ribbon-section">
                        <div class="ribbon-button ribbon-button-large" id="btnMainLogUsr">
               <span class="button-title">Registro de  <br>Cuentas de Usuario</span>
               <img class="ribbon-icon ribbon-normal" src="{{ asset('img/iconUsr.png') }}"  width="30px" height="30px" />
               </div>
           </div>

           <div class="ribbon-section">
                       <span class="section-title"><a id="CloseSys" href="./auth/logout" ></a></span>
                       <div class="ribbon-button ribbon-button-large" id="btnMainClose">
                       <span class="button-title">SALIR</span>
                       <img class="ribbon-icon ribbon-normal" src="{{ asset('plugins/ribbon/icons/normal/close.png') }}" />
                       </div>
           </div>
    </div>

  


 
</div>

<script>
    $('#btn-menuInternamiento').click(function(e){
        e.preventDefault();
        getMenuInternamiento();
    });

    $('#btn-menuDistribucion').click(function(e){
        e.preventDefault();
        getMenuDistribucion();
    });

    $('#btn-menuReporte').click(function(e){
        e.preventDefault();
        var url = 'reportemenu';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
        });
    });

    /*SEGUIMIENTO DE ALMACEN*/
    $('#btn-menuSeguimiento').click(function(e){
        e.preventDefault();
        var url = 'seguimiento';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
        });
    });

    $('#btn-tramiteLogistica').click(function(e){
        e.preventDefault();
        var url = 'tramite';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
        });
    });

    $('#btn-filtroLogistica').click(function(e){
        e.preventDefault();
        var url = 'filtro';
        $.get(url,function(data){
            $('.alm-content-wrapper').html(data);
        });
    });


</script>