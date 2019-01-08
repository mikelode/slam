<div class="panel panel-default">
    <div class="panel-heading alm-panel-heading" style="overflow: hidden">
        <span>Lista de Ordendes de Compra Registradas</span>
        <div class="pull-right">{!! $giu->render() !!}</div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th data-options="field:'code'">Imprimir</th>
                <th>Código GI</th>
                <th>Ord. Compra</th>
                <th>Tipo de Proceso</th>
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
                <td>{{ $giu->perPage()*($giu->currentPage() - 1) + $key + 1 }}</td>
                <td align="center">
                    @if($item->estado_validacion == 'P')
                        ::::::::::::
                    @else
                    <a href="#" data-toggle="modal" data-target="#printPdfModal" data-gi="{{ $item->ing_giu }}">
                        <img style="width: 20px; height: 20px;" src="{{ asset('img/print.png') }}">
                    </a>
                    @endif
                </td>
                <td>{{ $item->shortGi }}</td>
                <td>{{ $item->shortOc }}</td>
                <td style="font-size: 9px;">{{ $item->ocProcTipo }}</td>
                <td>{{ $item->oc_plazo_dias }}</td>
                <td>
                <?php
                    $hoy = \Carbon\Carbon::today();
                    $limite = \Carbon\Carbon::parse($item->oc_fecha_limite);
                ?>
                @if($hoy->diffInDays($limite, false) >= 0)
                    {{ $hoy->diffInDays($limite, false)==0?'Hoy':$hoy->diffInDays($limite, false).' Dias' }}
                @else
                    Vencido
                @endif
                </td>
                <td>
                @if($item->estado_validacion == 'P' )
                    <a href="#" data-toggle="modal" data-target="#limitDateModal" data-gi="{{ $item->ing_giu }}" data-limitdate="{{ $item->oc_fecha_limite }}">
                        {{ isset($item->oc_fecha_limite)?date("d-m-Y", strtotime($item->oc_fecha_limite)):'' }}
                    </a>
                @else
                    {{ isset($item->oc_fecha_limite)?date("d-m-Y", strtotime($item->oc_fecha_limite)):'' }}
                @endif
                </td>
                <td style="font-size: 9px;">{{ $item->nombre }}</td>
                <td>
                @if($item->estado_validacion == 'P')
                    <a href="#" data-toggle="modal" data-target="#cancelOcModal" data-gi="{{ $item->ing_giu }}" data-oc="{{ $item->oc_cod }}">
                        {{ $item->estado_anulacion }}
                    </a>
                @else
                    {{ $item->estado_anulacion }}
                @endif
                </td>
                <td>
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