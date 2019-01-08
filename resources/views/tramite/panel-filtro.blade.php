<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel panel-default" style="margin-bottom: 10px;">
                <div class="panel-heading" style="overflow: hidden">
                    <div class="col-sm-7" style="float: left;">
                        <div class="alm-title" style="padding-top: 0">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            VALIDACIÓN DE DOCUMENTOS
                        </div>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
            <form id="frm-check-doc" action="tramite/checkDoc">
            {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-heading alm-panel-heading">
                                Datos del Usuario que validará el/los documento(s)
                            </div>
                            <div class="panel-body alm-panel-body">
                                <div class="form-group alm-form-group">
                                    <label class="control-label alm-label" for="">Fecha</label>
                                    <input class="alm-input-frm" style="width: 149px; display: inline-block" value="{{ \Carbon\Carbon::now() }}" name="checkDate" readonly>
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="control-label alm-label" for="">Nombres</label>
                                    <input class="alm-input-frm" style="width: 80px;" name="checkDni" value="{{ $usuario[0]->perID }}" readonly>
                                    <input class="alm-input-frm" name="checkFullName" style="width: 500px;" value="{{ $usuario[0]->perNombres.'_'.$usuario[0]->perAPaterno.'_'.$usuario[0]->perAMaterno }}">
                                </div>
                                <div class="form-group alm-form-group">
                                    <label class="control-label alm-label" for="">Dependencia</label>
                                    <input class="alm-input-frm" style="width: 583px;" name="checkDepCheck" value="{{ $usuario[0]->perCodDep.' - '.$usuario[0]->Descripcion }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel with-nav-tabs panel-default" style="margin-bottom: 10px;">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab-pendientes" data-toggle="tab">
                                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                                            DOCUMENTOS A VERIFICAR
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab-verificados" data-toggle="tab">VERIFICADOS - ATENDIDOS</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body alm-panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-pendientes">
                                        <table class="table alm-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Documento</th>
                                                <th>Código</th>
                                                <th>Fecha Creación</th>
                                                <th>Fecha Envío</th>
                                                <th>Enviado por</th>
                                                <th>Glosa</th>
                                                <th>Elegir</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bandeja as $key=>$item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->tlbTypeDoc }}</td>
                                                    <td>{{ $item->tlbCodDoc }}</td>
                                                    <td>{{ $item->tlbFechaDoc }}</td>
                                                    <td>{{ $item->tlsFecha }}</td>
                                                    <td>{{ $item->tlsNombre.' '.$item->tlsAPaterno.' '.$item->tlsAMaterno }}</td>
                                                    <td>
                                                        <div class="alm-input-frm">
                                                            <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                                                        </div>
                                                    </td>
                                                    <td><input type="checkbox" class="alm-control" name="checkDoc[]" value="{{ $item->tlbId }}"></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade in" id="tab-verificados">
                                        <table class="table alm-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Documento</th>
                                                <th>Código</th>
                                                <th>Fecha de Verficación</th>
                                                <th>Verificado por</th>
                                                <th>Glosa</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($verificados as $key=>$item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->tlbTypeDoc }}</td>
                                                    <td>{{ $item->tlbCodDoc }}</td>
                                                    <td>{{ $item->tlvFecha }}</td>
                                                    <td>{{ $item->tlvNombre.' '.$item->tlvAPaterno.' '.$item->tlvAMaterno }}</td>
                                                    <td>
                                                        <div class="alm-input-frm">
                                                            <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body" style="text-align: center">
                                <a class="btn btn-app" id="btn-check-doc" style="width: 90px;">
                                    <i class="fa fa-flag-checkered"></i> VALIDAR
                                </a>
                                <p></p>
                                <a class="btn btn-app" style="width: 90px;">
                                    <i class="fa fa-refresh"></i> ACTUALIZAR
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-1"></div>

<script>
$(document).ready(function(){

    $('#btn-check-doc').click(function(e){

        e.preventDefault();

        var flag = check_empty_checker($('input.alm-control'));

        if(!flag)
        {
            alert('Seleccione almenos un Requerimiento');
            return false;
        }

        var url = $('#frm-check-doc').attr('action');
        var data = $('#frm-check-doc').serialize();

        $.post(url,data,function(response){
            if(response == '200')
            {
                alert('Verificación del documento registrada correctamente.');
            }
            else
            {
                alert('Error. Verifique su conexión al servidor');
            }
            getMenuVerificacion();
        });

    });

    var token = $('meta[name="csrf-token"]').attr('content');

    $('.updtStateTram').editable({
        url: 'update/statetram',
        emptytext: 'No Especificado',
        params: {_token: token},
        success: function(response){

        }
    });



});
</script>