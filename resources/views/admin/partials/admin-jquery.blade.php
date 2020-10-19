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
                priceCore: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                cat_id: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                location_id: {
                    required: true,
                },
                image: {
                    required: true,
                },
                'images[]': {
                    required: true,
                },
                size_id: {
                    required: true,
                },
                color_id: {
                    required: true,
                },
                quantity: {
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
                priceCore: {
                    required: "Vui lòng nhập giá bán",
                },
                category_id: {
                    required: "Vui lòng chọn danh mục",
                },
                cat_id: {
                    required: "Vui lòng chọn danh mục",
                },
                brand_id: {
                    required: "Vui lòng chọn thương hiệu",
                },
                location_id: {
                    required: "Vui lòng chọn vị trí",
                },
                image: {
                    required: "Vui lòng nhập ảnh",
                },
                'images[]': {
                    required: "Vui lòng nhập ảnh",
                },
                size_id: {
                    required: "Vui lòng chọn size",
                },
                color_id: {
                    required: "Vui lòng chọn màu sắc",
                },
                quantity: {
                    required: "Vui lòng chọn số lượng",
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
        });
        $('.textareaDesc').summernote({
            height: 250
        });
        $('.textareaDescProduct').summernote({
            height: 420
        });
        $('.textareaPost').summernote({
            height: 512
        });
    })
</script>
<!-- Page script -->
<script>
    $(function() {
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    })
</script>
<!-- File Manager -->
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.lfm-btn').filemanager('image', {
            'prefix': 'http://localhost/vasbayern/public/laravel-filemanager'
        });
        
        $('.plus-image').on('click', function(e) {
            e.preventDefault();
            var countLfm = parseInt($('.lfm-btn').length);
            var nextLfm = countLfm + 1;
            var html = '';
            var i;
            for (i = 0; i < 100; i++) {
                if ($('#lfm'.nextLfm).length < 1) {
                    html += '<div class="form-group">' +
                        '<label for="image">Ảnh</label>' +
                        '<span class="input-group-btn">' +
                        '<a id="lfm' + nextLfm + '" data-input="thumbnail' + nextLfm + '" data-preview="holder' + nextLfm + '" class="lfm-btn btn">' +
                        '<button type="button" class="btn btn-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>' +
                        '</a>' +
                        '<a class="remove-image">' +
                        '<button type="button" class="btn btn-danger"><i class="fas fa-trash-alt" style="margin-right:10px"></i>Xóa</button>' +
                        '</a>' +
                        '</span>' +
                        '<input id="thumbnail' + nextLfm + '" type="text" name="images[]" value="" class="form-control" id="focusedinput">' +
                        '<img id="holder' + nextLfm + '" style="max-height:100px;">' +
                        '</div>';
                    break;
                } else {
                    next++;
                }
            }
            var box = $(this).closest('.form-group');
            $(html).insertBefore(box);
            $('.lfm-btn').filemanager('image', {
                'prefix': 'http://localhost/vasbayern/public/laravel-filemanager'
            });
        })
        $(document).on('click', '.remove-image', function(e) {
            e.preventDefault();
            $(this).closest('.form-group').remove();
        })
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