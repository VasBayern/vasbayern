<!-- jQuery -->
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('admin_assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true,
                },
                slug: {
                    required: true,
                },
                link: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Vui lòng nhập tên",
                },
                slug: {
                    required: "Vui lòng nhập slug",
                },
                link: {
                    required: "Vui lòng nhập đường dẫn",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<!-- Summernote -->
<script src="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function() {
        // Summernote
        $('.textarea').summernote({
            height: 150
        })
    })
</script>
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.lfm-btn').filemanager('image', {
            'prefix': '/laravel-filemanager'
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#name').on('change', function(e) {
            var name = $(this).val();
            var url = '<?php echo route('admin.getSlug') ?>';
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    name: name
                }
            }).done(function(response) {
                $('#slug').val(response.slug);
            })
        });
    });
</script>