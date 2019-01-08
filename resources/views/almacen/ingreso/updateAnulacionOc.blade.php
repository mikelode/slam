<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="cancelOcModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">ANULAR REGISTRO DE PANEL</div>
            <div class="modal-body" style="overflow: hidden">
                <div class="col-md-12">
                    <form class="form-horizontal" id="frm-cancel-oc" action="">
                        {!! csrf_field() !!}
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="updtGi">Guia de Internamiento</label>
                            <input class="form-control alm-input" type="text" name="cancelGi" id="voidGi" readonly/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="updtGi">Orden de Compra</label>
                            <input class="form-control alm-input" type="text" name="cancelOc" id="voidOc" readonly/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="causeLimitDate">Motivo de Anulación</label>
                            <textarea class="form-control" name="cancelCause"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAnular" onclick="anularOc();">Aceptar</button>
                <button type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>