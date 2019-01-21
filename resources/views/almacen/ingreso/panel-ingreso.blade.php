<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="alm-sub-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="panel panel-default" style="margin-bottom: 10px;">
                    <div class="panel-heading" style="height: 55px;">
                        <div class="col-sm-6" style="float: left;">
                            <div class="alm-title">
                                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                                PANEL DE INTERNAMIENTO
                            </div>
                            <div class="input-group" style="width: 150px;">
                                <input type="text" class="form-control" placeholder="Número" id="panelFindGi">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" id="btnFindGi">Buscar Guia de Internamiento</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#" id="btnFindOc">Buscar Orden de Compra</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#" id="btnFindNea">Buscar NEA</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            {{--<button class="btn btn-primary" onclick="change_to_submenu('internamiento/panel')">
                                VER TODOS
                            </button>--}}
                            {{--<button type="button" class="btn btn-primary" onclick="change_to_submenu('internamiento/oc')">--}}
                                {{--<i class="glyphicon glyphicon-shopping-cart"></i> INGRESO POR COMPRA--}}
                            {{--</button>--}}
                            <button type="button" class="btn btn-primary" onclick="change_to_submenu('internamiento/nea')" >
                                <i class="glyphicon glyphicon-list-alt"></i> INGRESO POR NEA
                            </button>
                            <button class="btn btn-danger" onclick="change_menu_to('internamiento/close')">
                                CERRAR
                            </button>
                        </div>
                    </div>
                </div>
                <div id="paginationContent">
                    <div class="panel panel-default">
                        <div class="panel-heading alm-panel-heading" style="overflow: hidden">
                            <span>Lista de Ordendes de Compra Registradas</span>
                            <div class="pull-right">{!! $giu->render() !!}</div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th data-options="field:'code'">Detalle</th>
                                    <th>Código GI</th>
                                    <th>Ord. Compra</th>
                                    <th>Proveedor</th>
                                    <th>Plazo</th>
                                    <th>Vence en</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Almacen</th>
                                    <th>Anulado</th>
                                    <th>Internamiento</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($giu as $key => $item)
                                <tr class="{{ $item->estado_anulacion == 'SI' ? 'danger' : '' }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td align="center">
                                        @if($item->estado_validacion == 'P')
                                            ::::::
                                        @else
                                        <a href="#" data-toggle="modal" data-target="#printPdfModal" data-gi="{{ $item->ing_giu }}">
                                            <img style="width: 20px; height: 20px;" src="{{ asset('img/iconDetail.png') }}">
                                        </a>
                                        @endif

                                    </td>
                                    <td>{{ $item->shortGi }}</td>
                                    <td>{{ $item->shortOc }}</td>
                                    <td>{{ $item->oc_proveedor }}</td>
                                    <td>{{ $item->oc_plazo_dias }}</td>
                                    <td>
                                    <?php
                                        $hoy = \Carbon\Carbon::today();
                                        $limite = \Carbon\Carbon::parse($item->oc_fecha_limite);
                                    ?>
                                        {{ $hoy->diffInDays($limite, false)==0?'Hoy':$hoy->diffInDays($limite, false).' Dias' }}
                                    </td>
                                    <td>
                                    @if($item->estado_validacion == 'P' && $item->estado_anulacion == 'NO')
                                        {{--<a href="#" data-toggle="modal" data-target="#limitDateModal" data-gui="{{ $item->ing_giu }}" data-limitdate="{{ $item->oc_fecha_limite }}" data-orc="{{ $item->oc_cod }}">--}}
                                            {{ isset($item->oc_fecha_limite)?date("d-m-Y", strtotime($item->oc_fecha_limite)):'' }}
                                        {{--</a>--}}
                                    @else
                                        {{ isset($item->oc_fecha_limite)?date("d-m-Y", strtotime($item->oc_fecha_limite)):'' }}
                                    @endif
                                    </td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>
                                    @if($item->estado_validacion == 'P' && $item->estado_anulacion == 'NO')
                                        <a href="#" data-toggle="modal" data-target="#cancelOcModal" data-gi="{{ $item->ing_giu }}" data-oc="{{ $item->oc_cod }}">
                                            {{ $item->estado_anulacion }}
                                        </a>
                                    @else
                                        {{ $item->estado_anulacion }}
                                    @endif
                                    </td>
                                    <td>
                                    @if($hoy->diffInDays($limite, false) < 0)
                                        <div class="bg-danger">
                                            FUERA DE PLAZO
                                        </div>
                                    @else
                                        @if($item->estado_anulacion == 'NO')
                                            @if($item->estado_validacion == 'C')
                                                CONFORME
                                            @elseif($item->estado_validacion == 'P')
                                                <a href="javascript:void(0)" onclick="change_to_submenu('{{ 'internamiento/bienes/'.$item->ing_giu }}')">
                                                    PENDIENTE
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" onclick="change_to_submenu('{{ 'internamiento/bienes/'.$item->ing_giu }}')">
                                                    EN TRANSITO
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                    </td>

                                    <td>
                                    @if($item->estado_salida == 'P' )
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#rmvGiModal" data-gi="{{ $item->ing_giu }}" data-oc="{{ $item->oc_cod }}">
                                            <img src="{{ asset('img/cross.png') }}">
                                        </a>
                                    @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="panel-footer">
                            {!! $giu->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1"></div>


@include('almacen.ingreso.updateLimitDate')
@include('almacen.ingreso.updateAnulacionOc')
@include('almacen.ingreso.printInternamiento')
@include('almacen.ingreso.deleteGiBox')

<script>

function remove_internamiento_process(gi,oc)
{
    var ok = confirm('Está a punto de eliminar de forma permanente en internamiento Nro: ' + gi + ' que corresponde a la orden de compra Nro: ' + oc + ' en almacén. \n \n ¿ESTÁ SEGURO DE ELIMINAR EL INTERNAMIENTO SELECCIONADO? \n ');
    if(!ok) return false;
    var data = $('#frm-rmv-gi').serialize();

    $.post('remove/gi',data,function(response){
        if(response == '200')
        {
            alert('El INTERNAMIENTO seleccionado fue eliminado correctamente del sistema \n');
            $('#rmvGiModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            getMenuInternamiento();
        }
    });

}
                
$(document).ready(function(){
    /*$('.dateLimit').editable({
        type: 'combodate',
        url: 'refresh/description',
        title: 'Descripción Formato',
        success: function(response){
            alert('Campo actualizado correctamente');
        }
    });*/
    $('#rmvGiModal').on('shown.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var gi = button.data('gi');
        var oc = button.data('oc');
        var modal = $(this);
        modal.find('.modal-body #rmvGi').val(gi);
        modal.find('.modal-body #refOc').val(oc);
    });

    $('.alm-sub-content').on('click','.pagination li a',function(e){
        e.preventDefault();

        var url = $(this).attr('href');
        var page = url.split('page=')[1];
        var period = $('#periodSys').val();

        $.get('internamiento/page',{'page':page, 'year':period},function(result){
            $('#paginationContent').html(result);
        });
    });

    $('#limitDateModal').on('shown.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var gi = button.data('gi');
        var ldate = button.data('limitdate');
        var oc = button.data('oc');
        var modal = $(this);
        modal.find('.modal-body #updtGi').val(gi);
        modal.find('.modal-body #limitDate').val(ldate);
        modal.find('.modal-body #updtOc').val(oc);

    });

    $('#cancelOcModal').on('shown.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var gi = button.data('gi');
        var oc = button.data('oc');
        var modal = $(this);
        modal.find('.modal-body #voidGi').val(gi);
        modal.find('.modal-body #voidOc').val(oc);
    });

    $('#printPdfModal').on('shown.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var gi = button.data('gi');
        var modal = $(this);
        var html = '';

        modal.find('.modal-body #printGi').val('');
        modal.find('.modal-body #select-cpi').html('');

        if(gi.substr(0,2) == 'NE')
        {
            modal.find('.modal-footer #btnPrintPdf').prop('disabled',true);
        }
        else
        {
            modal.find('.modal-footer #btnPrintPdf').prop('disabled',false);
        }

        $.get('findCpi',{guia : gi},function(result){
            modal.find('.modal-body #printGi').val(gi);
            modal.find('.modal-body #select-cpi').html(result);
        });

    });

    $('#btnFindGi').click(function(e){
        e.preventDefault();
        var codigo = $('#panelFindGi').val();
        var year = $('#periodSys').val();
        get_result_by(codigo,year,'gi');
    });

    $('#btnFindOc').click(function(e){
        e.preventDefault();
        var codigo = $('#panelFindGi').val();
        var year = $('#periodSys').val();
        get_result_by(codigo,year,'oc');
    });

    $('#btnFindNea').click(function(e){
        e.preventDefault();
        var codigo = $('#panelFindGi').val();
        var year = $('#periodSys').val();
        get_result_by(codigo,year,'nea');
    });

    function get_result_by(codigo,year,type)
    {
        if(type == 'gi')
        {
            $.get('findGi/'+codigo,{'year':year},function(result){
                $('#paginationContent').html(result);
            });
        }

        if(type == 'oc')
        {
            $.get('findOr/'+codigo,{'year':year},function(result){
                $('#paginationContent').html(result);
            });
        }

        if(type == 'nea')
        {
            $.get('findNea/'+codigo,{'year':year},function(result){
                $('#paginationContent').html(result);
            });
        }
        
    }
});

</script>