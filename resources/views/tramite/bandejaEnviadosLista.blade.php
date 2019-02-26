<table class="table table-condensed" cellspacing="0" width="100%" style="font-size: smaller;">
    <thead>
    <tr>
        <th>#</th>
        <th>Documento</th>
        <th>Código</th>
        <th>Fecha de Envío</th>
        <th style="width: 500px;">Nota</th>
        <th>Quitar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bandeja as $key=>$item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->tlbTypeDoc }}</td>
            <td>{{ $item->tlbCodDoc  }}</td>
            <td>{{ $item->tlsFecha }}</td>
            <td>
                <div class="alm-input-frm">
                    @if($item->tlbTypeDoc == 'REQUERIMIENTO')
                        @if(!$item->tlbFlagCheck)
                            <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                        @else
                            {{ $item->tlbSituacion.' - Verificado por Logística' }}
                        @endif
                    @else
                        @if(!$item->tlbFlagR)
                            <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                        @else
                            {{ $item->tlbSituacion.' - Verificado por Logística' }}
                        @endif
                    @endif
                </div>
            </td>
            <td>
                <a href="#" onclick="quitar_documento('{{ $item->tlbId }}')">
                    <img src="{{ asset("img/cross.png") }}" alt="">
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    var token = $('meta[name="csrf-token"]').attr('content');

    $('.updtStateTram').editable({
        url: 'update/statetram',
        emptytext: 'No Especificado',
        params: {_token: token},
        success: function(response){
            /*alert('Estado del documento modificado con éxito');*/
        }
    });
</script>