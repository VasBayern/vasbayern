@extends('admin.layouts.app')
@section('title')
Đơn hàng
@endsection

@section('content')
<style type="text/css">
    .form-group {
        margin-bottom: 0;
    }

    .statusOrder {
        font-weight: 700;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Đơn hàng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đơn hàng</li>
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Email</th>
                                    <th>Tên</th>
                                    <th>SĐT</th>
                                    <th>Địa chỉ</th>
                                    <th>Ghi chú</th>
                                    <th>Giảm giá</th>
                                    <th>Thành tiền</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($orders as $order)
                                <?php
                                $user = App\Models\User::find($order->user_id);
                                ?>
                                <tr class="tr-{{ $order->id }}">
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->note }}</td>
                                    <td>{{ number_format($order->promotion) }} vnđ</td>
                                    <td style="font-weight: bold; font-size:18px">{{ number_format($order->total) }} vnđ</td>
                                    <td class="statusOrder status-{{$order->id}}">
                                        <?php
                                        switch ($order->status) {
                                            case 1:
                                                echo '<p>Chờ xác nhận</p>';
                                                break;
                                            case 2:
                                                echo '<p style="color: #337AB7">Đã giao hàng</p>';
                                                break;
                                            case 3:
                                                echo '<p style="color: #4CAF50">Thành công</p>';
                                                break;
                                            case 0:
                                                echo '<p style="color: #D9534F">Đã hủy</p>';
                                                break;
                                            default:
                                                throw 'Error';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="{{ url('api/admin/orders/'.$order->id) }}" class="btn btn-primary edit-modal" title="Xem chi tiết"> <i class="fas fa-eye" style="width:15px"></i></a>
                                        <a href="{{ url('api/admin/orders/'.$order->id) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
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

<!-- Modal View -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form action="" id="quickFormEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng <b class="order_id"></b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="content-body">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="">Email</label>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" value="" id="email" placeholder="Email" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Họ Tên</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" id="name" placeholder="Tên" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">SĐT</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" id="phone" placeholder="SĐT" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Giá tiền</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" readonly value="" id="sub_total" placeholder="Giá tiền">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Giảm giá</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" readonly id="promotion" placeholder="Giảm giá">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Giá ship</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" id="ship_price" placeholder="Giá Ship" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="">Địa chỉ</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" id="address" placeholder="Địa chỉ" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="">Tổng tiền</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" id="total" placeholder="Thanh toán" readonly>
                            </div>

                        </div>
                        <div class="form-group col-lg-12">
                            <label for="">Ghi chú</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-comment"></i></span>
                                </div>
                                <textarea class="form-control" rows="2" placeholder="Enter ..." disabled=""></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Hình thức thanh toán</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                                </div>
                                <input type="text" class="form-control" value="" id="payment_method" placeholder="Hình thức thanh toán" readonly>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Đơn vị giao hàng</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                </div>
                                <select class="form-control custom-select" id="shipment" name="shipment">
                                    <option value="1" data-id="1" id="sm1">Grab</option>
                                    <option value="2" data-id="2" id="sm2">GHTK</option>
                                    <option value="3" data-id="3" id="sm3">VNPost</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="">Trạng thái đơn hàng</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                                </div>
                                <select class="form-control custom-select" id="status" name="status">
                                    <option value="1" data-id="1" id="stt1">Chờ xác nhận</option>
                                    <option value="2" data-id="2" id="stt2">Đã giao hàng</option>
                                    <option value="3" data-id="3" id="stt3">Đã nhận hàng</option>
                                    <option value="0" data-id="0" id="stt0">Hủy đơn hàng</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead class="thead-light" id="chevron">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Size</th>
                                <th scope="col">Màu</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Giá tiền</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col"><i class="fa fa-chevron-down" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody id="orderProduct">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary update-item">Cập nhật</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/common/api.js')}}"></script></script>
<script defer src="{{asset('api/admin/order.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');