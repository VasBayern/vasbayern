@extends('frontend.layouts.app')
@section('title')
Thông tin tài khoản
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thông tin tài khoản</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<section class="spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="filter-widget">
                    <h4 class="fw-title">Tài khoản</h4>
                    <ul class="filter-catagories">
                        <li><a href="{{ route('user.profile') }}" style="color: #e7ab3c">Thông tin tài khoản</a></li>
                        <li><a href="{{ route('user.address') }}">Địa chỉ giao hàng</a></li>
                        <li><a href="{{ route('user.order') }}">Lịch sử mua hàng</a></li>
                        <li><a href="{{ route('wishlist') }}">Sản phẩm yêu thích</a></li>
                    </ul>
                </div>
            </div>
            <div class='col-lg-9 order-1 order-lg-2'>
                <div class="filter-widget" style="margin-bottom: 0;">
                    <h4 class="fw-title">Thông tin tài khoản</h4>
                </div>
                @if(Auth::check() && !empty(Auth::user()->email_verified_at))
                @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!!session('error')!!}
                </div>
                @endif
                <form action="{{ url('user/profile') }}" method="post" enctype="multipart/form-data" id="quickForm">
                    @csrf
                    <div class="form-group container avatar">
                        <div class="row">
                            <div class="avatar-image col-lg-2">
                                @if(isset(Auth::user()->avatar) && !empty(Auth::user()->avatar) )
                                <img class="avt-image" src="{{ URL::to('/') }}/front_ends/img/user_avatar/{{ Auth::user()->avatar }}" style="border-radius: 50%; width:140px; height:140px"/>
                                @else
                                <img class="avt-image" src="{{ URL::to('/') }}/front_ends/img/user_avatar/avt.jpg" style="border-radius: 50%;" />
                                @endif
                            </div>
                            <div class="col-lg-3 add-avatar">
                                <button class="btn btn-primary upload-button" type="button">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span class="btn btn-file">Đổi ảnh
                                        <input type='file' class="file-upload" name="avatar" onchange="readURL(this);" />
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" disabled name="email" value="{{ Auth::user()->email }}" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <div class="change-pass">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="check">
                                <label class="form-check-label">Thay đổi mật khẩu</label>
                            </div>
                        </div>
                    </div>
                    <div class="password" style="display: none">
                        <div class="form-group">
                            <label for="old_password">Mật khẩu cũ</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Nhập mật khẩu cũ">
                        </div>
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" placeholder="Mật khẩu từ 8 đến 20 kí tự" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập lại mật khẩu mới " name="password_confirmation">
                        </div>
                    </div>
                    <div class='form-group'>
                        <button type="submit" class="btn btn-warning" id="btnUpdateProfile">Cập nhật</button>
                    </div>
                </form>
                @else
                <p>Vui lòng đăng nhập</p>
                @endif
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('.form-check-input').on('click', function() {
            $('.password').toggle();
        });
    });
    $(function() {
        $('input[type=file]').change(function() {
            var val = $(this).val().toLowerCase();
            console.log(val);
            regex = new RegExp("(.*?)\.(jpeg|png|jpg|gif|svg)$");
            if (!(regex.test(val))) {
                $(this).val('');
                alert('Vui lòng chọn định dạng là ảnh');
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.avt-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
</script>
@endsection