<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel panel-default" style="margin-bottom: 10px;">
                <div class="panel-heading" style="overflow: hidden">
                    <div class="col-sm-7" style="float: left;">
                        <div class="alm-title" style="padding-top: 0">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            ENVIO - RECEPCION DE DOCUMENTOS
                        </div>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
            <form id="frm-send-doc" action="tramite/sendDoc">
            {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-heading alm-panel-heading">
                                Datos del Usuario o Remitente que enviará el/los documentos
                            </div>
                            <div class="panel-body alm-panel-body">
                                <div class="form-group alm-form-group">
                                    <label class="control-label alm-label" for="">Fecha</label>
                                    <input type="date" name="envDate" class="alm-input-frm" style="width: 149px; display: inline-block" value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="control-label alm-label" for="">Nombres</label>
                                    <input class="alm-input-frm" name="envDni" style="width: 80px;" value="{{ $usuario[0]->perID }}" readonly>
                                    <input class="alm-input-frm" name="envFullName" style="width: 500px;" value="{{ $usuario[0]->perNombres.'_'.$usuario[0]->perAPaterno.'_'.$usuario[0]->perAMaterno }}" readonly>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="control-label alm-label" for="">Dependencia</label>
                                    <input class="alm-input-frm" name="envDepOrigen" style="width: 583px;" value="{{ $usuario[0]->perCodDep.' - '.$usuario[0]->Descripcion }}" readonly>
                                </div>
                                {{--<div class="form-group alm-form-group">
                                    <label class="control-label alm-label" style="float: left">Glosa</label>
                                    <textarea class="form-control alm-input" name="envGlosa" style="width: 500px;"></textarea>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-body" style="text-align: center">
                                <button type="button" class="btn btn-primary alm-button" onclick="change_to_submenu('tramite/salida')">
                                    {{--<i class="glyphicon glyphicon-remove-sign"></i>--}} EMISION
                                </button>
                                <p></p>
                                <button type="button" class="btn btn-primary alm-button" onclick="change_to_submenu('tramite/entrada')">
                                    {{--<i class="glyphicon glyphicon-floppy-save"></i>--}} RECEPCION
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="alm-sub-content"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-1"></div>

<script>

$(document).ready(function(){

    $('.alm-sub-content').on('click','#btn-send-doc',function(e){
        e.preventDefault();

        var flag = check_empty_checker($('input.alm-control'));

        if(!flag)
        {
            alert('Seleccione almenos un Requerimiento');
            return false;
        }

        var url = $('#frm-send-doc').attr('action');
        var data = $('#frm-send-doc').serialize();

        $.post(url,data,function(response){
            if(response == '200')
            {
                alert('Registrado su envío con éxito');
            }
            else
            {
                alert('Error. Verifique su conexión al servidor');
            }
            change_to_submenu('tramite/salida')
        });

    });

    $('.alm-sub-content').on('click','#btn-receipt-doc',function(e){

        e.preventDefault();

        var flag = check_empty_checker($('input.alm-controlc'));

        if(!flag)
        {
            alert('Seleccione almenos un Requerimiento');
            return false;
        }

        var url = 'tramite/receiptDoc';
        var data = $('#frm-send-doc').serialize();

        $.post(url,data,function(response){
            if(response == '200')
            {
                alert('Registrado su envío con éxito');
            }
            else
            {
                alert('Error. Verifique su conexión al servidor');
            }
            change_to_submenu('tramite/entrada')
        });
    });
});

</script>