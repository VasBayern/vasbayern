@extends('frontend.layouts.shop')
@section('title')
Địa chỉ giao hàng
@endsection
@section('content')
<style type="text/css">
    .info {
        height: 180px;
        margin-bottom: 30px;
        margin-right: 70px;
        background: #F8F8F8;
    }

    .info-default {
        border: 1px dashed #8FC050;
    }

    .col-form-label {
        font-weight: bold;
        font-size: 14px;
    }

    .address-info p {
        margin-bottom: 0;
        font-size: 14px;
    }

    .address-info .add-address {
        color: #007bff;
        font-size: 16px;
        margin-left: 10px;
    }

    .address-info .edit-address,
    .delete-address {
        border-radius: 2px;
        padding: 7px;
        border: 1px solid;
        border-color: rgb(204, 204, 204);
        color: #333333;
        background: linear-gradient(rgb(255, 255, 255), rgb(247, 247, 247));
    }

    .address-info .edit-address:hover {
        color: #333333;
    }

    .address-info .delete-address:hover {
        color: #333333;
    }

    span.default {
        font-size: 16px;
        font-weight: 700;
        float: right;
        color: #F8F8F8;
    }

    #defaultAddress {
        color: #8FC050;
    }
</style>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span> Địa chỉ giao hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<section class="spad">
    @if(Auth::check() && !empty(Auth::user()->email_verified_at))
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="filter-widget">
                    <h4 class="fw-title">Tài khoản</h4>
                    <ul class="filter-catagories">
                        <li><a href="{{ route('user.profile') }}">Thông tin tài khoản</a></li>
                        <li><a href="{{ route('user.address') }}" style="color: #e7ab3c">Địa chỉ giao hàng</a></li>
                        <li><a href="{{ route('user.order') }}">Lịch sử mua hàng</a></li>
                        <li><a href="{{ route('wishlist') }}">Sản phẩm yêu thích</a></li>
                    </ul>
                </div>
            </div>
            <div class='col-lg-9 order-1 order-lg-2'>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="list-style: none">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="filter-widget" style="margin-bottom: 0;">
                    <h4 class="fw-title">Địa chỉ giao hàng</h4>
                </div>
                <div>
                    <div class="form-group row address-info">
                        @foreach($customers as $customer)
                        <?php
                        // $selected = ($customer->default == 1) ? 'info-default' : 'border';
                        ?>
                        <div class="col-lg-5 info border">
                            <div style="padding: 10px 0 10px 0;">
                                <h5 style="font-weight:700; margin-bottom: 10px;" id="customerName{{$customer->id}}">{{ $customer ->name }}
                                    <span class="default defaultCustomer{{$customer->id}}" id="{{ ($customer->default == 1) ? 'defaultAddress' : '' }}">Mặc định</span>
                                </h5>
                                <p id="customerAddress{{$customer->id}}">Địa chỉ: {{ $customer->address }}, {{ $customer->ward }}, {{ $customer->district }}, {{ $customer->city }}</p>
                                <p id="customerPhone{{$customer->id}}">Điện thoại: {{ $customer->phone }}</p>
                                <div style="margin-top: 15px;">
                                    <a class="edit-address" data-toggle="modal" href="#myModalEdit" data-id="{{ $customer->id }}" data-target=".bd-example-modal-lg-edit">Sửa</a>
                                    <a href="#myModalDelete{{$customer->id}}" class="delete-address" data-toggle="modal">Xóa</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row form-group address-info">
                        <p style="margin-left: 15px;">Bạn muốn giao hàng đến địa chỉ mới? </p>
                        <span>
                            <p class="add-address" style="cursor: pointer" data-toggle="modal" href="#myModalAdd" data-target=".bd-example-modal-lg-add"> Thêm địa chỉ giao hàng</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
