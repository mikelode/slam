<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="alm-sub-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="panel panel-default" style="margin-bottom: 10px;">
                    <div class="panel-heading" style="height: 55px;">
                        <div class="col-sm-6" style="float: left;">
                            <div class="alm-title">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                PANEL DE DISTRIBUCION DE BIENES
                            </div>
                            <div class="input-group" style="width: 150px;">
                                <input type="text" class="form-control" placeholder="Número" id="panelFindPs">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" id="btnFindPs">Buscar Pecosa</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#" id="btnFindOc">Buscar Orden de Compra</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#" id="btnFindNea">Buscar NEA</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                        </div>
                    </div>
                </div>
                <div id="paginationContent">
                    <div class="panel panel-default">
                        <div class="panel-heading alm-panel-heading" style="overflow: hidden">
                            <span>Lista de GI por Distribuir</span>
                            <div class="pull-right">{!! $giu->render() !!}</div>
                        </div>
                        <table class="table table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th style="width: 9%" align="center">Imprimir <img src="{{ asset('img/print.png') }}"></th>
                                    <th style="width: 10%">Guia de Internamiento</th>
                                    <th style="width: 10%">Fecha de Internamiento</th>
                                    <th style="width: 10%">Orden de Compra</th>
                                    <th style="width: 40%">Tipo de Proceso</th>
                                    <th style="width: 10%">Almacen</th>
                                    <th style="width: 9%">Estado de Salida</th>
                                </tr>
                            </thead>
                            <?php $convert = new \Logistica\Custom\FormatCode(); ?>
                            <tbody>
                                @foreach($giu as $key=>$item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <table>
                                            @foreach($item->pecosas as $ps)
                                            <tr>
                                                <td>
                                                    <a href="#" class="btnPrintPs" data-ps="{{ $ps->psal_pecosa }}">
                                                        {{ $convert->toShortMode($ps->psal_pecosa) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="change_to_submenu('{{ 'distribucion/edit/'.$ps->psal_pecosa }}')"> 
                                                        (Ver)
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>{{ $item->shortGi }}</td>
                                    <td>{{ date("d-m-Y",strtotime($item->conf_fecha)) }}</td>
                                    <td>{{ $item->shortOc }}</td>
                                    <td>{{ $item->ocProcTipo }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>
                                        @if($item->estado_salida == 'P')
                                            <a href="javascript:void(0)" onclick="change_to_submenu('{{ 'distribucion/bienes/'.$item->ing_giu }}')">PENDIENTE</a>
                                        @elseif($item->estado_salida == 'I')
                                            <a href="javascript:void(0)" onclick="change_to_submenu('{{ 'distribucion/bienes/'.$item->ing_giu }}')">INCOMPLETO</a>
                                        @else
                                            CONFORME
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
<div class="col-md-1">
</div>


<script>

$('#paginationContent').on('click','a.btnPrintPs',function(e){
    e.preventDefault();
    var ps = $(this).data('ps');
    var url = 'pdfPs/' + ps;
    window.open(url,"popupWindow", "width=800, height=400, scrollbars=yes, location=no");
});

$('.alm-sub-content').on('click','.pagination li a',function(e){
    e.preventDefault();

    var url = $(this).attr('href');
    var page = url.split('page=')[1];
    var period = $('#periodSys').val();

    $.get('distribucion/page',{'page':page, 'year':period},function(result){
        $('#paginationContent').html(result);
    });
});

$('#btnFindPs').click(function(e){
    e.preventDefault();
    var codigo = $('#panelFindPs').val();
    var year = $('#periodSys').val();
    get_result_by(codigo,year,'ps');
});

$('#btnFindOc').click(function(e){
   e.preventDefault();
    var codigo = $('#panelFindPs').val();
    var year = $('#periodSys').val();
    get_result_by(codigo,year,'oc'); 
});

$('#btnFindNea').click(function(e){
   e.preventDefault();
    var codigo = $('#panelFindPs').val();
    var year = $('#periodSys').val();
    get_result_by(codigo,year,'nea'); 
});

function get_result_by(codigo,year,type)
{
    if(type == 'ps')
    {
        $.get('findPs/'+codigo,{'year':year},function(result){
            $('#paginationContent').html(result);
        });
    }

    if(type == 'oc')
    {
        $.get('findPsoc/'+codigo,{'year':year},function(result){
            $('#paginationContent').html(result);
        });
    }
    if(type == 'nea')
    {
        $.get('findPsnea/'+codigo,{'year':year},function(result){
            $('#paginationContent').html(result);
        });
    }
    
}

</script>