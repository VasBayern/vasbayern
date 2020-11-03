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
                pecent_off: {
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
                pecent_off: {
                    required: "Vui lòng nhập % giảm giá",
                },
                color: {
                    required: "Vui lòng nhập màu",
                },
                shipment: {
                    required: "Vui lòng chọn đơn vị vận chuyển",
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
                
            }
        });

    });
</script>
<!-- getSlug -->
<script>
    $(document).ready(function() {
        $('#name').on('change', function(e) {
            var name = $(this).val();
            var url = '<?php echo route('admin.getSlugs') ?>';
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