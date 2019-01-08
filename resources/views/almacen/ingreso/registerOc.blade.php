<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading" style="overflow: hidden">
                <div class="col-sm-7" style="float: left;">
                    <div class="alm-title">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                        REGISTRAR ORDEN DE COMPRA NRO:
                    </div>
                    <div class="input-group" style="width: 200px;">
                        <input type="text" class="form-control" placeholder="O.C." id="autoFindOc">
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
                    Datos Complementarios a la Orden de Compra
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
                        <div class="form-group alm-form-group">
                            <label class="col-sm-5 control-label">Fec. de Notificación</label>
                            <div class="col-sm-7">
                                <input class="form-control alm-input" type="date" name="ocDateNotification">
                            </div>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="col-sm-5 control-label">Fec. de Vencimiento</label>
                            <div class="col-sm-7">
                                <input class="form-control alm-input" type="date" name="ocDateExpiration">
                            </div>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="col-sm-5 control-label">Tipo de Entrega</label>
                            <div class="col-sm-7">
                                <select class="form-control alm-input" name="ocDeliveryType">
                                    <option value="A" selected>En Almacén</option>
                                    <option value="O">En Obra</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="col-sm-5 control-label">Almacén</label>
                            <div class="col-sm-7">
                                <select class="form-control alm-input" name="ocAlmacen">
                                    @foreach($almacen as $a)
                                        <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group alm-form-group" style="visibility: hidden;">
                            <label class="col-sm-5 control-label">Guía de Remisión</label>
                            <div class="col-sm-7">
                                <input class="form-control alm-input" type="text" name="ocNroGuiaRemision" value="0001-001">
                            </div>
                        </div>
                        <div class="form-group alm-form-group" style="visibility: hidden;">
                            <label class="col-sm-5 control-label">Factura</label>
                            <div class="col-sm-7">
                                <input class="form-control alm-input" type="text" name="ocNroFactura"  value="0001-001">
                            </div>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="col-sm-5 control-label">Observación</label>
                            <div class="col-sm-7">
                                <textarea  class="form-control" name="ocComment"></textarea>
                            </div>
                        </div>

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
                    <button type="button" class="btn btn-primary alm-button" id="btnSaveOc" disabled>
                        <i class="glyphicon glyphicon-floppy-save"></i> GUARDAR
                    </button>
                    <button type="button" class="btn btn-primary alm-button" onclick="change_menu_to('internamiento/close')">
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


<script>
$(document).ready(function(){

  $("#almAnio").val($('#periodSys').val());
    $('#autoFindOc').focus();

    $('#autoFindOc').autocomplete({
        source: function(request, response){
            $.getJSON('findOc',{term: request.term , period: $('#periodSys').val() }, response);
        },
        minLength: 1,
        open: function() {$(this).removeClass('ui-autocomplete-loading')},
        select: function(e, data){
            e.preventDefault();
            $.get('verifyOcExist',{'oc' : data.item.value},function(response){
                if(response == 200 || response == 501)
                {
                    if(response == 501)
                    {
                        var ok = confirm('La Orden de Compra seleccionada fue recientemente anulada. \n ¿Desea volver a registrarla?');
                        if(!ok) return false;
                    }

                    $('.preloader').css('display','');
                    $('#btnSaveOc').prop('disabled',false);
                    $('#ocSelected').val(data.item.value);
                    $('#autoFindOc').val(data.item.label);
                    $.get('dataOc',{'oc' : data.item.value},function(result){
                        $('#data-detail-oc').html('');
                        $('#data-detail-oc').html(result);
                    });
                    $.get('productsOc',{'oc' : data.item.value},function(result){
                        $('#products-detail-oc').html('');
                        $('#products-detail-oc').html(result);
                    });
                    /*$('.preloader').css('display','none');*/
                    $('.preloader').hide(2000);
                }
                else
                {
                    alert('La Orden de Compra seleccionada, ya fue registrada anteriormente verifique correctamente el código de la Orden de Compra.');
                    change_to_submenu('internamiento/oc');
                }
            });

        }
    });

    $('#btnSaveOc').click(function(e){
        e.preventDefault();

        var ok = confirm('Esta seguro de registrar la Orden de Compra');

        if(ok)
        {
            var url = 'internamiento/oc';
            var data = $('#frmDataOc').serialize();

            $.post(url,data,function(result){
                alert(result);
                getMenuInternamiento();
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