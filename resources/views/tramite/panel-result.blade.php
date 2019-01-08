<?php
    $index = count($result) - 1;
    $focus = $index;

    if($result[$index]['tlbTypeDoc'] == 'SIAF')
    {
        $index = $index-1;
    }
?>

<div class="row">

    <div class="col-md-4">
        <div class="img-lateral img-rounded">
            <img src="{{ asset('css/img/marco-e.png') }}">
        </div>
    </div>
    <div class="col-md-8">
        <h4>Estimado Sr(a), la cotización Nro: {{ $result[1]['tlbCodDoc'] }}<br></h4>

        @if($result[$index]['tlbTypeDoc'] == 'ORDEN DE COMPRA' || $result[$index]['tlbTypeDoc'] == 'ORDEN DE SERVICIO')
            <div class="sombra2"> Se encuentra en {{ $result[$index]['tlbTypeDoc'] }} </div>
        @else
            <div class="sombra2"> El proceso aún no cuenta con Orden de Compra u Orden de Servicio según corresponda. </div>
        @endif
        <h3> {{ $result[$index]['tlbSituacion'] }} </h3>
        <table class="table-result">
            <tr>
                <td>Nro</td>
                <td>Documento</td>
                <td>Número</td>
            </tr>
            @foreach($result as $key=>$etapa)
                @if($key == $focus)
                    @if($etapa['tlbTypeDoc'] == 'SIAF')
                        <tr id="lastrow">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $etapa['tlbTypeDoc'] }}</td>
                            <td>
                                <?php
                                    switch($etapa['socFase'])
                                    {
                                        case 'C':
                                            echo 'COMPROMETIDO';
                                            break;
                                        case 'D':
                                            echo 'DEVENGADO';
                                            break;
                                        case 'G':
                                            echo 'GIRADO';
                                            break;
                                        case 'P':
                                            echo 'PAGADO';
                                            break;
                                        default:
                                            'SIN FASE';
                                    }
                                ?>
                            </td>
                        </tr>
                    @else
                        <tr id="lastrow">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $etapa['tlbTypeDoc'] }}</td>
                            <td>{{ $etapa['tlbCodDoc'] }}</td>
                        </tr>
                    @endif
                @else
                    @if($etapa['tlbTypeDoc'] == 'SIAF')
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $etapa['tlbTypeDoc'] }}</td>
                            <td>
                                <?php
                                switch($etapa['socFase'])
                                {
                                    case 'C':
                                        echo 'COMPROMETIDO';
                                        break;
                                    case 'D':
                                        echo 'DEVENGADO';
                                        break;
                                    case 'G':
                                        echo 'GIRADO';
                                        break;
                                    case 'P':
                                        echo 'PAGADO';
                                        break;
                                    default:
                                        'SIN FASE';
                                }
                                ?>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $etapa['tlbTypeDoc'] }}</td>
                            <td>{{ $etapa['tlbCodDoc'] }}</td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </table>

    </div>
</div>