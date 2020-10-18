@extends('admin.layouts.app')
@section('title')
Đơn hàng
@endsection

@section('content')
<style type="text/css">
    .form-group {
        margin-bottom: 0;
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
                                <?php $stt = 1; ?>
                                @foreach($orders as $order)
                                <?php
                                $user = App\Models\User::find($order->user_id);
                                ?>
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->note }}</td>
                                <td>{{ number_format($order->promotion) }} vnđ</td>
                                <td style="font-weight: bold; font-size:18px">{{ number_format($order->total) }} vnđ</td>
                                <?php
                                switch ($order->status) {
                                    case 2:
                                        echo '<td style="font-weight: 700; color: #337AB7">Đã giao hàng</td>';
                                        break;
                                    case 3:
                                        echo '<td style="font-weight: 700; color: #4CAF50">Thành công</td>';
                                        break;
                                    case 0:
                                        echo '<td style="font-weight: 700; color: #D9534F">Đã hủy</td>';
                                        break;
                                    default:
                                        echo '<td style="font-weight: 700;">Chờ xác nhận</td>';
                                }
                                ?>
                                <td>
                                    <a href="#myModal" class="btn btn-success btn-action view-detail" data-toggle="modal" data-target="#modal-lg" data-view="{{$order->id}}" title="Xem chi tiết"> <i class="fas fa-eye" style="width:15px"></i></a>
                                    <a href="#myModal{{$order->id}}" class="btn btn-danger btn-action" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal View -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form action="{{ url('admin/orders/'.$order->id) }}" method="post">
            @csrf
            @method('PUT')
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
                                    <option value="0" data-id="1" id="sm0">-- Chọn --</option>
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
                    <button type="submit" class="btn btn-primary updateOrder" data-orderId="">Cập nhật</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@foreach($orders as $order)
<!-- Modal Delete -->
<div id="myModal{{$order->id}}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-exclamation"></i>
                </div>
                <h4 class="modal-title w-100">Bạn có muốn xóa? </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Lưu ý : Hành động này không thể hoàn tác</p>
            </div>
            <div class="modal-footer justify-content-center">
                <form name="brand" action="{{ url('admin/orders/'.$order->id) }}" method="post" class="form-horizontal">
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
@include('admin.partials.index-jquery');
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#chevron').on('click', function(e) {
            $('tbody#orderProduct').toggle();
            $(this).toggleClass('fa-chevron-up fa-chevron-down');
        })
    });

    $(document).ready(function() {
        $('.view-detail').on('click', function(e) {
            e.preventDefault();
            id = $(this).attr('data-view');
            var viewDetailUrl = '<?php echo url("admin/orders/view") ?>';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: viewDetailUrl,
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
            }).done(function(response) {
                let i;
                let j;
                let html = '';
                let order = response.order;
                for (i = 0; i < order.length; i++) {
                    $('.order_id').html('#' + order[i].order_id);
                    $('.updateOrder').attr('data-orderId', order[i].order_id);
                    $('#email').val(order[i].email);
                    $('#name').val(order[i].name);
                    $('#phone').val(order[i].phone);
                    $('#address').val(order[i].address);
                    $('#sub_total').val(order[i].sub_total);
                    $('#promotion').val(order[i].promotion);
                    $('#total').val(order[i].total);
                    $('#payment_method').val(order[i].payment_method);
                    $('#shipment').val(order[i].shipment);

                    $("#stt" + order[i].status).attr('selected', 'selected');
                    if (order[i].status == 2) {
                        $('#stt1').attr('disabled', 'disabled');
                    } else if (order[i].status == 3 || order[i].status == 0) {
                        $('#status').attr('disabled', 'disabled');
                        $('.updateOrder').attr('disabled', true);
                        $('#stt3').html("Thành công");
                        $('#stt0').html("Đã hủy");
                    }
                    if (order[i].status != 1) {
                        $('#shipment').attr('disabled', 'disabled');
                    }

                    for (j = 0; j < order[i].orderDetails.length; j++) {

                        html += '<tr>' +
                            '<th scope="row">' + order[i].orderDetails[j].product.id + '</th>' +
                            '<input type="hidden" name="product_id[]" value="' + order[i].orderDetails[j].product.id + '">' +
                            '<input type="hidden" name="size_id[]" value="' + order[i].orderDetails[j].size.id + '">' +
                            '<input type="hidden" name="quantity[]" value="' + order[i].orderDetails[j].quantity + '">' +
                            '<input type="hidden" name="email" value="' + order[i].email + '">' +
                            '<td class="imgProduct"></td>' +
                            '<td>' + order[i].orderDetails[j].product.name + '</td>' +
                            '<td>' + order[i].orderDetails[j].size.name + '</td>' +
                            '<td>' + order[i].orderDetails[j].unit_price + '</td>' +
                            '<td>' + order[i].orderDetails[j].quantity + '</td>' +
                            '<td>' + order[i].orderDetails[j].total_price + '</td>' +
                            '</tr>';
                    }
                    $("imgProduct").css("background-image",
                        '{{ URL::asset(' / images / flags / ') }}' + $("select#lang").val() + '.png)');

                    //         var imageUrl = '{{ asset("'+ order[i].orderDetail.product.image +'")}}';
                    // console.log(imageUrl);
                }
                $('#orderProduct').html(html);
            });
        })
    })
</script>