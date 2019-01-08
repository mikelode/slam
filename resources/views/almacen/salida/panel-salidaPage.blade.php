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
                <td>{{ $giu->perPage()*($giu->currentPage() - 1) + $key + 1 }}</td>
                <td>
                    {{-- <a href="#" class="btnPrintPs" data-gi="{{ $item->ing_giu }}">Print</a> --}}
                    @foreach($item->pecosas as $ps)
                        <a href="#" class="btnPrintPs" data-ps="{{ $ps->psal_pecosa }}">{{ $convert->toShortMode($ps->psal_pecosa) }}</a>
                        <a href="javascript:void(0)" onclick="change_to_submenu('{{ 'distribucion/edit/'.$ps->psal_pecosa }}')"> (Ver)</a>
                        <br>
                    @endforeach
                </td>
                <td>{{ $item->ing_giu }}</td>
                <td>{{ $item->conf_fecha }}</td>
                <td>{{ $item->oc_cod }}</td>
                <td>{{ $item->ocProcTipo }}</td>
                <td>{{ $item->nombre }}</td>
                <td>
                    @if($item->estado_salida == 'P')
                        <a href="#" onclick="change_to_submenu('{{ 'distribucion/bienes/'.$item->ing_giu }}')">PENDIENTE</a>
                    @elseif($item->estado_salida == 'I')
                        <a href="#" onclick="change_to_submenu('{{ 'distribucion/bienes/'.$item->ing_giu }}')">INCOMPLETO</a>
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