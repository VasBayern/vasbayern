@extends('admin.layouts.app')
@section('title')
Sửa sản phẩm
@endsection
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Sửa</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ url('admin/product/'.$product->slug) }}" method="post" enctype="multipart/form-data" id="quickForm">
        @method('PUT')
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
                        @if ($errors->any())
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul style="margin-bottom:0px">
                                    @foreach ($errors->all() as $error)
                                    <li style="list-style: none">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
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
                        <div class="form-group">
                            <label for="new">Trạng thái</label>
                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            <label class="radio-inline">
                                <input name="new" value="1" <?php echo ($product->new == 1) ? 'checked' : '' ?> type="radio">Mới
                            </label>
                            <label class="radio-inline">
                                <input name="new" value="2" <?php echo ($product->new == 2) ? 'checked' : '' ?> type="radio">Cũ
                            </label>
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
                                <textarea class="textareaIntro" name="intro" id="intro" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
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
                                    <th>Số Lượng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($product->product_properties as $productProperty)
                                <tr>
                                    <th scope="row">{{ $stt }}</th>
                                    <td>{{ $productProperty->size->name }}</td>
                                    <td>{{ $productProperty->quantity }}</td>
                                    <td>
                                        <a href="#myModal" class="btn btn-primary" title="Sửa" data-toggle="modal" data-target="#modal-default-{{ $productProperty->id }}"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#myModal{{$productProperty->id}}" class="btn btn-danger" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                                @endforeach
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
                <a href="{{ route('admin.product') }}" class="btn btn-secondary">Hủy</a>
                <input type="submit" value="Thêm" class="btn btn-success">
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@foreach($product->product_properties as $productProperty)
<!-- Modal Edit -->
<div class="modal fade" id="modal-default-{{ $productProperty->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('product/'.$product->id.'/properties/'.$productProperty->id) }}" method="post" enctype="multipart/form-data" id="quickForm">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Sửa size {{ $productProperty->size->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul style="margin-bottom:0px">
                                @foreach ($errors->all() as $error)
                                <li style="list-style: none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Size</label>
                            <select name="name" class="form-control custom-select">
                                @foreach($product->product_properties as $productProperty)
                                <option value="0">{{ $productProperty->size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="quantity">Số Lượng</label>
                            <input type="text" name="quantity" value="{{ $productProperty->quantity }}" class="form-control" id="quantity" placeholder="Vui lòng nhập số lượng" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Delete -->
<div id="myModal{{$productProperty->id}}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-exclamation"></i>
                </div>
                <h4 class="modal-title w-100">Bạn có muốn xóa?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Lưu ý : Hành động này không thể hoàn tác</p>
            </div>
            <div class="modal-footer justify-content-center">
                <form name="brand" action="{{ url('product/'.$product->id.'/properties/'.$productProperty->id) }}" method="post" class="form-horizontal">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
<!-- Jquery -->
@include('admin.partials.admin-jquery');