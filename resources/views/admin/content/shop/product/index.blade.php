@extends('admin.layouts.app')
@section('title')
Sản phẩm
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Sản phẩm</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-1">
                            <a href="{{ url('admin/products') }}"><button type="button" class="btn btn-primary">Thêm</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Tên SP</th>
                                    <th>Danh mục</th>
                                    <th>Ảnh</th>
                                    <th>Giá Bán</th>
                                    <th>Giá K.M</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($products as $product)
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <?php
                                    $item = DB::table('shop_categories')->where("id", $product->cat_id)->first();
                                    echo $item->name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $images = isset($product->images) ? json_decode($product->images) : array();
                                    ?>
                                    @if(!empty($images))
                                    @foreach($images as $image)
                                    <img src="{{ asset($image) }}" style="margin-top:10px;max-width:150px;">
                                    @break
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{ number_format($product->priceCore) }} VNĐ</td>
                                <td>{{ number_format($product->priceSale) }} VNĐ</td>
                                <td>
                                    @if($product->homepage == 1)
                                    <i class="far fa-check-square" style="color: #007BFF;"></i>
                                    @else
                                    <i class="far fa-window-close" style="color: #ff0a0a;"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="#myModal" class="btn btn-success btn-action view-properties" data-toggle="modal" data-target="#modal-default" data-view="{{$product->id}}" title="Xem chi tiết"> <i class="fas fa-eye"></i></a>
                                    <a href="{{ url('admin/products/'.$product->slug) }}" class="btn btn-action btn-primary" title="Sửa"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#myModal{{$product->id}}" class="btn btn-action btn-danger" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Modal HTML -->
@foreach($products as $product)
<!-- Modal Delete -->
<div id="myModal{{$product->slug}}" class="modal fade">
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
                <form name="product" action="{{ url('admin/products/'.$product->slug) }}" method="post" class="form-horizontal">
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
<!-- Modal View Property -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Size</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Sửa</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

<!-- Jquery -->
@include('admin.partials.index-jquery');