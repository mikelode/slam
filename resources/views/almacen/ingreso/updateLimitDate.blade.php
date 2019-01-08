<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="limitDateModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">MODIFICAR FECHA DE VENCIMIENTO</div>
            <div class="modal-body" style="overflow: hidden">
                <div class="col-md-12">
                    <form class="form-horizontal" id="frm-extend-date" action="">
                        {!! csrf_field() !!}
                        <input type="hidden" name="updtOc" id="updtOc">
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="updtGi">Guia de Internamiento:</label>
                            <input class="form-control alm-input" type="text" name="updtGi" id="updtGi" readonly/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="newLimitDate">Fecha</label>
                            <input class="form-control alm-input" type="date" name="newLimitDate" id="limitDate"/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="causeLimitDate">Motivo de Modificación</label>
                            <textarea class="form-control" name="causeLimitDate"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAmpliarPlazo" onclick="ampliarPlazo();">Aceptar</button>
                <button type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>