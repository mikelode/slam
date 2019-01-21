<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel panel-default" style="margin-bottom: 10px;">
                <div class="panel-heading" style="overflow: hidden">
                    <div class="col-sm-7" style="float: left;">
                        <div class="alm-title" style="padding-top: 0px;">
                            <img src="img/iconAdvice.png" width="40px" height="40px" style="margin-right: 10px">
                            <strong>NOTIFICAR ORDEN DE COMPRA NRO:</strong>
                        </div>
                        <div class="input-group" style="width: 200px;">
                            <input type="text" autofocus class="form-control" placeholder="Número de O.C." id="txtOcnotify">
                            <span class="input-group-btn">
                                <button class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="pull-right">

                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding-left: 0">
                <div class="panel panel-default alm-panel">
                    <div class="panel-heading alm-panel-heading">
                        Datos de Notificación de Orden de Compra
                    </div>
                    <div class="panel-body alm-panel-body">
                        {{--<form class="form-horizontal" action="#">
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Orden de Compra</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control alm-input" id="autoFindOc">
                                </div>
                            </div>
                        </form>--}}
                        <form class="form-horizontal" action="#" id="frmDataOc">
                            {!! csrf_field() !!}
                            <input type="hidden" value="" name="ocCodigo" id="ocSelected">
                            <input type="hidden" value="" name="guiId" id="ocGuiainternamiento">
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Estado</label>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" type="text" name="ocStatusNotif" id="txEstado" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Medio de Notif.</label>
                                <div class="col-sm-7">
                                    <select class="form-control alm-input" name="ocMedioNotificacion" id="notMedio">
                                        <option value="0">-- Seleccione --</option>
                                        @foreach($medios as $medio)
                                            <option value="{{ $medio->mdnID }}">{{ $medio->mdnDsc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Fecha de Notif.</label>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" type="date" name="ocDateNotification" id="notDate">
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Último día de entrega</label>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" type="date" name="ocDateExpiration" id="notExpiration">
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Tipo de Entrega</label>
                                <div class="col-sm-7">
                                    <select class="form-control alm-input" name="ocDeliveryType" id="notEntrega">
                                        <option value="A" selected>En Almacén</option>
                                        <option value="O">En Obra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Almacén</label>
                                <div class="col-sm-7">
                                    <select class="form-control alm-input" name="ocAlmacen" id="notAlmacen">
                                        @foreach($almacen as $a)
                                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group alm-form-group">
                                <label class="col-sm-5 control-label">Observación</label>
                                <div class="col-sm-7">
                                    <textarea  class="form-control" name="ocComment" id="notComment"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="ocNroGuiaRemision" value="">
                            <input type="hidden" name="ocNroFactura"  value="">
                            <div class="form-group alm-form-group" style="DISPLAY:NONE;">
                                <label class="col-sm-5 control-label">Anio</label>
                                <div class="col-sm-7">
                                    <input class="form-control alm-input" type="text" id="almAnio" name="almAnio"  >
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
                <div class="panel panel-default alm-panel">
                    <div class="panel-body">
                        <button type="button" class="btn btn-primary" id="btnSaveOc" disabled>
                            <i class="glyphicon glyphicon-floppy-save"></i> REGISTRAR
                        </button>
                        <button type="button" class="btn btn-primary" onclick="change_menu_to('internamiento/close')">
                            <i class="glyphicon glyphicon-remove-sign"></i> SALIR
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="preloader" style="display: none;">
                    <img src="{{ asset('css/img/loader.gif') }}">
                </div>
                <div class="row">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            Datos de la Orden de Compra
                        </div>
                        <div class="panel-body alm-panel-body">
                            <div id="data-detail-oc">
                                <p>Plazo de Entrega</p>
                                <p>Glosa de OC</p>
                                <p>Documento de Referencia</p>
                                <p>Proveedor</p>
                                <p>Tipo de Proceso</p>
                                <p>Secuencia Funcional - Proy/Activ</p>
                                <p>Dependencia</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">Lista de Bienes</div>
                        <div id="products-detail-oc">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cant</th>
                                    <th>Und</th>
                                    <th>Marca</th>
                                    <th>Precio</th>
                                    <th>Costo</th>
                                    <th>Clasif</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>A</td>
                                    <td>A</td>
                                    <td>A</td>
                                    <td>A</td>
                                    <td>A</td>
                                    <td>A</td>
                                    <td>A</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // $('#notDate').val(moment().format('YYYY-MM-DD'));

        $("#almAnio").val($('#periodSys').val());

        function fnDisplayInfo(ocId, periodo){
            $.get('displayOc',{oc: ocId , period: periodo }, function (data) {

                if(data.msgId == 200)
                {
                    $('.preloader').css('display','');
                    $('#btnSaveOc').prop('disabled',false);
                    $('#ocSelected').val(data.oc.orcID);

                    if(data.datanotif == null){
                        $('#txEstado').val('NO NOTIFICADO');
                        $('#btnSaveOc').attr('class','btn btn-success');
                        $('#btnSaveOc').html('<i class="glyphicon glyphicon-floppy-save"></i> REGISTRAR');
                    }
                    else{
                        $('#txEstado').val('NOTIFICADO');
                        $('#notDate').val(data.datanotif[0].oc_fecha_notificacion);
                        $('#notExpiration').val(data.datanotif[0].oc_fecha_limite);
                        $('#notEntrega').val(data.datanotif[0].tipo_internamiento);
                        $('#notAlmacen').val(data.datanotif[0].ing_almacen);
                        $('#notComment').val(data.datanotif[0].ing_obs);
                        $('#notMedio').val(data.datanotif[0].oc_medio_notificacion);
                        $('#ocGuiainternamiento').val(data.datanotif[0].ing_giu);
                        $('#btnSaveOc').attr('class','btn btn-warning');
                        $('#btnSaveOc').html('<i class="glyphicon glyphicon-floppy-save"></i> MODIFICAR');
                    }

                    $('#data-detail-oc').html('');
                    $('#data-detail-oc').html(data.viewData);
                    $('#products-detail-oc').html('');
                    $('#products-detail-oc').html(data.viewProducts);
                    /*$('.preloader').css('display','none');*/
                    $('.preloader').hide(2000);
                }
                else {
                    alert(data.msg);
                }
            });
        }

        $('#txtOcnotify').keydown(function (event) {
            if(event.keyCode == 13 ) {
                fnDisplayInfo($(this).val(), $('#periodSys').val())
            }
        });

        $('#btnSaveOc').click(function(e){
            e.preventDefault();

            var ok = confirm('¿Está seguro de registrar los datos de NOTIFICACION de la Orden de Compra?');

            if(ok)
            {
                var url = 'internamiento/oc';
                var data = $('#frmDataOc').serialize();

                $.post(url,data,function(result){
                    alert(result);
                    fnDisplayInfo($('#txtOcnotify').val(), $('#periodSys').val())
                }).fail(function(dataError){
                    console.log(dataError);
                    var error = $.parseJSON(dataError.responseText);
                    var msg = '';
                    $.each(error, function(i,item){
                        msg += item[0] + ' \n';
                        console.log(item);
                    });
                    alert('Error. Revise su conexión al servidor \n' + msg);
                });
            }
        });
    });
</script>