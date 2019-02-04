<!-- JAVA SCRIPT -->
<!-- Bootstrap -->
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- Jquery-ui javaScript -->
<script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- X-Editable Field -->
<script src="{{ asset('/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/x-editable/moment.js') }}" type="text/javascript"></script>
{{--<script src="{{ asset('/plugins/x-editable/bootstrap-datepicker.es.js') }}" type="text/javascript"></script>--}}
<!-- InputMask -->
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('/plugins/summernote-master/dist/summernote.min.js') }}" type="text/javascript"></script>
<!-- Custom javaScript -->
<script src="{{ asset('/js/symva.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/teclado.js') }}" type="text/javascript"></script>

<script src="{{ asset('/js/jsApp2.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevMenu2.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevReq2.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevCtz2.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevCdr2.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevOC3.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevOS2.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jsDevRpt2.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#ribbon').ribbon();

        /*$('#enable-btn').click(function() {
            $('#del-table-btn').enable();
            $('#del-page-btn').enable();
            $('#save-btn').enable();
            $('#other-btn-2').enable();

            $('#enable-btn').hide();
            $('#disable-btn').show();
        });
        $('#disable-btn').click(function() {
            $('#del-table-btn').disable();
            $('#del-page-btn').disable();
            $('#save-btn').disable();
            $('#other-btn-2').disable();

            $('#disable-btn').hide();
            $('#enable-btn').show();
        });*/

/*        $('.ribbon-button').click(function() {
            if (this.isEnabled()) {
                alert($(this).attr('id') + ' clicked');
            }
        });*/
    });
</script>