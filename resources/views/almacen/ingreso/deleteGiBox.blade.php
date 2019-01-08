<?php
if(isset($item))
{
?>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="rmvGiModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">ELIMINAR GUIA DE INTERNAMIENTO</div>
            <div class="modal-body" style="overflow: hidden">
                <div class="col-md-12">
                    <form class="form-horizontal" id="frm-rmv-gi" action="">
                        {!! csrf_field() !!}
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="rmvGi">Guía de Internamiento</label>
                            <input class="form-control alm-input" type="text" name="rmvGi" id="rmvGi" readonly/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="refOc">Orden de Compra</label>
                            <input class="form-control alm-input" type="text" name="refOc" id="refOc" readonly/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="rmvCause">Motivo de Eliminación</label>
                            <textarea class="form-control" name="rmvCause"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnRemove" onclick="remove_internamiento_process('{{ $item->ing_giu }}','{{ $item->oc_cod }}');">Aceptar</button>
                <button type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php
}
?>