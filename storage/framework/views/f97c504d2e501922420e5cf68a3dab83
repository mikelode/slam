<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="addProductModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">NUEVO PRODUCTO</div>
            <div class="modal-body" style="overflow: hidden">
                <div class="col-md-12">
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="updtGi">Código</label>
                        <input class="form-control alm-input" type="text" id="add-neaProd" disabled/>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="updtGi">Producto</label>
                        <input class="form-control alm-input" type="text" id="add-neaDesc"/>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="updtGi">Marca</label>
                        <input class="form-control alm-input" type="text" id="add-neaMarca"/>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="updtGi">Cantidad</label>
                        <input class="form-control alm-input" type="text" id="add-neaCant" style="width: 135px;"/>
                        <input class="form-control alm-input" type="text" id="add-neaUnd" style="width: 100px;" disabled/>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="updtGi">Precio</label>
                        <input class="form-control alm-input" type="text" id="add-neaPrecio"/>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="updtGi">Costo</label>
                        <input class="form-control alm-input" type="text" id="add-neaCosto"/>
                    </div>
                    <div class="form-group alm-form-group">
                        <label class="control-label" for="causeLimitDate">Observación</label>
                        <textarea class="form-control" id="add-neaComment"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnAddProduct" >Agregar</button>
                <button>Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#btnAddProduct').click(function(e){
    e.preventDefault();
    var prod = $('#add-neaProd').val();
    $('#neaProd').val(prod);
    $('#addProductModal').modal('hide');
});
</script>