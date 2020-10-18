@extends('frontend.layouts.app')
@section('title')
Địa chỉ giao hàng
@endsection
@section('content')
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
                        <div class="col-lg-5 info" id="{{ ($customer->default == 1) ? 'info-default' : '' }}">
                            <div style="padding: 10px 0 10px 0;">
                                <h5 id="customerName{{$customer->id}}">{{ $customer ->name }}
                                    <span class="default defaultCustomer{{$customer->id}}" id="{{ ($customer->default == 1) ? 'defaultAddress' : '' }}">Mặc định</span>
                                </h5>
                                <p id="customerAddress{{$customer->id}}">Địa chỉ: {{ $customer->address }}, {{ $customer->ward }}, {{ $customer->district }}, {{ $customer->city }}</p>
                                <p id="customerPhone{{$customer->id}}">Điện thoại: {{ $customer->phone }}</p>
                                <div style="margin-top: 15px;">
                                    <a class="edit-address" data-toggle="modal" href="#myModalEdit{{$customer->id}}" data-target=".bd-example-modal-lg-edit{{$customer->id}}">Sửa</a>
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
            <form action="{{ url('user/address') }}" method="post" id="quickForm">
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
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Nhập họ tên người nhận">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-lg-3 col-form-label">SĐT</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Nhập số điện thoại" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-lg-3 col-form-label">Tỉnh / Thành Phố</label>
                            <div class="col-lg-8">
                                <input type="text" name="city" value="{{ old('city') }}" class="form-control" id="city" placeholder="Ví dụ: Hà Nội">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-lg-3 col-form-label">Quận / Huyện</label>
                            <div class="col-lg-8">
                                <input type="text" name="district" value="{{ old('district') }}" class="form-control" id="district" placeholder="Ví dụ: Cầu Giấy">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ward" class="col-lg-3 col-form-label">Xã / Phường / Thị trấn</label>
                            <div class="col-lg-8">
                                <input type="text" name="ward" value="{{ old('ward') }}" class="form-control" id="ward" placeholder="Ví dụ: Yên Hòa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-lg-3 col-form-label">Địa chỉ</label>
                            <div class="col-lg-8">
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address" placeholder="Ví dụ: 445 Nguyễn Khang">
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
@foreach($customers as $customer)
<!-- Modal Edit-->
<div id="myModalEdit{{$customer->id}}" class="modal fade bd-example-modal-lg-edit{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('user/address/'.$customer->id)  }}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Sửa người nhận : {{ $customer->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label">Họ tên</label>
                            <div class="col-lg-8">
                                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" id="name" placeholder="Nhập họ tên người nhận" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-lg-3 col-form-label">SĐT</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control" id="phone" placeholder="Nhập số điện thoại" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-lg-3 col-form-label">Tỉnh / Thành Phố</label>
                            <div class="col-lg-8">
                                <input type="text" name="city" value="{{ $customer->city }}" class="form-control" id="city" placeholder="Ví dụ: Hà Nội">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-lg-3 col-form-label">Quận / Huyện</label>
                            <div class="col-lg-8">
                                <input type="text" name="district" value="{{ $customer->district }}" class="form-control" id="district" placeholder="Ví dụ: Cầu Giấy">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ward" class="col-lg-3 col-form-label">Xã / Phường / Thị trấn</label>
                            <div class="col-lg-8">
                                <input type="text" name="ward" value="{{ $customer->ward }}" class="form-control" id="ward" placeholder="Ví dụ: Yên Hòa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-lg-3 col-form-label">Địa chỉ</label>
                            <div class="col-lg-8">
                                <input type="text" name="address" value="{{ $customer->address }}" class="form-control" id="address" placeholder="Ví dụ: 445 Nguyễn Khang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-lg-3 col-form-label">Ghi chú</label>
                            <div class="col-lg-8">
                                <textarea name="note" id="note" cols="50" rows="4" class="form-control" placeholder="Nhập ghi chú ..."></textarea>{{ $customer->note }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-8 ">
                                <input type="checkbox" name="check" <?php if ($customer->default == 1) {
                                                                        echo 'checked';
                                                                    } ?>>
                                <span style="margin-left: 10px;">Sử dụng địa chỉ này làm mặc định</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                <form action="{{ url('user/address/'.$customer->id)  }}" method="post">
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