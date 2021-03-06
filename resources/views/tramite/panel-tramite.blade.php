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
                                <table class="table table-condensed" style="table-layout: fixed; margin-bottom: 0px;" width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="10%">Fecha</td>
                                        <td width="15%">
                                            <input type="date" name="envDate" style="width: 100%;" class="alm-input-frm" value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" name="envDependenciaId" value="{{ Auth::user()->dependencia->depID }}">
                                            <input type="text" name="envDependencia" class="alm-input-frm" style="width: 100%;" value="{{ Auth::user()->dependencia->depDsc }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombres</td>
                                        <td>
                                            <input class="alm-input-frm" name="envDni" style="width: 100%;" value="{{ $usuario[0]->perID }}" readonly>
                                        </td>
                                        <td colspan="2">
                                            <input class="alm-input-frm" name="envFullName" style="width: 100%;" value="{{ $usuario[0]->perNombres.'_'.$usuario[0]->perAPaterno.'_'.$usuario[0]->perAMaterno }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Enviar a</td>
                                        <td colspan="3">
                                            <select class="form-control alm-input" name="envUsrTarget" id="envUsrTarget">
                                                <option value="NA">-- Seleccione destinatario --</option>
                                                @foreach($logisticos as $logis)
                                                    <option value="{{ $logis->perID }}">{{ $logis->logNombres }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dependencia</td>
                                        <td colspan="3">
                                            <select class="form-control alm-input" name="envUsrDepTarget" id="envUsrDepTarget">
                                                <option value="NA">-- Seleccione dependencia --</option>
                                                @foreach($dependencias as $dep)
                                                    <option value="{{ $dep->depID }}">{{ $dep->depDsc }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Asunto</td>
                                        <td colspan="3">
                                            <textarea class="form-control alm-input" name="envMensaje"></textarea>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-body" style="text-align: center">
                                <button type="button" class="btn btn-primary alm-button" id="btnEmisionBandeja">
                                    {{--<i class="glyphicon glyphicon-remove-sign"></i>--}} EMISION
                                </button>
                                <p></p>
                                <button type="button" class="btn btn-primary alm-button" id="btnRecepcionBandeja">
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

    $('#btnEmisionBandeja').click(function (e) {
        e.preventDefault();

        $.get('tramite/salida', function(data){
            $('.alm-sub-content').html(data);
        });

    });

    $('#btnRecepcionBandeja').click(function (e) {
        e.preventDefault();

        $.get('tramite/entrada', function(data){
            $('.alm-sub-content').html(data);
        });
    });

    $('.alm-sub-content').on('click','#btn-send-doc',function(e){
        e.preventDefault();

        var flag = check_empty_checker($('input.alm-control'));

        if($('#envUsrTarget').val() == 'NA'){
            alert('Seleccione a quién se va a enviar el/los documento(s)');
            return false;
        }

        if(!flag){
            alert('Seleccione almenos un Requerimiento');
            return false;
        }
        else{
            var ok = confirm("¿Estás seguro de tramitar los documentos seleccionados?");
            if(!ok)
                return;
        }

        var url = $('#frm-send-doc').attr('action');
        var data = $('#frm-send-doc').serialize() + '&tramAnio=' + $('#txAnioFinal').val();

        $.post(url,data,function(response){
            alert(response.msg);
            change_to_submenu('tramite/salida');
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
            alert(response.msg);
            change_to_submenu('tramite/entrada')
        });
    });
});

</script>