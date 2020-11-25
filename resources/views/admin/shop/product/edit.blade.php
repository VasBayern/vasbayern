@extends('admin.layouts.app')
@section('title')
Sửa sản phẩm
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
                <h1>Sửa sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Sửa</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form id="quickFormEdit">
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
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ $product->slug }}" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control custom-select" name="cat_id">
                                @foreach($category_parents as $category_parent)
                                <?php $selected = ($category_parent['id'] == $product->cat_id) ? ' selected' : ' ' ?>
                                <option value="{{ $category_parent['id'] }}" {{ $selected }}>{{ str_repeat('-', $category_parent['level'] - 1) . ' ' . $category_parent['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thương hiệu</label>
                            <select class="form-control custom-select" name="brand_id">
                                @foreach($brands as $brand)
                                <?php $selected = ($brand['id'] == $product->brand_id) ? ' selected' : ' ' ?>
                                <option value="{{ $brand['id'] }}" {{ $selected }}>{{ $brand['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priceCore">Giá bán</label>
                            <input type="text" name="priceCore" value="{{ $product->priceCore }}" class="form-control" id="priceCore" placeholder="Default Input" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                        <div class="form-group">
                            <label for="priceSale">Giá Khuyến mãi</label>
                            <input type="text" name="priceSale" value="{{ $product->priceSale }}" class="form-control" id="priceSale" placeholder="Default Input" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> </div>
                        <div class="form-group">
                            <label for="homepage">Homepage</label>
                            <select name="homepage" class="form-control custom-select">
                                <option value="0" <?php echo ($product->homepage == 0) ? 'selected' : '' ?>>Không hiển thị</option>
                                <option value="1" <?php echo ($product->homepage == 1) ? 'selected' : '' ?>>Hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <label for="homepage">Trạng thái</label>
                            <div style="display:block">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="new" value="1" id="radioPrimary1" <?php echo ($product->new == 1) ? 'checked' : '' ?>>Mới
                                    <label for="radioPrimary1">
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="new" value="2" <?php echo ($product->new == 2) ? 'checked' : '' ?>>Cũ
                                    <label for="radioPrimary2">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Thẻ</label>
                            <select class="select2" multiple="multiple" data-placeholder="Chọn thẻ" style="width: 100%;" name="tag[]">
                                @foreach($tags as $tag)
                                <?php
                                $selected = in_array($tag->id, $tagProductIDs) ? 'selected' : '';
                                ?>
                                <option value="{{ $tag->id }}" {{ $selected }}>{{ $tag->slug }}</option>
                                @endforeach
                            </select>
                        </div>
                        <?php
                        $images = $product->images ? json_decode($product->images) : array();
                        $i = 0;
                        ?>
                        @foreach($images as $image)
                        <?php $i++ ?>
                        <div class="form-group">
                            <label for="image">Ảnh</label>
                            <span class="input-group-btn">
                                <a id="lfm{{ $i }}" data-input="thumbnail{{ $i }}" data-preview="holder{{ $i }}" class="lfm-btn btn">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>
                                </a>
                                <a class="remove-image">
                                    <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt" style="margin-right:10px"></i>Xóa</button>
                                </a>
                            </span>
                            <input id="thumbnail{{ $i }}" type="text" name="images[]" value="{{ $image }}" class="form-control" id="focusedinput">
                            <img id="holder{{ $i }}" src="{{ asset($image) }}" style="max-height:100px;">
                        </div>
                        @endforeach
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
                                <textarea class="textarea" name="intro" id="intro" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{ $product->intro }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">Chi tiết</label>
                            <div class="mb-3">
                                <textarea class="textareaDescProduct" name="desc" id="desc" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{ $product->desc }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- Product properties -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Size</th>
                                    <th>Màu sắc</th>
                                    <th>Số Lượng</th>
                                    <th> <a href="#myModal" class="btn btn-success" title="Thêm" data-toggle="modal" data-target="#modal-default-add"><i class="fas fa-plus"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($product->product_properties))
                                @foreach($product->product_properties as $productProperty)
                                <tr class="tr-{{ $productProperty->id }}">
                                    <th scope="row">{{ $productProperty->id }}</th>
                                    <td>{{ $productProperty->size->name }}</td>
                                    <td>
                                        <p style="width: 30px; height: 30px; margin: 0 auto; background-color:{{ $productProperty->color->color }}; border:1px solid #ebebeb; "></p>
                                    </td>
                                    <td>{{ $productProperty->quantity }}</td>
                                    <td>
                                        <a href="{{ url('api/admin/properties/'.$productProperty->id) }}" class="btn btn-primary edit-modal" data-quantity="{{ $productProperty->quantity }}" data-size="{{ $productProperty->size->name }}" data-color="{{ $productProperty->color->name }}" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('api/admin/properties/'.$productProperty->id) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.products') }}" class="btn btn-secondary">Hủy</a>
                <input type="submit" value="Sửa" class="btn btn-success update-item" href="{{ url('api/admin/products/'.$product->slug) }}">
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
<!-- Modal Add -->
<div class="modal fade" id="modal-default-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="quickForm">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Size</label>
                            <select name="size_id" class="form-control custom-select" id="size_id">
                                <option value="">-- Chọn size --</option>
                                @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="color_id">Màu</label>
                            <select name="color_id" class="form-control custom-select" id="color_id">
                                <option value="">-- Chọn màu --</option>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="quantity">Số Lượng</label>
                            <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Vui lòng nhập số lượng" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <input type="submit" value="Lưu" class="btn btn-primary store-item" href="{{ url('api/admin/properties') }}">
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Edit -->
<div class="modal fade" id="modal-default-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="quickFormEdit">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Size</label>
                            <input type="text" name="size_id" value="" class="form-control" id="size" disabled>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="color">Màu</label>
                            <input type="text" name="color_id" value="" class="form-control" id="color" disabled>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="quantity">Số Lượng</label>
                            <input type="text" name="quantity" value="" class="form-control" id="quantity" placeholder="Vui lòng nhập số lượng" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary update-item-property">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/product.js')}}"></script>
<script defer src="{{asset('api/admin/property.js')}}"></script>
@endsection
@include('admin.partials.admin-jquery');