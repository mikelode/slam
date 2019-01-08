<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="printPdfModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">SELECCION DEL DOCUMENTO</div>
            <div class="modal-body" style="overflow: hidden">
                <div class="col-md-12">
                    <form class="form-horizontal" id="frm-print-pdf" action="">
                        {!! csrf_field() !!}
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="printGi">Guia de Internamiento:</label>
                            <input class="form-control alm-input" type="text" name="printGi" id="printGi" readonly/>
                        </div>
                        <div class="form-group alm-form-group">
                            <label class="control-label" for="printPi">Procesos de Internamiento</label>
                            <div id="select-cpi"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="btnPrintPdf" value="Imprimir">
                <button type="button" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#btnPrintPdf').click(function(e){
    e.preventDefault();
    var gi = $('#printGi').val();
    var pi = $('#printPi').val();
    var url = 'pdfGi/' + gi + '/' + pi;
    window.open(url,"popupWindow", "width=800, height=400, scrollbars=yes, location=no");
});

$('#select-cpi').on('click','#btnPreviewActa',function(e){
    e.preventDefault();
    var url = $(this).attr('href');

    $('#printPdfModal').modal('hide');
    window.open(url,"popupWindow", "width=800, height=600, scrollbars=yes, location=no");
});

</script>