@extends('admin.layouts.app')
@section('title')
Thêm danh mục
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 offset-md-1">
                <h1>Thêm danh mục</h1>
            </div>
            <div class="col-sm-5">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Danh mục</a></li>
                    <li class="breadcrumb-item active">Thêm danh mục</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 offset-md-1">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ url('admin/category') }}" method="post" enctype="multipart/form-data" id="quickForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tên</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="inputName"
                                placeholder="Vui lòng nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug"
                                placeholder="Vui lòng nhập slug">
                        </div>
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select class="form-control custom-select" name="parent_id">
                                <option value="0">Gốc</option>
                                @foreach($parent_categories as $parent_category)
                                <option value="{{ $parent_category['id'] }}">
                                    {{ str_repeat('-', $parent_category['level'] - 1) . ' ' . $parent_category['name'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="homepage">Homepage</label>
                            <select name="homepage" class="form-control custom-select">
                                <option value="0">Không</option>
                                <option value="1">Có</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh</label>
                            <span class="input-group-btn">
                            
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="lfm-btn btn">
                                
                                <button type="button" class="btn btn-block bg-gradient-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>
                            </a>
      
                        
                            </span>
                            <input id="thumbnail" type="text" name="image[]" value="{{ old('image') }}"
                                class="form-control" id="focusedinput">
                            <img id="holder" style="max-height:100px;">
                        </div>
                        <div class="form-group">
                            <label for="intro">Mô tả</label>
                            <div class="mb-3">
                                <textarea class="textarea" id="intro" placeholder="Place some text here"
                                    style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">Chi tiết</label>
                            <div class="mb-3">
                                <textarea class="textarea" id="desc" placeholder="Place some text here"
                                    style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>

                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Porject" class="btn btn-success float-right">
        </div>
    </div>

</section>
<!-- /.content -->
@endsection
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
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                minlength: 8,
                equalTo: '#password'
            },
            terms: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Vui lòng nhập tên",
            },
            email: {
                required: "Vui lòng nhập địa chỉ email",
                email: "Định dạng email không đúng"
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu chứa ít nhất 8 kí tự"
            },
            password_confirmation: {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu chứa ít nhất 8 kí tự",
                equalTo: "Mật khẩu xác thực không trùng khớp",
            },
            terms: "Vui lòng chấp nhận điều khoản"
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
    $('.textarea').summernote()
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