<!-- Modal Add-->
<div id="myModalAdd" class="modal fade bd-example-modal-lg-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('user/address/') }}" method='post'>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Thêm địa chỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label">Họ tên</label>
                            <div class="col-lg-8">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Nhập họ tên người nhận" required>
                                <!--  oninvalid="this.setCustomValidity('Vui lòng nhập')" oninput="setCustomValidity('')" -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-lg-3 col-form-label">SĐT</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Nhập số điện thoại" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-lg-3 col-form-label">Tỉnh / Thành Phố</label>
                            <div class="col-lg-8">
                                <input type="text" name="city" value="{{ old('city') }}" class="form-control" id="city" placeholder="Ví dụ: Hà Nội" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-lg-3 col-form-label">Quận / Huyện</label>
                            <div class="col-lg-8">
                                <input type="text" name="district" value="{{ old('district') }}" class="form-control" id="district" placeholder="Ví dụ: Cầu Giấy" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ward" class="col-lg-3 col-form-label">Xã / Phường / Thị trấn</label>
                            <div class="col-lg-8">
                                <input type="text" name="ward" value="{{ old('ward') }}" class="form-control" id="ward" placeholder="Ví dụ: Yên Hòa" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-lg-3 col-form-label">Địa chỉ</label>
                            <div class="col-lg-8">
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address" placeholder="Ví dụ: 445 Nguyễn Khang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-lg-3 col-form-label">Ghi chú</label>
                            <div class="col-lg-8">
                                <textarea name="note" id="note" cols="50" rows="4" class="form-control" placeholder="Nhập ghi chú ..."></textarea>{{ old('note') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-8 ">
                                <input type="checkbox" name="check">
                                <span style="margin-left: 10px;">Sử dụng địa chỉ này làm mặc định</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="addAddressModal">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div id="myModalEdit" class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('user/address/customer/edit') }}" method='post'>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Sửa người nhận </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label">Họ tên</label>
                            <div class="col-lg-8">
                                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" id="editName" placeholder="Nhập họ tên người nhận" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-lg-3 col-form-label">SĐT</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control" id="editPhone" placeholder="Nhập số điện thoại" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-lg-3 col-form-label">Tỉnh / Thành Phố</label>
                            <div class="col-lg-8">
                                <input type="text" name="city" value="{{ $customer->city }}" class="form-control" id="editCity" placeholder="Ví dụ: Hà Nội" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-lg-3 col-form-label">Quận / Huyện</label>
                            <div class="col-lg-8">
                                <input type="text" name="district" value="{{ $customer->district }}" class="form-control" id="editDistrict" placeholder="Ví dụ: Cầu Giấy" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ward" class="col-lg-3 col-form-label">Xã / Phường / Thị trấn</label>
                            <div class="col-lg-8">
                                <input type="text" name="ward" value="{{ $customer->ward }}" class="form-control" id="editWard" placeholder="Ví dụ: Yên Hòa" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-lg-3 col-form-label">Địa chỉ</label>
                            <div class="col-lg-8">
                                <input type="text" name="address" value="{{ $customer->address }}" class="form-control" id="editAddress" placeholder="Ví dụ: 445 Nguyễn Khang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-lg-3 col-form-label">Ghi chú</label>
                            <div class="col-lg-8">
                                <textarea name="note" id="editNote" cols="50" rows="4" class="form-control" placeholder="Nhập ghi chú ..."></textarea>{{ $customer->note }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-8 ">
                                <input type="checkbox" class="chkBox" id="chkBox" name="check" <?php if ($customer->default == 1) {
                                                                                                    echo 'checked';
                                                                                                } ?>>
                                <span style="margin-left: 10px;">Sử dụng địa chỉ này làm mặc định</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="editId" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" data-button="{{$customer->id}}" class="btn btn-primary" id="editAddressModal">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($customers as $customer)
<!-- Modal Delete -->
<div id="myModalDelete{{$customer->id}}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="modal-title w-100">Bạn có muốn xóa?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p>Lưu ý : Hành động này không thể hoàn tác</p>
            </div>
            <div class="modal-footer justify-content-center">
                @if(isset($customer->id))
                <form name="" action="{{ url('user/address/customer/'.$customer->id.'/delete') }}" method="post" class="form-horizontal">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
        //add-address
        // $('#addAddressModal').on('click', function(e) {
        //     e.preventDefault();
        //     var dataPost = $(this).closest('form').serializeArray();
        //     var urlAddAddress = '<?php echo url('user/address/address'); ?>';

        //     $.ajax({
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         url: urlAddAddress,
        //         dataType: 'json',
        //         type: 'post',
        //         data : dataPost
        //     }).done(function(response){
        //         console.log(response)
        //         if(response.msg === 'success') {
        //            toastr.success('Thêm thành công');
        //            $('.modal').modal('hide');
        //            if(response.default == 1) {
        //                $('.default').html('');
        //            }
        //        } else {
        //            toastr.error('Vui lòng thử lại sau','Có lỗi xảy ra');
        //        }
        //     })
        // }) 
        //show-modal-edit
        $('.edit-address').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var urlEditModal = '<?php echo url('user/address/editModal') ?>';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlEditModal,
                dataType: 'json',
                type: 'post',
                data: {
                    id: id
                }

            }).done(function(response) {
                $('#editId').val(response.id)
                $('#editName').val(response.name);
                $('#editPhone').val(response.phone);
                $('#editCity').val(response.city);
                $('#editDistrict').val(response.district);
                $('#editWard').val(response.ward);
                $('#editAddress').val(response.address);
                $('#editNote').html(response.note);
                $('.chkBox').prop('checked', response.default == 1);
            });
        });
        //edit-address
        // $('#editAddressModal').on('click', function(e){
        //     e.preventDefault();
        //     var dataPost = $(this).closest('form').serializeArray();
        //     var urlEditAddress = '<?php echo url('user/address/customer/edit'); ?>';

        //     $.ajax({
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         url: urlEditAddress,
        //         dataType: 'json',
        //         type: 'post',
        //         data : dataPost
        //     }).done(function(response){
        //         if(response.msg === 'success') {
        //            toastr.success('Sửa thành công');
        //            $("#customerName"+response.id).html(response.name);
        //            $("#customerPhone"+response.id).html('Điện thoại: ' +response.phone);
        //            $("#customerAddress"+response.id).html('Địa chỉ: ' +response.address);
        //            $('.modal').modal('hide');
        //            if(response.default == 1) {
        //                 $('.default').css({'color' : '#F8F8F8'});
        //                 $('.customerName'+response.id).html('<span>Mặc định</span>');
        //            }
        //        } else {
        //            toastr.error('Vui lòng thử lại sau','Có lỗi xảy ra');
        //        }
        //     })
        // })
    })
</script>
@endsection