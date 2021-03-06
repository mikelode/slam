<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading" style="overflow: hidden">
                <div class="col-sm-7" style="float: left;">
                    <div class="alm-title">
                        <i class="fa fa-fw fa-cart-plus"></i>
                        REGISTRAR INTERNAMIENTO DE BIENES DE LA OC: <b>{{ substr($guia->oc_cod,4) }}</b>
                    </div>
                    {{--<div class="input-group" style="width: 200px;">
                        <input type="text" class="form-control" placeholder="O.C." id="autoFindOc">
                        <span class="input-group-btn">
                            <button class="btn btn-primary">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>--}}
                </div>
                <div class="pull-right">

                </div>
            </div>
        </div>
        <form class="form-horizontal" action="internamiento/bienes/{{ $guia->ing_giu }}" id="frmDataInternamiento">
            {!! csrf_field() !!}
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-2">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            DATOS
                        </div>
                        <div class="panel-body alm-panel-body">
                            <p style="margin: 0 0 4px"><label class="control-label">Guia de Int:</label></p>
                            <p><h5 style="text-align: center">{{ $guia->ing_giu }}</h5></p>
                            <p style="margin: 0 0 4px"><label class="control-label">Orden de Compra:</label></p>
                            <p style="text-align: center">
                                <span style="font-size: 14px;">{{ $guia->oc_cod }}</span> -
                                <button type="button" class="btn btn-warning btn-sm" onclick="refreshDataOc('{{ $guia->ing_giu }}', '{{ $guia->oc_cod }}');" style="padding: 4px; font-size: 10px; line-height: normal;">
                                    <i class="glyphicon glyphicon-refresh"></i>
                                </button>
                            </p>
                            <p style="margin: 0 0 4px"><label class="control-label">Tipo de Ingreso:</label></p>
                            <p><h5 style="text-align: center"> {{ $guia->tipo_internamiento=='A'?'En Almacen':'En Obra' }} </h5></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-heading alm-panel-heading">
                                DETALLE DE ENTREGA GI:
                            </div>
                            <div class="panel-body alm-panel-body">
                                <div class="col-md-12">
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Fecha de Recepción</label>
                                        <div class="col-sm-3">
                                            <input class="form-control alm-input" type="date" name="intDateReceipt" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                        </div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Persona que Entrega</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" id="intDniGiver" name="intDniGiver" placeholder="DNI" data-tipo="giver">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="intNameGiver" name="intNameGiver" placeholder="NOMBRE COMPLETO DEL QUE ENTREGA">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Persona que Recibe</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" id="intDniReceiver" name="intDniReceiver" placeholder="DNI" data-tipo="receipter">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="intNameReceiver" name="intNameReceiver" placeholder="NOMBRE COMPLETO DEL QUE RECIBE">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Conductor que Traslado</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input intDni" type="text" id="intDniDriver" name="intDniDriver" placeholder="DNI" data-tipo="driver">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="intNameDriver" name="intNameDriver" placeholder="NOMBRE COMPLETO DEL CONDUCTOR">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Guía de Remisión</label>
                                        <div class="col-sm-9">
                                            <input class="form-control alm-input" name="intGuiaRemision">
                                        </div>
                                    </div>
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Observación</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control alm-input" name="intComment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-body">
                            <button type="button" class="btn btn-success" id="saveInternamiento">
                                <i class="glyphicon glyphicon-floppy-save"></i> GUARDAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-primary alm-button" onclick="getMenuInternamiento();">
                                <i class="glyphicon glyphicon-remove-sign"></i> SALIR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            DETALLE DE BIENES
                        </div>
                        <table class="table alm-table">
                            <thead>
                                <tr>
                                    <th style="width: 15px;">#</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Cant</th>
                                    <th>Intern</th>
                                    <th>Und</th>
                                    <th>Recibir</th>
                                    <th>Estado</th>
                                    <th>
                                        <input type="checkbox" id="almCheckAll">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bienes as $key=>$bn)
                                <tr id="rowProduct{{ $key + 1 }}">
                                    <td>{{ $bn->prod_ord }}</td>
                                    <td>{{ $bn->prod_desc }}</td>
                                    <td>{{ $bn->prod_marca }}</td>
                                    <td>
                                        <input type="hidden" id="{{ 'proQ-'.$bn->prod_cod }}" value="{{ $bn->prod_cant }}">
                                        {{ $bn->prod_cant }}
                                    </td>
                                    <td>
                                        <input type="hidden" id="{{ 'stoQ-'.$bn->prod_cod }}" value="{{ $bn->prod_recep }}">
                                        {{ $bn->prod_recep }}
                                    </td>
                                    <td>{{ $bn->prod_medida }}</td>
                                    <td>
                                        @if($bn->flagR == 1)
                                            -
                                        @else
                                            <input type="number" min="0" class="form-control alm-input-table alm-control" style="width: 50px" name="{{ 'intQ-'.$bn->prod_cod.'-'.$bn->id }}" id="{{ 'intQ-'.$bn->prod_cod }}" value="0" onclick="this.select();" data-prod="{{ $bn->prod_cod }}">
                                        @endif
                                    </td>
                                    <td>
                                        @if($bn->flagR == 1)
                                            Entregado Completamente
                                        @else
                                            <input type="hidden" class="form-control alm-input-table" value="{{ $bn->prod_ingobs }}" name="{{ 'intC-'.$bn->prod_cod.'-'.$bn->id }}">
                                            Pendiente
                                        @endif
                                    </td>
                                    <td>
                                        @if($bn->flagR == 1)
                                            {{--<input class="alm-check fill-receipt" data-prod="{{ $bn->prod_cod }}" type="checkbox" checked>--}}
                                            <span class="glyphicon glyphicon-check"></span>
                                        @else
                                            <input id="check-{{ $key +1 }}" class="alm-check fill-receipt" data-prod="{{ $bn->prod_cod }}" type="checkbox">
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

