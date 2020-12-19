@extends('admin.layouts.app')
@section('title')
Thêm sản phẩm
@endsection
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin_assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thêm sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Thêm</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form id="quickForm">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Sản phẩm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control custom-select" name="cat_id">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category_parent)
                                <option value="{{ $category_parent['id'] }}">{{ str_repeat('-', $category_parent['level'] - 1) . ' ' . $category_parent['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thương hiệu</label>
                            <select class="form-control custom-select" name="brand_id">
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priceCore">Giá bán</label>
                            <input type="text" name="priceCore" value="{{ old('priceCore') }}" class="form-control" id="priceCore" placeholder="Default Input" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                        <div class="form-group">
                            <label for="priceSale">Giá Khuyến mãi</label>
                            <input type="text" name="priceSale" value="{{ old('priceSale') }}" class="form-control" id="priceSale" placeholder="Default Input" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> </div>
                        <div class="form-group">
                            <label for="homepage">Homepage</label>
                            <select name="homepage" class="form-control custom-select">
                                <option value="0">Không</option>
                                <option value="1">Có</option>
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <label for="homepage">Trạng thái</label>
                            <div style="display:block">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="new" value="1" id="radioPrimary1" checked>Mới
                                    <label for="radioPrimary1">
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="new" value="2">Cũ
                                    <label for="radioPrimary2">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Thẻ</label>
                            <select class="select2" multiple="multiple" data-placeholder="Chọn thẻ" style="width: 100%;" name="tag[]">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->slug }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh</label>
                            <span class="input-group-btn">
                                <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="lfm-btn btn">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>
                                </a>
                                <a class="remove-image">
                                    <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt" style="margin-right:10px"></i>Xóa</button>
                                </a>
                            </span>
                            <input id="thumbnail1" type="text" name="images[]" value="{{ old('images') }}" class="form-control" id="focusedinput">
                            <img id="holder1" style="max-height:100px;">
                        </div>
                        <div class="form-group">
                            <label>Thêm ảnh</label>
                            <div>
                                <a class="plus-image">
                                    <button type="button" class="btn btn-success"><i class="fas fa-plus" style="margin-right:10px"></i>Thêm</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Mô tả</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="intro">Mô tả</label>
                            <div class="mb-3">
                                <textarea class="textarea" name="intro" id="intro" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">Chi tiết</label>
                            <div class="mb-3">
                                <textarea class="textareaDescProduct" name="desc" id="desc" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.products') }}" class="btn btn-secondary">Hủy</a>
                <input type="submit" value="Thêm" class="btn btn-success store-item" href="{{ url('api/admin/products') }}">
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@endsection
<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/common/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/common/api.js')}}"></script>
<script defer src="{{asset('api/admin/product.js')}}"></script>
@endsection
@include('admin.partials.admin-jquery');