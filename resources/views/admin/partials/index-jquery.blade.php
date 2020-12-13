<!-- jQuery -->
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('admin_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- page script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "pageLength": 25
        });
    });
</script>
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
                value: {
                    required: true,
                },
                percent_off: {
                    required: true,
                },
                code: {
                    required: true,
                },
                color: {
                    required: true,
                },
                shipment: {
                    required: true,
                },
                link: {
                    required: true,
                },
                image: {
                    required: true,
                },
                sort_no: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Vui lòng nhập tên",
                },
                slug: {
                    required: "Vui lòng nhập slug",
                },
                value: {
                    required: "Vui lòng nhập giá tiền",
                },
                code: {
                    required: "Vui lòng nhập mã",
                },
                percent_off: {
                    required: "Vui lòng nhập % giảm giá",
                },
                color: {
                    required: "Vui lòng nhập màu",
                },
                shipment: {
                    required: "Vui lòng chọn đơn vị vận chuyển",
                },
                link: {
                    required: "Vui lòng nhập đường dẫn",
                },
                image: {
                    required: "Vui lòng nhập ảnh",
                },
                sort_no: {
                    required: "Vui lòng nhập thứ tự",
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
            },
            submitHandler: function(form) {
                ajaxCallAddFunction();
            }
        });
        $('#quickFormEdit').validate({
            rules: {
                name: {
                    required: true,
                },
                slug: {
                    required: true,
                },
                value: {
                    required: true,
                },
                percent_off: {
                    required: true,
                },
                code: {
                    required: true,
                },
                color: {
                    required: true,
                },
                shipment: {
                    required: true,
                },
                link: {
                    required: true,
                },
                image: {
                    required: true,
                },
                sort_no: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Vui lòng nhập tên",
                },
                slug: {
                    required: "Vui lòng nhập slug",
                },
                value: {
                    required: "Vui lòng nhập giá tiền",
                },
                code: {
                    required: "Vui lòng nhập mã",
                },
                percent_off: {
                    required: "Vui lòng nhập % giảm giá",
                },
                color: {
                    required: "Vui lòng nhập màu",
                },
                shipment: {
                    required: "Vui lòng chọn đơn vị vận chuyển",
                },
                link: {
                    required: "Vui lòng nhập đường dẫn",
                },
                image: {
                    required: "Vui lòng nhập ảnh",
                },
                sort_no: {
                    required: "Vui lòng nhập thứ tự",
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
            },
            submitHandler: function(form) {
                ajaxCallEditFunction();
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
            height: 100
        });
        $('.textareaDesc').summernote({
            height: 170
        });
        $('.textareaDescProduct').summernote({
            height: 523
        });
        $('.textareaPost').summernote({
            height: 613
        });
    })
</script>
<!-- File Manager -->
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.lfm-btn, .lfm-edit-btn').filemanager('image', {
            'prefix': '/laravel-filemanager'
        });
    });
</script>
<!-- getSlug -->
<script>
    $(document).ready(function() {
        $(document).on('change', '#name', function(e) {
            var name = $(this).val();
            var url = '<?php echo route('admin.getSlugs') ?>';
            var $this = $(this);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                data: {
                    name: name
                }
            }).done(function(response) {
                $this.closest('form').find('#slug').val(response.slug);
            })
        });
    });
</script>