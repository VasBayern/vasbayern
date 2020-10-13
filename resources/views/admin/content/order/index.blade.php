@extends('admin.layouts.app')
@section('title')
Đơn hàng
@endsection

@section('content')

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
                                <td>{{ number_format($order->total) }} vnđ</td>
                                <?php
                                switch ($order->status) {
                                    case 2:
                                        echo '<td style="font-weight: 700; color: #4CAF50">Đã giao hàng</td>';
                                        break;
                                    case 3:
                                        echo '<td style="font-weight: 700; color: #337AB7">Thành công</td>';
                                        break;
                                    case 4:
                                        echo '<td style="font-weight: 700; color: #D9534F">Đã hủy</td>';
                                        break;
                                    default:
                                        echo '<td style="font-weight: 700;">Chờ xác nhận</td>';
                                }
                                ?>
                                <td>
                                    <!-- <a href="#" data-id="{{ $order->id }}" class="btn btn-primary view-detail" data-toggle="modal" data-target=".bd-example-modal-lg" title="Xem"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                                        Launch Large Modal
                                    </button> -->
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
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Chi tiết đơn hàng</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="orderProduct">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="button" class="btn btn-primary">Cập nhật</button>
            </div>
          </div>
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
    //modal detail
    $(document).ready(function() {
        $('.updateOrder').on('click', function() {

            let id = $(this).attr('data-orderId');
            let urlUpdate = '<?php echo url('admin/order/update') ?>';
            let shipment = $('#shipment').find(':selected').attr('data-id');
            let status = $('#status').find(':selected').attr('data-id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlUpdate,
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    shipment: shipment,
                    status: status
                }
            }).done(function(response) {
                window.location.reload();
                toastr.success('Cập nhật đơn hàng thành công');
            })
        })


    });
    $(document).ready(function() {
        $('.view-detail').on('click', function(e) {
            e.preventDefault();
            id = $(this).attr('data-view');
            var viewDetailUrl = '<?php echo url("admin/orders/view") ?>';
            console.log(viewDetailUrl);
            console.log(id);
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
                $('#orderProduct').html(response.html);
                // let i;
                // let order = response.order;
                // let html = '';

                // for (i = 0; i < order.length; i++) {
                //     $('.order_id').html(order[i].order_id);
                //     $('.updateOrder').attr('data-orderId', order[i].order_id);
                //     $('#email').val(order[i].email);
                //     $('#name').val(order[i].user_name);
                //     $('#phone').val(order[i].phone);
                //     $('#address').val(order[i].address);
                //     $('#sub_total').val(order[i].sub_total);
                //     $('#promotion').val(order[i].promotion);
                //     $('#total').val(order[i].total);
                //     $('#payment_method').val(order[i].payment_method);

                //     $("#stt" + order[i].status).attr('selected', 'selected');
                //     if (order[i].status == 1) {
                //         $('#stt0').attr('disabled', 'disabled');
                //     } else if (order[i].status == 2 || order[i].status == 3) {
                //         $('#status').attr('disabled', 'disabled');
                //         $('.updateOrder').attr('disabled', true);
                //         $('#stt2').html("Thành công");
                //         $('#stt3').html("Đã hủy");
                //     }
                //     if (order[i].status != 0) {
                //         $('#shipment').attr('disabled', 'disabled');
                //     }

                //     html += '<tr>' +
                //         '<th scope="row">' + i + '</th>' +
                //         '<td><img src="" style="margin-top:10px;max-height:150px;">ABC</td>' +
                //         '<td>' + order[i]['orderDetail']['product']['product_name'] + '</td>' +
                //         '<td>' + order[i]['orderDetail']['product']['quantity'] + '</td>' +
                //         '<td>' + order[i]['orderDetail']['product']['unit_price'] + '</td>' +
                //         '<td>' + order[i]['orderDetail']['product']['total_price'] + '</td>' +
                //         '</tr>';
                //     //         var imageUrl = '{{ asset("'+ order[i].orderDetail.product.image +'")}}';
                //     // console.log(imageUrl);
                // }
                // $('#orderProduct').html(html);
            });
        })
    })
</script>