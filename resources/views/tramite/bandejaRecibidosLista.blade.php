<table class="table alm-table" id="tblRecibidosDocs">
    <thead>
    <tr>
        <th>#</th>
        <th>Documento</th>
        <th>Código</th>
        <th>Fecha de Recepcion</th>
        <th style="width: 400px;">Glosa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bandeja as $key=>$item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->tlbTypeDoc }}</td>
            <td>{{ $item->tlbCodDoc }}</td>
            <td>{{ $item->tleFecha }}</td>
            <td>
                <div class="alm-input-frm">
                    <a href="#" class="updtStateTram" data-type="textarea" data-pk="{{ $item->tlbId }}" data-name="tramStateDoc">{{ $item->tlbSituacion }}</a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>