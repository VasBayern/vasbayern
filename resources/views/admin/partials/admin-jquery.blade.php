<!-- jQuery -->
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('admin_assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    })
</script>
<!-- jquery-validation -->
<script src="{{asset('admin_assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- File Manager -->
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
<!-- getSlug -->
<script>
    $(document).ready(function() {
        $(document).on('change', '#name', function(e) {
            var name = $(this).val();
            var url = '<?php echo route('admin.getSlugs') ?>';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                data: {
                    name: name
                }
            }).done(function(response) {
                $('#slug').val(response.slug);
            })
        });
    });
</script>