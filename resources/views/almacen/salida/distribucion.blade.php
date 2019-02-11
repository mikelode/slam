<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading" style="overflow: hidden">
                <div class="col-sm-7" style="float: left;">
                    <div class="alm-title">
                        <i class="glyphicon glyphicon-share"></i>
                        REGISTRAR PECOSA DE LA GUIA DE INTERNAMIENTO: <b>{{ substr($giu->ing_giu,4) }}</b>
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
        <form class="form-horizontal" action="distribucion/bienes/{{ $giu->ing_giu }}" id="frmDataDistribucion">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-2">
                    <div class="panel panel-default alm-panel">
                        <div class="panel-heading alm-panel-heading">
                            DATOS DE LA GI
                        </div>
                        <div class="panel-body alm-panel-body">
                            <p style="margin: 0 0 4px"><label class="control-label">GI: </label></p>
                            <p>{{ $giu->ing_giu }}</p>
                            <p style="margin: 0 0 4px"><label class="control-label">OC: </label></p>
                            <p>{{ $giu->oc_cod }}</p>
                            <p style="margin: 0 0 4px"><label class="control-label">Fecha Internamiento: </label></p>
                            <p>{{ $giu->conf_fecha }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="panel panel-default alm-panel">
                            <div class="panel-heading alm-panel-heading">
                                DATOS PARA LA ATENCIÓN DE BIENES
                            </div>
                            <div class="panel-body alm-panel-body">
                                <div class="col-md-12">
                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Fecha de Atención</label>
                                        <div class="col-sm-3">
                                            <input class="form-control alm-input" type="date" value="{{ \Carbon\Carbon::now()->toDateString() }}" name="disDateAttend">
                                        </div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                    {{--<div class="form-group alm-form-group">--}}
                                        {{--<label class="col-sm-3 control-label">Persona que Despacha</label>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<input class="form-control alm-input" type="text" name="disNameServer" placeholder="DATOS DEL RESPONSABLE DE ENTREGA">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group alm-form-group">--}}
                                        {{--<label class="col-sm-3 control-label">Nombre del Solicitante : </label>--}}
                                        {{--<div class="col-sm-2">--}}
                                            {{--<input class="form-control alm-input formatDni" id="dniSolicitante" type="text" data-aim="dni" name="disDniApplicant" value="{{ isset($applicant[0]->reqSolicitante)?$applicant[0]->reqSolicitante:'' }}" placeholder="DNI (F2)">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-7">--}}
                                            {{--<input class="form-control alm-input" id="fnameSolicitante" type="text" name="disNameApplicant" value="{{ isset($applicant[0]->perNombres)?$applicant[0]->perNombres.' '.$applicant[0]->perAPaterno.' '.$applicant[0]->perAMaterno:'' }}" placeholder="NOMBRE COMPLETO">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                       <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Solicito Entregar A : </label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input formatDni" id="dniReceptor" type="text" data-aim="dniRecep" name="receportDniApplicant"  placeholder="DNI (F2)" value="{{ isset($applicant[0]->reqSolicitante)?$applicant[0]->reqSolicitante:'' }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" id="fnameReceptor" type="text" name="receptorNameApplicant" value="{{ isset($applicant[0]->perNombres)?$applicant[0]->perNombres.' '.$applicant[0]->perAPaterno.' '.$applicant[0]->perAMaterno:'' }}" placeholder="NOMBRE COMPLETO">
                                        </div>
                                    </div>

                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Cargo : </label>
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" name="disRole" placeholder="CARGO" value="{{ isset($applicant[0]->reqCondicion)?$applicant[0]->reqCondicion:'' }}">
                                        </div>
                                    </div>


                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Dependencia :</label>
                                        <div class="col-sm-2">
                                            <input class="form-control alm-input" id="depSolicitante" type="text" data-aim="dep" name="disDependency" value="{{ isset($applicant[0]->orcDep)?$applicant[0]->orcDep:'' }}" placeholder="DEP (F2)">
                                        </div>
                                        <div class="col-sm-7">
                                        <input class="form-control alm-input" id="depDsc" type="text" name="depDscNameApplicant" value="{{ isset($applicant[0]->depDsc)?$applicant[0]->depDsc:'' }}" placeholder="DEPENDENCIA">
                                          <!--  <input class="form-control alm-input" type="text" name="disRole" placeholder="CARGO">-->
                                        </div>
                                    </div>


                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Destino</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control alm-input" id="tarSolicitante" data-aim="sec" name="disTarget">{{ '('.trim($giu->oc_secFuncional).') '.trim($giu->oc_obra_destino) }}</textarea>
                                        </div>
                                    </div>

                                  

                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Guia de Remision</label>
                                        <div class="col-sm-3">
                                            <input class="form-control alm-input" id="guiarem" type="text" data-aim="dep" name="guiarem" value="{{ $guiaremision }}" placeholder="GUIA DE REMISION">
                                        </div>
                                         <label class="col-sm-1 control-label"> Factura</label>
                                        <div class="col-sm-3">
                                            <input class="form-control alm-input" id = "factura" type="text" name="factura" placeholder="FACTURA">
                                        </div>
                                    </div>




                                    <div class="form-group alm-form-group">
                                        <label class="col-sm-3 control-label">Observación</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control alm-input" name="disComment"></textarea>
                                        </div>
                                    </div>

                                     <div class="form-group alm-form-group" style="DISPLAY:NONE;">
                                        <label class="col-sm-5 control-label">Anio</label>
                                        <div class="col-sm-7">
                                            <input class="form-control alm-input" type="text" id="almAnio" name="almAnio"  >
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
                            <button type="button" class="btn btn-primary" id="saveDistribucion">
                                <i class="glyphicon glyphicon-floppy-save"></i> GUARDAR
                            </button>
                            <p></p>
                            <button type="button" class="btn btn-default alm-button" onclick="getMenuDistribucion()">
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
                        <table class="table table-hover alm-table">
                            <thead>
                                <tr>
                                    <th style="width: 15px;">#</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Stock</th>
                                    <th>Medida</th>
                                    <th>Atender</th>
                                    <th>Obs.</th>
                                    <th>
                                        <input type="checkbox" id="almCheckAll">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bienes as $key=>$bn)
                                <tr id="rowProduct{{ $key + 1 }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bn->prod_desc }}</td>
                                    <td>{{ $bn->prod_marca }}</td>
                                    <td>
                                        <input type="hidden" id="{{ 'ingQ-'.$bn->prod_cod }}" value="{{ $bn->prod_stock }}">
                                        {{ $bn->prod_stock }}
                                    </td>
                                    <td>{{ $bn->prod_medida }}</td>
                                    <td>
                                        @if($bn->flagD == 1)
                                            -
                                        @else
                                            <input type="number" min="0" class="form-control alm-input-table alm-control" style="width: 50px" name="{{ 'disQ-'.$bn->prod_cod.'-'.$bn->id }}" id="{{ 'disQ-'.$bn->prod_cod }}" value="0" onclick="this.select();" data-prod="{{ $bn->prod_cod }}">
                                        @endif
                                    </td>
                                    <td>
                                        @if($bn->flagD == 1)
                                            {{ $bn->prod_salobs }} - Distribuido Completamente
                                        @else
                                            <input type="text" class="form-control alm-input-table" value="{{ $bn->prod_salobs }}" name="{{ 'disC-'.$bn->prod_cod.'-'.$bn->id }}">
                                        @endif
                                    </td>
                                    <td>
                                        @if($bn->flagD == 1)
                                            {{--<input class="alm-check fill-attend" data-prod="{{ $bn->prod_cod }}" type="checkbox" checked>--}}
                                            <span class="glyphicon glyphicon-check"></span>
                                        @else
                                            <input id="check-{{ $key + 1 }}" class="alm-check fill-attend" data-prod="{{ $bn->prod_cod }}" type="checkbox">
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

@include('almacen.salida.findPersonaBox');
@include('almacen.salida.findDependencyBox');
@include('almacen.salida.findPersonaBoxRecep');
@include('almacen.salida.findSecfunBox');

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
  $("#almAnio").val($('#periodSys').val());
    $('.formatDni').inputmask({ mask: "99999999" });
     $('.formatDniReceptor').inputmask({ mask: "99999999" });

    $('#dniReceptor , #dniSolicitante, #depSolicitante, #tarSolicitante').keydown(function(e){
        if(e.shiftKey)     {        e.preventDefault();      }
        if(e.keyCode == 13){
            $.getJSON('findPersona',{'term':$(this).val(), 'tipo':'dni'},function(result){
                if(result.length == 0)
                    $('#fnameReceptor').val('Persona no registrada');
                else
                    $('#fnameReceptor').val(result[0].fullname);
            });
        }
        if (e.keyCode == 113) {
            var tipo = $(this).data('aim');
            if(tipo == 'dni')
            {
                $('#modalFindPersona').modal('show')
            }
            if(tipo == 'dep')
            {
                $('#modalFindDependency').modal('show');
            }
            if(tipo == 'sec')
            {
                $('#modalFindSecfun').modal('show');
            }
             if(tipo == 'dniRecep')
            {
                $('#modalFindReceptor').modal('show')
            }
        }
    });

    $('#saveDistribucion').click(function(e){
        e.preventDefault();

        var msg = true;
        var dst = 0;
        $('input.alm-control').each(function(i){

            dst += parseFloat($(this).val());
            var row = $(this).closest('tr');
            var p = $(this).data('prod');
            var result = validar_cantidad(p,'ingQ','ingQ','dis',row);
          /*  if(!result)
            {
                alert('Atención: verifique la cantidad a ser distribuida que ha ingresado en el detalle de los bienes');
                msg = false;
                return false;
            }*/
        });

        if(!msg) return false;
        if(dst==0)
        {
            alert('No esta registrando ninguna cantidad de bienes a atender, revise por favor.');
            return false;
        }
        var ok = confirm('¿Esta seguro de registrar la atención y distribución de los bienes?');
        if(!ok) return false;

        var url = $('#frmDataDistribucion').attr('action');
        var data = $('#frmDataDistribucion').serialize();

        $.post(url, data, function(response){
            alert(response);
            getMenuDistribucion();
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
        $('.fill-attend').each(function(i){
            fillData(this,'ingQ','disQ','NA','dis');
        });
    });

    $('.fill-attend').change(function(){
        fillData(this,'ingQ','disQ','NA','dis');
    });
});
function fillResultSelected(dni, fullname)
{
    $('#dniSolicitante').val(dni);
    $('#fnameSolicitante').val(fullname);
    $('#modalFindPersona').modal('hide');
}

function fillResultSelectedReceptor(dni, fullname)
{
    $('#dniReceptor').val(dni);
    $('#fnameReceptor').val(fullname);
    $('#modalFindReceptor').modal('hide');
}


/*function fillResultSelectedDep(id)
{
    $('#depSolicitante').val(id);
    $('#modalFindDependency').modal('hide');
}*/
function fillResultSelectedDep(id, fullname)
{
    $('#depSolicitante').val(id);
    $('#depDsc').val(fullname);
    $('#modalFindDependency').modal('hide');
}

function fillResultSelectedSec(id, dsc)
{
    $('#tarSolicitante').val('');
    $('#tarSolicitante').val('(' + id + ') ' + dsc);
    $('#modalFindSecfun').modal('hide');
}
</script>