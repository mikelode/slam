<table class="table alm-table" id="tblPendientesDocs">
    <thead>
    <tr>
        <th>#</th>
        <th>Documento</th>
        <th>Código</th>
        <th>Fecha de Envio</th>
        <th style="width: 400px;">Nota</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bandeja as $key=>$item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->tlbTypeDoc }}</td>
            <td>{{ $item->tlbCodDoc }}</td>
            <td>{{ $item->tlsFecha }}</td>
            <td>
                <div class="alm-input-frm">
                    <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>