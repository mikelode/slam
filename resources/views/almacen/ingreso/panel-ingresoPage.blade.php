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
                {{--<th>Anulado</th>--}}
                <th>Internamiento</th>
                {{--<th></th>--}}
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
                        <img style="width: 20px; height: 20px;" src="{{ asset('img/iconDetail.png') }}">
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
                <td style="font-size: 9px;">{{ $item->nombre }}</td>
                {{--<td>--}}
                {{--@if($item->estado_validacion == 'P')--}}
                    {{--<a href="#" data-toggle="modal" data-target="#cancelOcModal" data-gi="{{ $item->ing_giu }}" data-oc="{{ $item->oc_cod }}">--}}
                        {{--{{ $item->estado_anulacion }}--}}
                    {{--</a>--}}
                {{--@else--}}
                    {{--{{ $item->estado_anulacion }}--}}
                {{--@endif--}}
                {{--</td>--}}
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

                {{--<td>--}}
                {{--@if($item->estado_salida == 'P' )--}}
                    {{--<a href="javascript:void(0)" data-toggle="modal" data-target="#rmvGiModal" data-gi="{{ $item->ing_giu }}" data-oc="{{ $item->oc_cod }}">--}}
                        {{--<img src="{{ asset('img/cross.png') }}">--}}
                    {{--</a>--}}
                {{--@endif--}}
                {{--</td>--}}
            
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
    {!! $giu->render() !!}
    </div>
</div>