$(document).ready(function(){

    /*var numInput = document.querySelector('input.alm-control');
    numInput.addEventListener('input',function(){
        var num = this.value.match(/^\d+$/);
        if(num === null)
        {
            this.value = '';
        }
    },false);*/

    $('#saveInternamiento').click(function(e){
        e.preventDefault();

        var msg = true;
        var atd = 0;
        $('input.alm-control').each(function(i){

            atd += parseFloat($(this).val());
            var row = $(this).closest('tr');
            var p = $(this).data('prod');
            var result = validar_cantidad(p,'proQ','stoQ','int',row);
          /*  if(!result)
            {
                alert('Atención: verifique la cantidad a ser recibida que ha ingresado en el detalle de los bienes');
                msg = false;
                return false;
            }
            */
        });

        if(!msg) return false;
        if(atd==0)
        {
            alert('No esta registrando ninguna cantidad de bienes ingresados, revise por favor.');
            return false;
        }
        var ok = confirm('¿Esta seguro de registrar el internamiento de los bienes?');
        if(!ok) return false;

        var url = $('#frmDataInternamiento').attr('action');
        var data = $('#frmDataInternamiento').serialize();

        $.post(url, data, function(response){
            alert(response);
            getMenuInternamiento();
        }).fail(function(dataError){
            var error = $.parseJSON(dataError.responseText);
            var msg = '';
            $.each(error, function(i,item){
                msg += item[0] + ' \n';
                console.log(item);
            });
            alert('Se identificó un ERROR, por favor revise: \n' + msg);
        });

    });

    $('#almCheckAll').change(function(){
        $('input:checkbox').prop('checked', $(this).prop('checked'));
        $('.fill-receipt').each(function(i){
            fillData(this,'proQ','intQ','stoQ','int');
        });
    });

    $('.fill-receipt').change(function(){
        fillData(this,'proQ','intQ','stoQ','int');
    });

    $('.intDni').inputmask({ mask: "99999999" });


    $("#intDniGiver,#intDniReceiver,#intDniDriver").keydown(function(e){
        if(e.shiftKey){
            e.preventDefault();
        }

        if(e.keyCode == 13){
            $this = $(this);
            var tipo = $this.data('tipo');

            $.get('findIntointernamiento',{'id': $this.val(), 'tipo': tipo}, function (data) {

                if(data.msgId == 500){
                    alert(data.msg);
                }
                else{
                    if(tipo == 'giver'){
                        $('#intNameGiver').val(data.fullname);
                    }
                    else if(tipo == 'receipter'){
                        $('#intNameReceiver').val(data.fullname)
                    }
                    else if(tipo == 'driver'){
                        $('#intNameDriver').val(data.fullname)
                    }
                }

            })

        }
    });

});

</script>